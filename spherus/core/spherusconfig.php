<?php

	namespace Spherus\Core
	{
	
		/**
		 * Application base configuration
		 *
		 * @author Rostislav Rotaru
		 * @package spherus.core
		 * @version 3.0
		 *
		 */
		abstract class SpherusConfig
		{		
		
			/* FIELDS */
			
			/**
			 * Defines the default application theme. Can be overwritten in Application Configuration file.
			 * @var string
			 */
			private static $defaultTheme = 'default';
			
			/**
			 * Defines the default application layout. Can be overwritten in Application Configuration file.
			 * @var string
			 */
			private static $defaultLayout = 'default';
			
			/**
			 * Defines defaults for routing if not specified. Can be overwritten in Application Configuration file.
			 * @var array 
			 */
			public static $routingDefaults = array
			(
				'module'=>'main',
				'controller'=>'home',
				'action' => 'index'	
			);
			
			
			/* PROPERTIES */
			
			/**
			 * Gets the default application theme.
			 * @return string
			 */
			public static function getDefaultTheme()
			{
				return self::$defaultTheme;
			}
				
			/**
			 * Sets the default application theme name.
			 * @param string The default theme name
			 * 
			 * @throws SpherusException When $defaultTheme parameter is null or empty.
			 */
			public static function setDefaultTheme($defaultTheme)
			{
				Check::IsNullOrEmpty($defaultTheme);
				self::$defaultTheme = $defaultTheme;
			}
			
			/**
			 * Gets the default application layout.
			 * @return string
			 */
			public static function getDefaultLayout()
			{
				return SpherusConfig::$defaultLayout;
			}
			
			/**
			 * Sets the default application layout.
			 * @param string The default layout name
			 * 
			 * @throws SpherusException When $defaultLayout parameter is null or empty.
			 */
			public static function setDefaultLayout($defaultLayout)
			{
				self::$defaultLayout = $defaultLayout;
			}
			
			
			/* METHODS */
			
			/**
			 * Initializes base functionality of Application configuration. Should be overwritten in Application Configuration file.
			 */
			public static function Initialize()
			{
				//Overwrite in Application config file
			}

		}
	}
?>