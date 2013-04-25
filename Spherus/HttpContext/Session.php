<?php

/**
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright SPHERUS (http://spherus.net)
 * @license http://license.spherus.net
 * @link http://spherus.net
 * @since 3.0
 */
namespace Spherus\HttpContext;

use Spherus\Core\SpherusException;
use Spherus\Core\Check;


/**
 * Class that represents the http context session object
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.httpcontext
 */
class Session
{

	/* FIELDS */

	/**
	 * Defines the session name
	 *
	 * @var string
	 */
	private static $sessionName = 'spherus';

	
	/* PUBLIC FUNCTIONS */

	/**
	 * Gets session value
	 *
	 * @param mixed $key The session key to search
	 * @return Mixed null
	 */
	public static function GetValue($key)
	{
		if(isset($_SESSION[self::$sessionName]) and isset($_SESSION[self::$sessionName][$key]))
		{
			return $_SESSION[self::$sessionName][$key];
		}

		return null;
	}
	
	/**
	 * Unsets session value
	 *
	 * @param mixed $key The session key to search
	 */
	public static function UnsetValue($key)
	{
		if(isset($_SESSION[self::$sessionName]) and isset($_SESSION[self::$sessionName][$key]))
		{
			unset($_SESSION[self::$sessionName][$key]);
		}
	}

	/**
	 * Sets a session value.
	 *
	 * @param string $key The session key.
	 * @param mixed $value The session value to set. If $value parameter is an object - serialized object will be stored.
	 * @throws SpherusException When $key parameter is null or empty.
	 */
	public static function SetValue($key, $value)
	{
		Check::IsNullOrEmpty($key);

		if(is_object($value))
		{
			$value = serialize($value);
		}

		$_SESSION[self::$sessionName][$key] = $value;
	}

	/**
	 * Clears current session
	 */
	public static function Clear()
	{
		unset($_SESSION[self::$sessionName]);
	}

	/**
	 * Starts session
	 */
	public static function Start()
	{
		if(!session_start())
		{
			throw new SpherusException(EXCEPTION_SESSION_START_FAILURE);
		}
	}

}