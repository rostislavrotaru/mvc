<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/

	namespace Spherus\HttpContext
	{
	
		use Spherus\Core\SpherusException;
		use Spherus\Routing\RouteManager;

		/**
		* Class that represents the http context object
		*
		* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		* @package spherus.httpcontext
		*/
		class HttpContext
		{
			
			/* CONSTRUCTOR */
			
			/**
			 * Initializes HTTPContext class with base variables
			 */
			public static function Initialize()
			{
				Request::Initialize();
				self::$serverProtocol = $_SERVER["SERVER_PROTOCOL"];
				self::$isSecured = empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off' ? false : true;
			}
			
			
			/* FIELDS */
			
			/**
			 * Defines if server HttpContext is secured (HTTPS)
			 * @var boolean
			 */
			private static $isSecured = false;
			
			/**
			 * Defines the server protocol
			 * 
			 * @var string
			 */
			private static $serverProtocol = null;
			
			/**
			 * Contains rendered view page content
			 * @var string
			 */
			private static $pageContent = null; 
			
			/**
			 * Defines RouteHandler url parsing result
			 * @var Spherus\HttpContext\ParsedUrl
			 */
			private static $parsedUrl = null;
			
			/* PROPERTIES */
			
			/**
			 * Gets the server http request is secured
			 * @return boolean
			 */
			public static function getIsSecured()
			{
				return self::$isSecured;
			}
			
			/**
			 * Gets the server protocol
			 * @return string
			 */
			public static function getServerProtocol()
			{
				return self::$serverProtocol;
			}
			
			/**
			 * Gets RouteHandler url parsing result
			 * @return Spherus\HttpContext\ParsedUrl
			 */
			public static function getParsedUrl()
			{
				return self::$parsedUrl;
			}

			/**
			 * Gets the rendered page content
			 * @return string
			 */
			public static function getPageContent()
			{
				return HttpContext::$pageContent;
			}
			
			/**
			 * Set the rendered page content
			 * @param string $pageContent The page content to set
			 */
			public static function setPageContent($pageContent)
			{
				HttpContext::$pageContent = $pageContent;
			}
			
			/**
			 * Set the parsed url to http context
			 * @param array $parsedUrl The parsed url to set
			 */
			public static function setParsedUrl($parsedUrl)
			{
			    self::$parsedUrl = $parsedUrl;
			}
			
		}	

	}

?>