<?php

	namespace App\Common;

	use Spherus\Core\SpherusConfig;
	
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

		
		/* PROPERTIES */
		
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