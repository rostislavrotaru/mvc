<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Routing;

	use Spherus\Core\SpherusException;
	use Spherus\Core\Check;
	use App\Common\Config;

	/**
	 * Defines a Route Handler class
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.routing
	 */
	class RouteManager
	{

		/* FIELDS */

		/**
		 * Contains array of registered routes.
		 *
		 * @var array
		 */
		private static $registeredRoutes = array();

		/**
		 * Contains the current router object
		 *
		 * @var IRouter
		 */
		private static $router = null;

		/* PROPERTIES */

		/**
		 * Gets the current router object
		 *
		 * @return Spherus\Interfaces\IRouter
		 */
		public static function getRouter()
		{
			return self::$router;
		}

		/**
		 * Gets array of registered routes.
		 *
		 * @return array
		 */
		public static function getRegisteredRoutes()
		{
			return RouteManager::$registeredRoutes;
		}

		/* PUBLIC FUNCTIONS */

		/**
		 * Initialize Router object according to the configuration files
		 */
		public static function Initialize()
		{
			$router = Config::getRoutingDefaults()['router'];
			if(isset($router))
			{
				self::$router = new $router();
				self::$router->Initialize();

				// Check if router implements IRouter interface
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
		 * @throws SpherusException When route name is null or empty
		 */
		public static function RegisterRoute(Route $route)
		{
			Check::IsNullOrEmpty($route);
			Check::IsNullOrEmpty($route->getName());

			$foundRoute = self::GetRouteByName($route->getName());
			if(isset($foundRoute))
			{
				throw new SpherusException(sprintf(EXCEPTION_DUPLICATE_ROUTE, $route->getName()));
			}
			else
			{
				self::$registeredRoutes[] = $route;
			}

			unset($foundRoute);
			unset($route);
		}

		/**
		 * Gets route by name
		 *
		 * @param string $routeName The name of route to find.
		 * @return Spherus\Routing\IRoute NULL
		 */
		public static function GetRouteByName($routeName)
		{
			foreach(self::$registeredRoutes as $registeredRoute)
			{
				if($registeredRoute->getName()==$routeName)
				{
					return $registeredRoute;
				}
			}

			return null;
		}
	}