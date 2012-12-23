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
		use Spherus\Core\Check;
		use Spherus\Routing\RouteManager;
		use Spherus\Routing\Route;
		use Spherus\Core\ResponseStatusType;

		/**
		* Class that represents the http response object
		*
		* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		* @package spherus.httpcontext
		*/
		class Response
		{

			/* FIELDS */
			
			/**
			 * Defines the HTTP response status.
			 *
			 * @var Spherus\Core\ResponseStatusType
			 */
			private static $status = ResponseStatusType::OK;
			
			
			/* PROPERTIES */
			
			/**
			 * Gets the HTTP response status.
			 *
			 * @return Spherus\Core\ResponseStatusType
			 */
			public static function getStatus() 
			{
				return self::$status;
			}			
			
			
			/* PUBLIC FUNCTIONS */
			
			/**
			 * Sends server header
			 * 
			 * @param string $name The name of header to send
			 * @param string $value The value of header to send
			 * 
			 * @return boolean True if header sent, otherwise false
			 * @throws SpherusException When $name parameter is null or empty
			 * @throws SpherusException When $value parameter is null or empty
			 */
			public static function SendHeader($name, $value)
			{
				Check::IsNullOrEmpty($name);
				Check::IsNullOrEmpty($value);
				
				if(headers_sent() === false)
				{
					header($name.': '.$value);
					return true;
				}
				
				return false;
			}
			
			/**
			 * Sends header response status
			 * 
			 * @param Spherus\Core\ResponseStatusType $responseStatusType The response status to send
			 */
			public static function SendHeaderResponseStatus($responseStatusType)
			{
				self::SendHeader(HttpContext::$serverProtocol, $responseStatusType);
			} 			
				
			/**
			 * Redirects browser to the specified route
			 *
			 * @param string $action The action to redirect to
			 * @param string $controller The controller to redirect to. If null, then current controller will be used
			 * @param string $module The module to redirect to. If null, then current module will be used
			 * @param string $parameters The redirection parameters. Optional
			 * @throws SpherusException When $action parameter is null or empty
			 */
			public static function Redirect($action, $controller = null, $module = null, $parameters = array())
			{
				Check::IsNullOrEmpty($action);
				
				$url = null;
				$route = RouteManager::GetRoute(new Route(null, $module, $controller, $action, $parameters));
				if(!isset($route))
				{
					if(!isset($module))
					{
						$module = HttpContext::getParsedUrl()->getModuleName();
					}
					if(!isset($controller))
					{
						$controller = HttpContext::getParsedUrl()->getControllerName();
					}
					$url = '/'.$module.'/'.$controller.'/'.$action;
					if(isset($parameters))
					{
						Check::IsArray($parameters);
						
						foreach ($parameters as $key=>$value)
						{
							$url .= '/'.$value;
						}
					}
				}
				else
				{
					$url = $route->getUrl();
				}
				
				if(isset($url))
				{
					if (self::SendHeader('Location', $url) === true);
					exit();
				}
				
				throw new SpherusException(EXCEPTION_NO_ROUTE_TO_REDIRECT);
			}
			
			/**
			 * Redirects browser to the specified url
			 * 
			 * @param string $url The url to redirect
			 * @throws SpherusException When $url parameter is null or empty
			 */
			public static function RedirectToUrl($url)
			{
				Check::IsNullOrEmpty($url);
				
				if (self::SendHeader('Location', $url) === true);
				exit();
			}
		
			/**
			 * Sets browser cache in seconds
			 * 
			 * @param int $expireSeconds The time in seconds to cache expiration
			 * @throws SpherusException When $expireSeconds is null or empty, or is not an integer value
			 */
			public static function SetCache($expireSeconds)
			{
				Check::IsInteger($expireSeconds);
				
				if ($expireSeconds > 0)
				{
					self::SendHeader('Expires', gmdate('D, d M Y H:i:s', time() + $expireSeconds).' GMT');
					self::SendHeader('Pragma', 'cache');
					self::SendHeader('Cache-Control', 'max-age='.$expireSeconds);
					
					unset($expireSeconds);
				}
			}
			
			/**
			 * Clears browser cache
			 */
			public static function ClearCache()
			{
				$currentTimeStamp = gmdate('D, d M Y H:i:s').' GMT';
				self::SendHeader('Expires', $currentTimeStamp);
				self::SendHeader('Last-Modified', $currentTimeStamp);
				self::SendHeader('Pragma', 'no-cache');
				self::SendHeader('Cache-Control', 'no-cache, must-revalidate');
				
				unset($currentTimeStamp);
			}
		
		}
		
	}

?>