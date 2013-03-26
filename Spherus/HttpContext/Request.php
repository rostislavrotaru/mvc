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
 * Class that represents the http request object
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.httpcontext
 */
class Request
{

	/* FIELDS */

	/**
	 * Defines the method of the current HTTP request.
	 *
	 * @var string
	 */
	private static $method = null;

	/**
	 * Available header array of the current HTTP-request.
	 *
	 * @var array
	 */
	private static $headers = array();

	/**
	 * Determine if the request is an AJAX request.
	 *
	 * @var boolean
	 */
	private static $isAjax = false;

	/**
	 * Defines remote client IP address.
	 *
	 * @var string
	 */
	private static $remoteAddress = null;

	/**
	 * Defines server redirect status
	 *
	 * @var string
	 */
	private static $redirectStatus = null;

	/**
	 * Defines current URL with query
	 *
	 * @var string
	 */
	private static $currentUrl = null;

	/**
	 * Defines URL referrer if available
	 *
	 * @var string
	 */
	private static $urlReferrer = null;

	/**
	 * Defines the list of files loaded from client.
	 *
	 * @var array
	 */
	private static $files = array();

	/**
	 * Defines Request cookies
	 *
	 * @var array
	 */
	private static $cookies = array();

	/* PROPERTIES */

	/**
	 * Gets remote client IP address.
	 *
	 * @return string
	 */
	public static function getRemoteAddress()
	{
		return self::$remoteAddress;
	}

	/**
	 * Gets the method of the current HTTP request.
	 *
	 * @return string
	 */
	public static function getMethod()
	{
		return self::$method;
	}

	/**
	 * Gets available header array of the current HTTP-request.
	 *
	 * @return array
	 */
	public static function getHeaders()
	{
		return self::$headers;
	}

	/**
	 * Gets if the request is an AJAX request.
	 *
	 * @return boolean
	 */
	public static function getIsAjax()
	{
		return self::$isAjax;
	}

	/**
	 * Gets server redirect status
	 *
	 * @return string
	 */
	public static function getRedirectStatus()
	{
		return self::$redirectStatus;
	}

	/**
	 * Gets current URL with query
	 *
	 * @return string
	 */
	public static function getCurrentUrl()
	{
		return self::$currentUrl;
	}

	/**
	 * Gets URL referrer if available
	 *
	 * @return string
	 */
	public static function getUrlReferrer()
	{
		return self::$urlReferrer;
	}

	/* PRIVATE METHODS */

	/**
	 * Gets url from $_SERVER variables
	 *
	 * @return string
	 */
	private static function GetUrl()
	{
		if(isset($_SERVER['SCRIPT_URL']))
		{
			return $_SERVER['SCRIPT_URL'];
		}
		elseif(isset($_SERVER['REDIRECT_URL']))
		{
			return $_SERVER['REDIRECT_URL'];
		}
		elseif(isset($_SERVER['REQUEST_URI']))
		{
			return $_SERVER['REQUEST_URI'];
		}

		return null;
	}

	/**
	 * Parses cookies from $_SERVER and adds them to cookies array;
	 */
	private static function ParseCookies()
	{
		foreach($_COOKIE as $key=>$value)
		{
			self::$cookies[$key] = new Cookie($key, $value);
		}
	}

	/**
	 * Parses headers from $_SERVER and adds them to headers array;
	 */
	private static function ParseHeaders()
	{
		foreach($_SERVER as $key=>$value)
		{
			if(strpos($key, 'HTTP_')===0)
			{
				self::$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))))] = $value;
			}
		}
	}
	
	/**
	 * Initialize Request variables
	 */
	private static function InitializeVariables()
	{
		self::$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;
		self::$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? ($_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') : false;
		self::$remoteAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
		self::$redirectStatus = isset($_SERVER['REDIRECT_STATUS']) ? $_SERVER['REDIRECT_STATUS'] : null;
		self::$currentUrl = self::GetUrl();
		self::$urlReferrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
		self::$files = $_FILES;
	}

	/* PUBLIC METHODS */

	/**
	 * Initializes a the Request class.
	 */
	public static function Initialize()
	{
		self::ParseHeaders();
		self::ParseCookies();
		self::InitializeVariables();
	}

	/**
	 * Sets a cookie
	 *
	 * @param Spherus\HttpContext\Cookie $cookie The Cookie object to set
	 * @throws SpherusException When $cooke parameter is null or empty
	 */
	public static function SetCookie(Cookie $cookie)
	{
		Check::IsNullOrEmpty($cookie);

		self::$cookies[$cookie->getName()] = $cookie;
		$expireSeconds = $cookie->getExpires();
		if($expireSeconds>0)
		{
			$expireSeconds = time()+$expireSeconds;
		}

		setcookie($cookie->getName(), $cookie->getValue(), $expireSeconds, $cookie->getPath(), $cookie->getDomain(), $cookie->getSecure(),
				$cookie->getHttpOnly());

		unset($expireSeconds);
		unset($cookie);
	}

	/**
	 * Deletes a cookie
	 *
	 * @param string $cookieName The cookie name to unset
	 */
	public static function DeleteCookie($cookieName)
	{
		if(isset(self::$cookies[$cookieName]))
		{
			unset(self::$cookies[$cookieName]);
			setcookie($cookieName, null, time()-3600);
			unset($cookieName);
		}
	}
}