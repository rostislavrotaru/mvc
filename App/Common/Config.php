<?php

	namespace App\Common;

	use Spherus\Core\SpherusConfig;
	use Spherus\Components\DATA\Component\Enums\DatabaseProviderType;
	
	/**
	 * Application configuration
	 *
	 * @version 3.0
	 * @package App
	 * @author Rostislav Rotaru
	 *
	 */
	class Config extends SpherusConfig
	{
		
		/* FIELDS */
		
		/**
		 * Defines installed modules array
		 *
		 * @var array
		 */
		private static $installedModuleNames = array
		(
			'Main' => 'App\Modules\Main'
		);
		
		/**
		 * Defines installed theme names array
		 *
		 * @var array
		 */
		private static $installedThemesNames = array
		(
			'Standard' => 'App\Themes\Standard'
		);

		/**
		 * Defines the applicatin settings
		 * @var array
		 */
		private static $settings = [];
		
		
		/* PROPERTIES */
		
		public static $domainModelConfig = array
		(
			'provider'=>DatabaseProviderType::MySql,
			'host'=>'0.0.0.0',
			'port'=>'3306',
			'user'=>'root',
			'password'=>'password',
			'database'=>'database'
		);
		
		/**
		 * Gets the application settings
		 *
		 * @return array
		 */
		public static function getSettings()
		{
			return self::$ettings;
		}
		
		/**
		 * Gets the list of installed module names
		 *
		 * @return array
		 */
		public static function getInstalledModuleNames()
		{
			return self::$installedModuleNames;
		}
		
		/**
		 * Gets the list of installed theme names
		 *
		 * @var array
		 */
		public static function getInstalledThemesNames()
		{
			return self::$installedThemesNames;
		}

		
		/* PUBLIC METHODS */

		/**
		 * Initializes base functionality of Application configuration
		 */
		public static function Initialize()
		{
			self::SetIniDirectives();
			self::AddRoutes();
		}

		
		/* PRIVATE METHODS */

		/**
		 * Sets PHP configuratioon directives
		 */
		private static function SetIniDirectives()
		{
			ini_set('display_errors', true);
			ini_set('track_errors', false);
		}

		/**
		 * Adds routes
		 */
		private static function AddRoutes()
		{

		}

	}