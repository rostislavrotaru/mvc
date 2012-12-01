<?php

	namespace Spherus\Core
	{
		use Spherus\Interfaces\IModule;
		use Spherus\HttpContext\HttpContext;
		use Spherus\Routing\RouteHandler;
		use Spherus\Routing\Route;
		use Spherus\Parsers\IpFilterParser;

		/**
		 * Class that represents the boot process additional functionality
		 *
		 * @author Rostislav Rotaru
		 * @package spherus.core
		 * @version 3.0
		 * 
		 */
		class Bootstrapper
		{
	
			/* STATIC FUNCTIONS */
			
			/**
			 * Initialize bootstrapper base functionality 
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
		 	 * Includes Ip filters
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
			
			/* PRIVATE METHODS */
			
			private static function LoadCommonController()
			{
				
			}
		}
	
	}
	
?>