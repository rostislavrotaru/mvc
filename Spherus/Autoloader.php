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
	 * Class with autoloading functinality
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core
	 */
	class Autoloader
	{
		/* FIELDS */

		private static $includePaths = array
		(
			'App'=>APP,
			'Common'=>APP_COMMON
		);


		/* FUNCTIONS */

		/**
		 * Class autoload loader.
		 * This method is provided to be invoked within an __autoload() magic method.
		 *
		 * @param string $className class name
		 * @return boolean whether the class has been loaded successfully
		 */
		public static function Autoload($className)
		{
			// If class does not have namespace
			if(strpos($className,'\\')===false)
			{
				foreach(self::$includePaths as $key=>$value)
				{
					$classFile = $value.$className.'.php';
					if(is_file($classFile))
					{
						return require($classFile);
					}
				}

				return include($className.'.php');
			}

			return include './'.str_ireplace('\\', '/', $className).'.php';
		}

		/**
		 * Registers a new class autoloader.
		 *
		 * @param callback $autoloadFunction a valid PHP callback function (function name or array($className, $methodName)).
		 * @param Exception $throwException When the autoloadFunction cannot be registered.
		 * @param boolean $prepend If true, spl_autoload_register() will prepend the autoloader on the autoload stack instead of appending it.
		 */
		public static function RegisterAutoloader($autoloadFunction, $throwException = true, $prepend = false)
		{
			return spl_autoload_register($autoloadFunction, $throwException, $prepend);
		}

		/**
		 * Unegisters an existing class autoloader.
		 *
		 * @param callback $autoloadFunction The autoload function being unregistered.
		 * @return boolean TRUE on success or FALSE on failure.
		 */
		public static function UnegisterAutoloader($autoloadFunction)
		{
			return spl_autoload_unregister($autoloadFunction);
		}
	}

	spl_autoload_register(array('Spherus\Core\Autoloader', 'Autoload'));