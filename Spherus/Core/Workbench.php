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
use Spherus\Core\Base\ControllerBase;
use Spherus\IoC\IoC;
use Spherus\Interfaces\ITheme;
use Spherus\Common\FileSystem;
use Spherus\Core\Base\ThemeBase;

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
	 * Defines an array of Workbench ModuleBase objects
	 *
	 * @var array
	 */
	private static $modules = [];

	/**
	 * Defines the Workbench current controller object
	 *
	 * @var ControllerBase
	 */
	private static $currentController = null;

	/**
	 * Defines the Workbench current theme object
	 *
	 * @var ITheme
	 */
	private static $currentTheme = null;

	/* PROPERTIES */

	/**
	 * Gets array of loaded ModuleBase objects
	 *
	 * @return array
	 */
	public static function getModules()
	{
		return self::$modules;
	}

	/**
	 * Gets the Workbench current controller object
	 *
	 * @return ControllerBase
	 */
	public static function getCurrentController()
	{
		return self::$currentController;
	}

	/**
	 * Sets the Workbench current controller object
	 *
	 * @param ControllerBase $controller The controller object to set.
	 */
	public static function setCurrentController($controller)
	{
		self::$currentController = $controller;
	}

	/**
	 * Gets the current theme object
	 *
	 * @return ThemeBase
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

	/* PUBLIC FUNCTIONS */

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
		foreach(Config::getInstalledModuleNames() as $moduleName=>$moduleNamespace)
		{
			$moduleClass = $moduleNamespace.'\Module';
			$moduleObject = new $moduleClass($moduleName, $moduleNamespace);
			Check::IsInstanceOf($moduleObject, 'Spherus\Core\Base\ModuleBase');
			
			self::AddModule($moduleObject);
			$moduleObject->Run();
			
			unset($moduleObject);
		}
	}

	/**
	 * Loads controller according to the given ParsedUrl
	 *
	 * @throws SpherusException When controller is not found
	 */
	public static function LoadController()
	{
		$parsedUrl = HttpContext::getParsedUrl();
		$module = self::GetModuleByName($parsedUrl->getModuleName());
		if(!isset($module))
		{
			throw new SpherusException(sprintf(EXCEPTION_MODULE_NOT_FOUND, $parsedUrl->getModuleName()));
		}
	
		$controllerName = ucfirst(strtolower($parsedUrl->getControllerName())).'Controller';
		/* @var $controllerObject ControllerBase */
		$controllerObject = IoC::Resolve($controllerName, $parsedUrl->getModuleName());
	
		$layout = $controllerObject->getLayout();
		if(!isset($layout))
		{
			$controllerObject->setLayout(Config::getDefaultLayoutName());
		}
	
		$controllerObject->BeforeLoad();
	
		self::setCurrentController($controllerObject);
	
		unset($controllerName);
		unset($controllerObject);
		unset($layout);
		unset($parsedUrl);
		unset($module);
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
	 * Loads theme for application.
	 * If not found - the default theme from configuration file will be
	 * used.
	 *
	 * @throws SpherusException When current theme cannot be found.
	 */
	public static function LoadTheme()
	{
		$currentThemeName = Session::GetValue('theme');
		if(!isset($currentThemeName))
		{
			$currentThemeName = Config::getDefaultThemeName();
			Session::SetValue('theme', $currentThemeName);
		}
	
		foreach (Config::getInstalledThemesNames() as $themeName=>$themeClass)
		{
			if(strtolower($themeName) === strtolower($currentThemeName))
			{
				$themeClass .= '\Theme';
				self::$currentTheme = new $themeClass();
				self::IncludeModuleTheme();
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
			throw new SpherusException(
					sprintf(EXCEPTION_NO_CONTROLLER_ACTION_METHOD, $action, HttpContext::getParsedUrl()->getControllerName(),
							HttpContext::getParsedUrl()->getModuleName()));
		}

		if(self::$currentController->getNoView() === false)
		{
			self::$currentController->BeforeAction();
			$layoutName = self::$currentController->getLayout(); 
			if(isset($layoutName))
			{
				ob_start();
				if(self::$currentController->getUseIoCForView() === true)
				{
					$parsedUrl = HttpContext::getParsedUrl();
					require(IoC::Resolve($parsedUrl->getModuleName().$parsedUrl->getControllerName().$parsedUrl->getActionName().'View'));
					unset($parsedUrl);
				}
				else 
				{
					$fileName = MODULES.SEPARATOR.HttpContext::getParsedUrl()->getModuleName().SEPARATOR.'views'.SEPARATOR.
					HttpContext::getParsedUrl()->getControllerName().SEPARATOR.$action.'.php';
					
					Check::FileExists($fileName);
					require($fileName);
				}
				
				HttpContext::setPageContent(ob_get_contents());
				ob_end_clean();

				// Search layout in current module theme first, common themes folder
				$layoutFile = self::$currentTheme->getLayoutsPath().SEPARATOR.self::$currentController->getLayout().'.php';

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
					//Search layout in 
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
			unset($layoutName);
		}
		
		unset($action);
	}

	
	/* PRIVATE FUNCTIONS */
	
	/**
	 * Includes module theme as a child of module theme if found. 
	 */
	private static function IncludeModuleTheme()
	{
		$childThemeNamespace = self::getCurrentModule()->getNamespace().'\Themes\\'.self::$currentTheme->GetName().'\Theme';
		if(FileSystem::FileExists($childThemeNamespace.'.php'))
		{
			self::$currentTheme->setChildTheme(new $childThemeNamespace);
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
	 * @param ModuleBase $module The module to add
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