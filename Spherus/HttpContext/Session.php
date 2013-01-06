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
		 * Defines the session content. Filtered by $sessionName variable
		 *
		 * @var array
		 */
		private static $content = null;

		/**
		 * Defines the session name
		 *
		 * @var string
		 */
		private static $sessionName = 'spherus';


		/* PROPERTIES */


		/* PUBLIC FUNCTIONS */

		/**
		 * Gets session value
		 *
		 * @param mixed $key The session key to search
		 * @return Mixed|null
		 */
		public static function GetValue($key)
		{
			if(isset(self::$content))
			{
				if(isset(self::$content[$key]))
				{
					return self::$content[$key];
				}
			}

			return null;
		}

		/**
		 * Sets a session value.
		 *
		 * @param string $key The session key.
		 * @param mixed $value The session value to set. If $value parameter is an object - serialized object will be stored.
		 *
		 * @throws SpherusException When $key parameter is null or empty.
		 * @throws SpherusException When $value parameter is null or empty.
		 */
		public static function SetValue($key, $value)
		{
			Check::IsNullOrEmpty($key);
			Check::IsNullOrEmpty($value);

			if(is_object($value))
			{
				$value = serialize($value);
			}

			self::$content[$key] = $value;
			$_SESSION[self::$sessionName][$key] = $value;
		}

		/**
		 * Clears current session
		 */
		public static function Clear()
		{
			self::$content = null;
			unset($_SESSION[self::$sessionName]);
		}

		/**
		 * Starts session
		 */
		public static function Start()
		{
			if(session_start())
			{
				if(isset($_SESSION[self::$sessionName]))
				{
					self::$content = $_SESSION[self::$sessionName];
				}
			}
		}

	}