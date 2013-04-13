<?php

/**
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright SPHERUS (http://spherus.net)
 * @license http://license.spherus.net
 * @link http://spherus.net
 * @since 3.0
 */
namespace Spherus\Core;

use App\Common\Config;
use Spherus\HttpContext\HttpContext;
use Spherus\HttpContext\Session;
use Spherus\Parsers\IpFilterParser;
use Spherus\Routing\RouteManager;
use Spherus\Core\Base\ModuleBase;
use Spherus\IoC\IoC;

/**
 * Class that represents the framework workbench
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.core
 */
class Workbench
{

	/* FIELDS */

	/**
	 * Defines an array of context modules
	 *
	 * @var array
	 */
	private static $modules = [];

	/**
	 * Defines the context current controller object
	 *
	 * @var ControllerBase
	 */
	private static $currentController = null;

	/**
	 * Defines the context current theme object
	 *
	 * @var string
	 */
	private static $currentTheme = null;

	/* PROPERTIES */

	/**
	 * Gets array of context modules
	 *
	 * @return array
	 */
	public static function getModules()
	{
		return self::$modules;
	}

	/**
	 * Gets the context current controller object
	 *
	 * @return Spherus\Core\Base\ControllerBase
	 */
	public static function getCurrentController()
	{
		return self::$currentController;
	}

	/**
	 * Sets the context current controller
	 *
	 * @param Spherus\Core\ControllerBase $controller The controller object to set.
	 */
	public static function setCurrentController($controller)
	{
		self::$currentController = $controller;
	}

	/**
	 * Gets the current theme
	 *
	 * @return Spherus\Interfaces\ITheme
	 */
	public static function getCurrentTheme()
	{
		return self::$currentTheme;
	}

	/**
	 * Gets current module object
	 *
	 * @return ModuleBase
	 */
	public static function getCurrentModule()
	{
		return self::GetModuleByName(HttpContext::getParsedUrl()->getModuleName());
	}

	/* METHODS */

	/**
	 * Initialize context
	 */
	public static function Initialize()
	{
		IpFilterParser::Parse();
		self::LoadModules();
		HttpContext::setParsedUrl(RouteManager::ParseUrl());
		self::LoadController();
		self::LoadTheme();
		self::LoadView();
	}

	/**
	 * Loads all found modules
	 */
	public static function LoadModules()
	{
		foreach(Config::getInstalledModules() as $moduleName=>$moduleClass)
		{
			$moduleObject = new $moduleClass;
			Check::IsInstanceOf($moduleObject, 'Spherus\\Interfaces\\IModule');
			
			self::AddModule(new ModuleBase($moduleName, $moduleClass, $moduleObject));
			$moduleObject->Run();
			
			unset($moduleObject);
		}
	}

	/**
	 * Gets module object by its name
	 *
	 * @param string $moduleName The name of module to search
	 * @return ModuleBase|NULL
	 */
	public static function GetModuleByName($moduleName)
	{
		foreach (self::$modules as $module)
		{
			if(strtolower($module->getName()) == strtolower($moduleName))
			{
				return $module;
			}
		}

		return null;
	}

	/**
	 * Loads controller according to the given ParsedUrl
	 *
	 * @throws SpherusException When controller is not found
	 */
	public static function LoadController()
	{
		$parsedUrl = HttpContext::getParsedUrl();
		$moduleBase = self::GetModuleByName($parsedUrl->getModuleName());	
		
		if(!isset($moduleBase))
		{
			throw new SpherusException(sprintf(EXCEPTION_MODULE_NOT_FOUND, $parsedUrl->getModuleName()));
		}
		
		$controllerName = strtolower($parsedUrl->getControllerName());
		$controllerObject = IoC::Resolve($controllerName, $parsedUrl->getModuleName(), true);
		
		self::LoadControllerAttributes($controllerObject);
		$controllerObject->BeforeLoad();

		self::setCurrentController($controllerObject);
		
		unset($parsedUrl);
		unset($moduleBase);
	}

