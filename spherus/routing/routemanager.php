<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/

	namespace Spherus\Routing
	{

		use Spherus\HttpContext\Request;
		use Spherus\HttpContext\ParsedUrl;
		use Spherus\Core\SpherusException;
		use Spherus\Core\Check;
		
		/**
		* Defines a Route Handler class
		*
		* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		* @package spherus.routing
		*
		*/
		class RouteManager
		{
			
			/* FIELDS */
			
			/**
			 * Contains array of registered routes.
			 * @var array
			 */
			private static $registeredRoutes = array();
			
			/**
			 * Contains the current router object
			 * @var IRouter
			 */
			private static $router = null;
		
			
			/* PUBLIC FUNCTIONS */
			
			/**
			 * Initialize RouteHandler object functionality
			 */
			public static function Initialize()
			{
				self::InitializeRouter();
				self::RegiterDefaultRoute();
			}
			
			/**
			 * Register a route to the Routes collection
			 * 
			 * @param Route $route The Route object to register
			 * @throws SpherusException When $route parameter is null or empty
			 */
			public static function RegisterRoute(Route $route)
			{
				Check::IsNullOrEmpty($route);
				
				$foundRoute = self::GetRouteByUrl($route->getUrl());
				if(!isset($foundRoute))
				{
					self::$registeredRoutes[] = $route;
				}
				
				//Unset all unnecessary variables
				unset($route);
				unset($foundRoute);
			}
		
			/**
			 * Registers default framework route
			 */
			public static function RegiterDefaultRoute()
			{
				self::RegisterRoute(new Route('/'));
			}
			
			/**
			* Parses url into module, controller, action and parameters
			*
			* @return array Array of parsed url(module, controller, action and parameters)
			* @throws SpherusException When $currentUrl parameter is null or empty
			* @throws SpherusException When default route is not found
			*/
			public static function Parse()
			{
				$currentUrl = Request::getCurrentUrl();
				Check::IsNullOrEmpty($currentUrl);
		
				$urlPath = parse_url($currentUrl, PHP_URL_PATH);
				$foundRoute = RouteManager::GetRouteByUrl($urlPath);
				
				if(!isset($foundRoute))
				{
					$foundRoute = self::GetRouteByUrl('/');
				}
				
				if(!isset($foundRoute))
				{
					throw new SpherusException(EXCEPTION_DEFAULT_ROUTE_NOT_FOUND);
				}
				
				$pathPortions = preg_split('/\//', $urlPath, null, PREG_SPLIT_NO_EMPTY);
				
				$parameters = array();
				for($i = 3; $i < count($pathPortions); $i++)
				{
					$parameters[] = $pathPortions[$i];
				}
				
				$result = new ParsedUrl(
					isset($pathPortions[0]) ? $pathPortions[0] : \Config::$routingDefaults['module'],
					isset($pathPortions[1]) ? $pathPortions[1] : \Config::$routingDefaults['controller'],
					isset($pathPortions[2]) ? $pathPortions[2] : \Config::$routingDefaults['action'],
					$parameters,
					$foundRoute);

					
				
				
				//Unset all unnecessary variables
				unset($pathPortions);
				unset($parameters);
				unset($foundRoute);
				unset($currentUrl);
				unset($urlPath);
				unset($i);
				unset($pathPortions);
				
				return $result;
			}

			/**
			 * Gets Route object by its url
			 * 
			 * @param string $routeUrl The route url
			 * @return Route|null
			 * @throws SpherusException When $route url parameter is null or empty
			 */
			public static function GetRouteByUrl($routeUrl)
			{
				Check::IsNullOrEmpty($routeUrl);
				
				foreach (self::$registeredRoutes as $registeredRoute)
				{
					if($registeredRoute->getUrl() == $routeUrl)
					{
						return $registeredRoute;
					}
				}
			
				return null;
			}
		
			/**
			 * Gets Route object from registered routes collection
			 * 
			 * @param Route $route The Route object to search
			 * @return Route|null
			 * @throws SpherusException When $route parameter is null or empty
			 */
			public static function GetRoute($route)
			{
				Check::IsNullOrEmpty($route);
				
				foreach (self::$registeredRoutes as $registeredRoute)
				{
					if($registeredRoute->module == $route->module && $registeredRoute->controller == $route->controller && $registeredRoute->action == $route->action)
					{
						return $registeredRoute;
					}
				}
				
				return null;
			}
			
			
			/* PRIVATE METHODS*/
			
			/**
			 * Initializes router object indicated in configuration file.
			 * 
			 * @throws SpherusException When router configuration is invalid.
			 * @throws SpherusException When router not implemets IRouter interface.
			 */
			private static function InitializeRouter()
			{
			    $router = \Config::getRoutingDefaults()['router'];
			    if(isset($router))
			    {
			        //Check if default router should be used
			        if($router == 'Spherus\Routing\DefaultRouter')
			        {
			            require(ROUTING.'defaultrouter.php');
			        }
			        self::$router = new $router;
			        
			        //Check if router implements IRouter interface
			        Check::IsInstanceOf(self::$router, 'Spherus\\Interfaces\\IRouter');
			    }
			    else
			    {
			        throw new SpherusException(EXCEPTION_INVALID_ROUTER_CONFIG);
			    }
			}
		
		}
	
	}

?>