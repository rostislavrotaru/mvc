<?php

	namespace App\Common;

	use Spherus\Core\SpherusConfig;
use App;
	
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
			'App\Modules\Main\MainModule'
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