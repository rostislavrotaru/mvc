<?php

	namespace Spherus\Core
	{

		use Spherus\HttpContext\HttpContext;
		use Spherus\HttpContext\Session;
		use Spherus\Parsers\IpFilterParser;
		use Spherus\Interfaces\IModule;

		/**
		 * Class that represents the framework context
		 *
		 * @author Rostislav Rotaru
		 * @package spherus.core
		 * @version 3.0
		 *
		 */
		class Context
		{
			
			/* FIELDS */
			
			/**
			 * Defines an array of context modules
			 * 
			 * @var array
			 */
			private static $modules = array();
			
			/**
			 * Defines the context current controller object
			 * 
			 * @var ControllerBase
			 */
			private static $currentController = null; 
			
			/**
			 * Defines the context current theme object
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
			 * @return ControllerBase
			 */
			public static function getCurrentController()
			{
				return self::$currentController;
			}
			
			/**
			 * Sets the context current controller
			 *
			 * @param Spherus\Core\ControllerBase The controller object to set
			 */
			public static function setCurrentController($currentController)
			{
				self::$currentController = $currentController;
			}
		
			/**
			 * Gets the current theme
			 * 
			 * @return ITheme
			 */
			public static function getCurrentTheme() 
			{
				return self::$currentTheme;
			}
			
			/**
			 * Gets current module object
			 * 
			 * @return IModule
			 */
			public static function getCurrentModule()
			{
				return self::GetModuleByName(HttpContext::getParsedUrl()->getModule());
			}
			
			
			/* METHODS */
			
			/**
			 * Initialize context
			 */
			public static function Initialize()
			{
			    self::SetIPFilter();
			    self::LoadModules();
			    Context::setCurrentController(Context::LoadController());
			    Context::LoadTheme();
			    Context::LoadView();
			}
			
			/**
			 * Loads all found modules
			 */
			public static function LoadModules()
			{
			    //Find all module directories
			    $moduleDirectories = Context::ListDirectoryFolders(MODULES);
			    if(isset($moduleDirectories))
			    {
			        foreach ($moduleDirectories as $directory)
			        {
			            //Check if exists the module file
			            Check::FileIsReadable(MODULES.$directory.DIRECTORY_SEPARATOR.'module.php');
			
			            require(MODULES.$directory.DIRECTORY_SEPARATOR.'module.php');
			            $moduleName = $directory.'Module';
			            $module = new $moduleName;
			
			            //Check if created object implements IModule interface
			            if ($module instanceof IModule)
			            {
			                Context::AddModule($module);
			                $module->Run();
			            }
			        }
			    }
			}
			
			/**
			 * Sets Ip filters
			 */
			public static function SetIPFilter()
			{
			    if (file_exists(APP_COMMON.'ipfilter.php'))
			    {
			        require(APP_COMMON.'ipfilter.php');
			        require(PARSERS.'ipfilterparser.php');
			        	
			        //Check IP Filter rules
			        IpFilterParser::Parse();
			    }
			}
			
			/**
			 * Add an module to the modules collection
			 * 
			 * @param Spherus\Interfaces\Imodule $module The module to add
			 * @throws SpherusException When $module parameter is null or empty
			 * @throws SpherusException When module contains a null or empty name
			 * @throws SpherusException When module collection already contains a module with the same name
			 */
			public static function AddModule($module)
			{
				Check::IsNullOrEmpty($module);
				$moduleName = $module->GetModuleName();
				Check::IsNullOrEmpty($moduleName);
				
				if(self::GetModuleByName($moduleName) == null)
				{
					self::$modules[$moduleName] = $module;
				}
				else
				{
					throw new SpherusException(EXCEPTION_MODULE_WITH_THE_SAME_NAME_FOUND);
				}
			} 
			
			/**
			 * Gets module object by its name
			 * 
			 * @param string $moduleName The name of module to search
			 * @return Spherus\Interfaces\IModule|NULL
			 */
			public static function GetModuleByName($moduleName)
			{
				$modules = Context::$modules;
				foreach ($modules as $key=>$value)
				{
					if($moduleName === $key)
					{
						unset($modules);
						return $value;
					}
				}
				
				unset($modules);
				
				return null;
			}

			/**
			 * Lists directory folders
			 *
			 * @param string $path. The path to the directory
			 * @return array
			 */
			public static function ListDirectoryFolders($path)
			{
				$result = null;
				$files = preg_grep('/^([^.])/', scandir($path));
					
				foreach ($files as $file)
				{
					if(is_dir(MODULES.DIRECTORY_SEPARATOR.$file))
					{
						$result[] = $file;
					}
				}
					
				return $result;
			}
				
			/**
			 * Loads controller according to the given ParsedUrl
			 *
			 * @return Spherus\Core\ControllerBase
			 * @throws SpherusException When controller is not found
			 */
			public static function LoadController()
			{
				$parsedUrl = HttpContext::getParsedUrl();
				$moduleObject = self::GetModuleByName($parsedUrl->getModule());
				
				if(isset($moduleObject))
				{
					$fileName = MODULES.$parsedUrl->getModule().DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.$parsedUrl->getController().'.php';
					if(file_exists($fileName))
					{
						if(is_readable($fileName))
						{
							require($fileName);
							$controllerName = $moduleObject->GetNamespaceName().'\\'.$parsedUrl->getController().'Controller';
							
							unset($parsedUrl);
							unset($moduleObject);
							
							$controllerObject = new $controllerName;
							self::LoadControllerAttributes($controllerObject);
							$controllerObject->BeforeLoad();
							
							return $controllerObject;
						}
						else
						{
							unset($parsedUrl);
							unset($moduleObject);
							throw new SpherusException(sprintf(EXCEPTION_FILE_NOT_READABLE, $fileName));
						}
					}
					else
					{
						unset($moduleObject);
						throw new SpherusException(sprintf(EXCEPTION_CONTROLLER_NOT_FOUND, $parsedUrl->getController()));
					}
				}
				else
				{
					unset($moduleObject);
					throw new SpherusException(sprintf(EXCEPTION_MODULE_NOT_FOUND, $parsedUrl->getModule()));
				}
			}
		
			/**
			 * Loads current view
			 */
			public static function LoadView()
			{
				$action = HttpContext::getParsedUrl()->getAction();
				
				//Call action in current controller
				if (method_exists(Context::getCurrentController(), $action))
				{
					call_user_func_array(array(Context::getCurrentController(), $action), HttpContext::getParsedUrl()->getParameters());
					Context::getCurrentController()->AfterLoad();
				}
				else
				{
					throw new SpherusException(sprintf(EXCEPTION_NO_CONTROLLER_ACTION_METHOD, $action, HttpContext::getParsedUrl()->getController(), HttpContext::getParsedUrl()->getModule()));
				}
				
				if(!in_array($action, Context::getCurrentController()->noViewControllers))
				{
					$fileName = MODULES.HttpContext::getParsedUrl()->getModule().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.HttpContext::getParsedUrl()->getController().DIRECTORY_SEPARATOR.$action.'.php';
						
					Context::getCurrentController()->BeforeAction();
					Check::FileIsReadable($fileName);
					
					if(isset(self::getCurrentController()->layout))
					{
						ob_start();
						require($fileName);
						HttpContext::setPageContent(ob_get_contents());
						ob_end_clean();
						
						//Search layout in app first, then in current controller module
						$layoutFile = self::getCurrentTheme()->getLayoutsPath().DIRECTORY_SEPARATOR.self::getCurrentController()->layout.'.php';
						
						if (file_exists($layoutFile))
						{
							Check::FileIsReadable($layoutFile);
							require($layoutFile);
						}
						else
						{
							$moduleThemeFile = MODULES.HttpContext::getParsedUrl()->getModule().DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.self::getCurrentTheme()->getName().DIRECTORY_SEPARATOR.'theme.php';
							Check::FileIsReadable($moduleThemeFile);
							require($moduleThemeFile);
							$moduleThemeName = self::getCurrentModule()->GetNamespaceName().'\\Themes\\'.self::getCurrentTheme()->getName().'Theme';
							$moduleThemeObject = new $moduleThemeName;
							
							unset($moduleThemeFile);
							unset($moduleThemeName);
							
							$layoutFile = $moduleThemeObject->getLayoutsPath().DIRECTORY_SEPARATOR.self::getCurrentController()->layout.'.php';
							if(file_exists($layoutFile))
							{
								Check::FileIsReadable($layoutFile);
								require($layoutFile);
							}
							else
							{
								throw new SpherusException(sprintf(EXCEPTION_LAYOUT_NOT_FOUND, self::getCurrentController()->layout));
							}
							unset($moduleThemeObject);
						}
					}
					else
					{
						require($fileName);
					}

					unset($fileName);
					Context::getCurrentController()->AfterAction();
				}
				
				unset($action);
			} 
			
			/**
			 * Loads application configuration file
			 * 
			 * @throws SpherusException When config.php file not found in the public/common folder.
			 */
			public static function LoadApplicationConfig()
			{
				if(file_exists(APP_COMMON.'config.php'))
				{
					require(APP_COMMON.'config.php');
					\Config::Initialize();
				}
				else
				{
					throw new SpherusException(EXCEPTION_APP_CONFIG_NOT_FOUND);
				}
			}
			
			/**
			 * Loads theme for application. 
			 * If not found - the default theme from configuration file will be used. 
			 */
			public static function LoadTheme()
			{
				$currentThemeName = Session::GetValue('theme');
				if(!isset($currentThemeName))
				{
					$currentThemeName = \Config::getDefaultTheme();
					Session::SetValue('theme', $currentThemeName);
				}
				
				//Define theme paths
				define('CSS', THEMES.$currentThemeName.DIRECTORY_SEPARATOR.'css');
				define('SCRIPTS', THEMES.$currentThemeName.DIRECTORY_SEPARATOR.'scripts');
				define('IMAGES', THEMES.$currentThemeName.DIRECTORY_SEPARATOR.'images');
				
				$currentThemeFilePath = THEMES.$currentThemeName.DIRECTORY_SEPARATOR.'theme.php';
				Check::FileIsReadable($currentThemeFilePath);
				require($currentThemeFilePath);
				$currentThemeName = 'Spherus\\Themes\\'.$currentThemeName.'Theme';
				
				self::$currentTheme = new $currentThemeName;
				unset($currentThemeName);
				unset($currentThemeFilePath);
			}
			
			/**
			 * Loads controller attributes (layouts, helpers etc).
			 * 
			 * @param ControllerBase $controllerObject The controller object to parse.
			 * 
			 * @throws SpherusException When $controllerObject parameter is null or empty.
			 */
			private static function LoadControllerAttributes($controllerObject)
			{
				Check::IsNullOrEmpty($controllerObject);
				
				//Load layout
				if(!isset($controllerObject->layout))
				{
					$controllerObject->layout = \Config::getDefaultLayout();
				}
			}
			
		}
	}
?>