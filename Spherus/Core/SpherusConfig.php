<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Core;
	
				/**
	 * Class that represents the Application base configuration
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core
	 */
	abstract class SpherusConfig
	{

		/* FIELDS */

		/**
		 * Defines the default application theme name.
		 * Can be overwritten in Application Configuration file.
		 *
		 * @var string
		 */
		private static $defaultThemeName = 'Standard';

		/**
		 * Defines the default application layout name.
		 * Can be overwritten in Application Configuration file.
		 *
		 * @var string
		 */
		private static $defaultLayoutName = 'Default';

		/**
		 * Defines defaults for routing if not specified.
		 * Can be overwritten in Application Configuration file.
		 *
		 * @var array
		 */
		private static $routingDefaults = array
		(
			'module' => 'main',
			'controller' => 'home',
			'action' => 'index',
			'router' => 'Spherus\Routing\DefaultRouter',
			'default_route' => '/:controller/:action/*'
		);

		/* PROPERTIES */

		/**
		 * Gets the default application theme.
		 *
		 * @return string
		 */
		public static function getDefaultThemeName()
		{
			return self::$defaultThemeName;
		}

		/**
		 * Sets the default application theme name.
		 *
		 * @param string $defaultThemeName The default theme name
		 * @throws SpherusException When $defaultThemeName parameter is null or
		 *         empty.
		 */
		public static function setDefaultThemeName($defaultThemeName)
		{
			Check::IsNullOrEmpty($defaultThemeName);
			self::$defaultThemeName = $defaultThemeName;
		}

		/**
		 * Gets the default application layout name.
		 *
		 * @return string
		 */
		public static function getDefaultLayoutName()
		{
			return self::$defaultLayoutName;
		}

		/**
		 * Sets the default application layout.
		 *
		 * @param string $defaultLayoutName The default layout name
		 * @throws SpherusException When $defaultLayoutName parameter is null or
		 *         empty.
		 */
		public static function setDefaultLayoutName($defaultLayoutName)
		{
			self::$defaultLayoutName = $defaultLayoutName;
		}

		/**
		 * Gets routing defaults.
		 *
		 * @return array
		 */
		public static function getRoutingDefaults()
		{
			return self::$routingDefaults;
		}

		/* PUBLIC METHODS */

		/**
		 * Initializes base functionality of Application configuration.
		 * Can be overwritten in Application Configuration file.
		 */
		static function Initialize()
		{
			
		}

		/**
		 * Sets default routing value for a specified key.
		 *
		 * @param string $key The routing default key.
		 * @param mixed $value The routing default value.
		 * @throws SpherusException When $key parameter is null or empty.
		 * @throws SpherusException When self::$routingDefaults is null.
		 */
		public static function SetRoutingDefaults($key, $value)
		{
			Check::IsNullOrEmpty($key);
			Check::IsNull(self::$routingDefaults);

			self::$routingDefaults[$key] = $value;
		}
	
	}