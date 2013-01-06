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

	use Spherus\Interfaces\IRouter;
	use Spherus\HttpContext\Request;
	use Spherus\HttpContext\ParsedUrl;
	use Spherus\Core\SpherusException;
	use Spherus\Core\Check;

	/**
	 * Defines a default router class.
	 * Used for standard routing.
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.routing
	 */
	class DefaultRouter implements IRouter
	{

		/* PUBLIC METHODS */

		/**
		 * Parses url into module, controller, action and parameters
		 *
		 * @return array Array of parsed url(module, controller, action and parameters)
		 * @throws SpherusException When $currentUrl is null or empty
		 * @throws SpherusException When default route is not found
		 */
		public function Parse()
		{
			Check::IsNullOrEmpty(Request::getCurrentUrl());

			$foundRoute = self::GetRouteByUrl(Request::getCurrentUrl(), null, null, null);
			$pathPortions = preg_split('/\//', Request::getCurrentUrl(), null, PREG_SPLIT_NO_EMPTY);

			$parameters = array();
			for($i = 3; $i<count($pathPortions); $i++)
			{
				$parameters[] = $pathPortions[$i];
			}

			$module = $foundRoute->getModule();
			$controller = $foundRoute->getController();
			$action = $foundRoute->getAction();

			$rrr = \Config::getRoutingDefaults()['controller'];

			$result = new ParsedUrl(isset($module) ? $module : (isset($pathPortions[0]) ? $pathPortions[0] : \Config::getRoutingDefaults()['module']),
					isset($controller) ? $controller : (isset($pathPortions[1]) ? $pathPortions[1] : \Config::getRoutingDefaults()['controller']),
					isset($action) ? $action : (isset($pathPortions[2]) ? $pathPortions[2] : \Config::getRoutingDefaults()['action']), $parameters,
					$foundRoute);

			// Unset all unnecessary variables
			unset($pathPortions);
			unset($parameters);
			unset($foundRoute);
			unset($urlPath);
			unset($i);
			unset($pathPortions);

			return $result;
		}

		/*
		* (non-PHPdoc) @see \Spherus\Interfaces\IRouter::Initialize()
		*/
		public function Initialize()
		{
			self::RegisterDefaultRoute();
		}


		/* PRIVATE METHODS */

		/**
		 * Registers default route
		 */
		private function RegisterDefaultRoute()
		{
			RouteManager::RegisterRoute(new Route(\Config::getRoutingDefaults(), '/', 'main'));
		}

		/**
		 *
		 * @param string $url URL to parse
		 * @throws SpherusException When default route not found.
		 * @return Ambigous \Spherus\Routing\IRoute|NULL
		 */
		private function GetRouteByUrl($url)
		{
			$pathPortions = preg_split('/\//', $url, null, PREG_SPLIT_NO_EMPTY);
			$registeredRoutes = RouteManager::getRegisteredRoutes();

			foreach($pathPortions as $pathPortion)
			{
				foreach($registeredRoutes as $route)
				{
					preg_match('/'.$pathPortion.'/', $route->getUrl(), $match);
					if($match)
					{
						return $route;
					}
				}
			}

			if(!isset($foundRoute)) // trying to find default route
			{
				$foundRoute = RouteManager::GetRouteByName(\Config::getRoutingDefaults());
				if(isset($foundRoute))
				{
					return $foundRoute;
				}
				throw new SpherusException(EXCEPTION_DEFAULT_ROUTE_NOT_FOUND);
			}

			return null;
		}
	}