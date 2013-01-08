<?php

	namespace App\Common;

	/**
	 * Contains lists of allowed and denied IP addresses
	 *
	 * --------------------------------------------------
	 * How to use:
	 *
	 * - simple ip address: 10.10.10.10.
	 * - you can use wildcard (*) symbol (means any symbol) in place of any sybol, e.g: 10.10.10.*
	 * - other examples:
	 *   *
	 *   10.*
	 *   10.10.*
	 *   127.*.1.1
	 *
	 * --------------------------------------------------
	 *
	 * @version 3.0
	 * @package Spherus
	 * @author Rostislav Rotaru
	 */
	class IpFilter
	{

		/* FIELDS */

		/**
		 * Contains allowed IP addresses list
		 *
		 * @var array
		 */
		private static $allow = array
		(
			'127.*'
		);

		/**
		 * Contains denied IP addresses list
		 *
		 * @var array
		 */
		private static $deny = array
		(
			'137.*'
		);

		/* PROPERTIES */

		/**
		 * Gets allowed IP addresses list
		 *
		 * @var array
		 */
		public static function getAllow()
		{
			return self::$allow;
		}

		/**
		 * Gets allowed IP addresses list
		 *
		 * @var array
		 */
		public static function getDeny()
		{
			return self::$deny;
		}

	}