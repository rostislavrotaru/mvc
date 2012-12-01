<?php

	use Spherus\HttpContext\Session;

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
		
		/* PROPERTIES */
		
		/* PUBLIC METHODS */
		
		/**
		 * Initializes base functionality of Application configuration 
		 */
		public static function Initialize()
		{
			self::SetIniDirectives();
		}
		
		
		/* PRIVATE METHODS */
		
		/**
		 * Sets PHP configuratioon directives 
		 */
		private static function SetIniDirectives()
		{
			ini_set('display_errors', true);
		}
	}

?>