	/**
	 * Loads current view
	 */
	public static function LoadView()
	{
		$action = HttpContext::getParsedUrl()->getActionName();

		// Call action in current controller
		if(method_exists(Workbench::getCurrentController(), $action))
		{
			call_user_func_array(array(Workbench::getCurrentController(), $action), HttpContext::getParsedUrl()->getParameters());
			Workbench::getCurrentController()->AfterLoad();
		}
		else
		{
			$rrrr  = HttpContext::getParsedUrl();
			throw new SpherusException(
					sprintf(EXCEPTION_NO_CONTROLLER_ACTION_METHOD, $action, HttpContext::getParsedUrl()->getControllerName(),
							HttpContext::getParsedUrl()->getModuleName()));
		}

		if(!in_array($action, self::$currentController->noViewControllers))
		{
			$fileName = MODULES.SEPARATOR.HttpContext::getParsedUrl()->getModuleName().SEPARATOR.'views'.SEPARATOR.
					HttpContext::getParsedUrl()->getControllerName().SEPARATOR.$action.'.php';
			Check::FileIsReadable($fileName);

			self::$currentController->BeforeAction();
			self::$currentController->IncludeHelpers();

			if(isset(self::$currentController->layout))
			{
				ob_start();
				require ($fileName);
				HttpContext::setPageContent(ob_get_contents());
				ob_end_clean();

				// Search layout in app first, then in current controller
				// module
				$layoutFile = self::$currentTheme->getLayoutsPath().SEPARATOR.self::$currentController->layout.'.php';

				if(file_exists($layoutFile))
				{
					Check::FileIsReadable($layoutFile);
					ob_start();
					require ($layoutFile);
					HttpContext::setPageContent(ob_get_contents());
					ob_end_clean();
					self::ProcessPageContent();
				}
				else
				{
					$themeNamespace = self::getCurrentModule()->getInstance()->GetThemesNamespace().'\\'.self::$currentTheme->getName().'\\Theme';
					$moduleThemeObject = new $themeNamespace;

					unset($themeNamespace);

					$layoutFile = $moduleThemeObject->getLayoutsPath().SEPARATOR.self::$currentController->layout.'.php';
					if(file_exists($layoutFile))
					{
						Check::FileIsReadable($layoutFile);
						ob_start();
						require ($layoutFile);
						HttpContext::setPageContent(ob_get_contents());
						ob_end_clean();
						self::ProcessPageContent();
					}
					else
					{
						throw new SpherusException(sprintf(EXCEPTION_LAYOUT_NOT_FOUND, self::$currentController->layout));
					}

					unset($moduleThemeObject);
				}
			}
			else
			{
				ob_start();
				require ($fileName);
				HttpContext::setPageContent(ob_get_contents());
				ob_end_clean();
				self::ProcessPageContent();
			}

			self::getCurrentController()->AfterAction();
			unset($fileName);
			unset($layoutFile);
		}
		unset($action);
	}

	/**
	 * Loads theme for application.
	 * If not found - the default theme from configuration file will be
	 * used.
	 */
	public static function LoadTheme()
	{
		$currentThemeName = Session::GetValue('theme');
		if(!isset($currentThemeName))
		{
			$currentThemeName = Config::getDefaultTheme();
			Session::SetValue('theme', $currentThemeName);
		}

		foreach (Config::getInstalledThemes() as $themeName=>$themeClass)
		{
			if(strtolower($themeName) === strtolower($currentThemeName))
			{
				self::$currentTheme = new $themeClass();
				break;
			}
		}

		if(self::$currentTheme === null)
		{
			throw new SpherusException(printf(EXCEPTION_THEME_NOT_FOUND, $currentThemeName));
		}

		unset($currentThemeName);
	}

	/**
	 * Loads controller attributes (layouts, helpers etc).
	 *
	 * @param ControllerBase $controller The controller object to parse.
	 * @throws SpherusException When $controllerObject parameter is null or
	 *         empty.
	 */
	private static function LoadControllerAttributes($controller)
	{
		Check::IsNullOrEmpty($controller);
		if(!isset($controller->layout))
		{
			$controller->layout = Config::getDefaultLayout();
		}
	}

	/**
	 * Processes page content
	 */
	private static function ProcessPageContent()
	{
		echo HttpContext::getPageContent();
	}

	/**
	 * Add an module to the modules collection
	 *
	 * @param Spherus\Interfaces\Imodule $module The module to add
	 * @throws SpherusException When $module parameter is null or empty
	 * @throws SpherusException When module contains a null or empty name
	 * @throws SpherusException When module collection already contains a
	 *         module with the same name
	 */
	private static function AddModule(ModuleBase $module)
	{
		Check::IsNullOrEmpty($module);

		if(self::GetModuleByName($module->getName()) === null)
		{
			self::$modules[] = $module;
		}
		else
		{
			throw new SpherusException(EXCEPTION_DUPLICATE_MODULE);
		}
	}
}