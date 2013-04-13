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
		private static $installedModules = array
		(
			'Main' => 'App\Modules\Main\Module'
		);
		
		/**
		 * Defines installed themes array
		 *
		 * @var array
		 */
		private static $installedThemes = array
		(
			'Standard' => 'App\Themes\Standard\Theme'
		);

		
		/* PROPERTIES */
		
		/**
		 * Gets installed modules array
		 *
		 * @var array
		 */
		public static function getInstalledModules()
		{
			return self::$installedModules;
		}
		
		/**
		 * Gets installed themes array
		 *
		 * @var array
		 */
		public static function getInstalledThemes()
		{
			return self::$installedThemes;
		}

		/* PUBLIC METHODS */

		/**
		 * Initializes base functionality of Application configuration
		 */
		public static function Initialize()
		{
			parent::Initialize();
			
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