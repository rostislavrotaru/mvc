<?php

/**
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright SPHERUS (http://spherus.net)
 * @license http://license.spherus.net
 * @link http://spherus.net
 * @since 3.0
 */
namespace Spherus;

/**
 * Class with autoloading functinality
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.core
 */
class Autoloader
{
	/* FIELDS */

	/**
	 * Contains Additional include path for classes that does not contains namespaces.
	 *
	 * @var Array
	 */
	private static $includePaths = [];


	/* PROPERTIES */

	/**
	 * Gets Additional include path for classes that does not contains namespaces.
	 *
	 * @return array
	 */
	public static function getIncludePaths()
	{
		return self::$includePaths;
	}


	/* FUNCTIONS */

	/**
	 * Class autoloader.
	 *
	 * @param string $className The class name.
	 * @return boolean Whether the class has been loaded successfully
	 */
	public static function Autoload($className)
	{
		// If class does not have namespace
		if(strpos($className, '\\')===false)
		{
			foreach(self::$includePaths as $path)
			{
				$classFile = $path.$className.'.php';
				if(is_file($classFile))
				{
					return require_once($classFile);
				}
			}
		}
		else // Class have namespace
		{
			$fileName = ROOT.str_ireplace('\\', '/', $className).'.php';
			if(file_exists($fileName))
			{
				return require($fileName);
			}
		}
		
		return false;
	}

	/**
	 * Add include path for class searching during autoload.
	 *
	 * @param arra|string $includePath Array of path to add.
	 * @throws SpherusException When $includePath parameter is not an array.
	 */
	public static function AddPath($includePath)
	{
		if(is_array($includePath))
		{
			self::$includePaths = array_merge(self::$includePaths, $includePath);
		}
		else
		{
			self::$includePaths[] = $includePath;
		}
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
	public static function UnregisterAutoloader($autoloadFunction)
	{
		return spl_autoload_unregister($autoloadFunction);
	}
}

spl_autoload_extensions('.php');
spl_autoload_register();
spl_autoload_register(array('Spherus\Autoloader', 'Autoload'));