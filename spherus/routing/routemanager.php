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
		
			
			/* PROPERTIES */
			
			/**
			 * Gets the current router object
			 * @return Spherus\Interfaces\IRouter
			 */
			public static function getRouter()
			{
				return self::$router;
			}

			/* PUBLIC FUNCTIONS */
			
			/**
			 * Initialize RouteHandler object functionality
			 */
			public static function Initialize()
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
			        self::$router->Initialize();
			        
			        //Check if router implements IRouter interface
			        Check::IsInstanceOf(self::$router, 'Spherus\\Interfaces\\IRouter');
			        
			        unset($router);
			    }
			    else
			    {
			        throw new SpherusException(EXCEPTION_INVALID_ROUTER_CONFIG);
			    }
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
			
		}
	
	}

?>