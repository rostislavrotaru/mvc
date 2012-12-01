<?php
	
	/**
	 * Contains lists of allowed and denied IP addresses
	 * 
	 * @version 3.0
	 * @package Spherus
	 * @author Rostislav Rotaru
	 * 
	 */
	class IpFilter
	{
		
		/* FIELDS */
		
		/**
		 * Contains allowed IP addresses list
		 * @var array
		 */
		private static $allow = array
		(
			'all',
			'172.17.2.3'
		);
		
		/**
		 * Contains denied IP addresses list
		 * @var array
		 */
		private static $deny = array
		(
			'all',
			'172.17.2.4'
		);
		
		
		/* PROPERTIES */
	
		/**
		 * Gets allowed IP addresses list
		 * @var array
		 */
		public static function getAllow() 
		{
			return self::$allow;
		}
	
		/**
		 * Gets allowed IP addresses list
		 * @var array
		 */
		public static function getDeny() 
		{
			return self::$deny;
		}

	}
?>