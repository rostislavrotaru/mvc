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

use App\Common\Config;
use Spherus\Interfaces\IRouter;
use Spherus\Core\SpherusException;
use Spherus\HttpContext\Request;
use Spherus\Core\Check;

/**
 * Defines a default router class.
 * Used for standard routing.
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @author Sergey Calugher (SlKelevro@gmail.com)
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
		$registeredRoutes = RouteManager::getRegisteredRoutes();
		Check::IsNullOrEmpty($registeredRoutes);

		$foundRoute = null;
		$splittedUrl = preg_split('/\//', Request::getCurrentUrl(), null, PREG_SPLIT_NO_EMPTY);

		if((boolean)$splittedUrl)
		{
			foreach($registeredRoutes as $route)
			{
				$matchedIndex = self::MatchRoute($route, $splittedUrl);
				if(isset($matchedIndex))
				{
					$foundRoute = $route;
					break;
				}
			}
		}

		if($foundRoute==null)
		{
			$foundRoute = RouteManager::GetRouteByName(Config::getRoutingDefaults()['default_route_name']);
		}

		Check::IsNullOrEmpty($foundRoute);
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
		RouteManager::RegisterRoute(new Route(Config::getRoutingDefaults()['default_route_name'], '/', 'main'));
	}

	/**
	 * Determine if given route matches given splitted url
	 *
	 * @param Spherus\Routing\IRoute $route The route to parse.
	 * @param array $splittedUrl url splitted into parts.
	 * @return NULL Ambigous number> Matched splitted url index or null if route isn't matching.
	 */
	private function MatchRoute($route, $splittedUrl)
	{
		if(strpos($route->getUrl(), '/') > 0)
		{
			return null;
		}

		$splittedRouteUrl = preg_split('/\//', $route->getUrl(), null, PREG_SPLIT_NO_EMPTY);
		$splittedUrlCount = count($splittedUrl);
		$splittedRouteUrlCount = count($splittedRouteUrl);

		if($splittedRouteUrlCount > $splittedUrlCount)
		{
			return null;
		}

		if(strpos($route->getUrl(), '*')!==false)
		{
			// check if wilcard is the last element
			if(!(boolean)preg_match('~[^\*]+/\*$~', $route->getUrl()))
			{
				return null;
			}
		}

		// find top elements index that are equal
		$matchedIndex = null;
		for($i = 0; $i<$splittedRouteUrlCount; $i++)
		{
			if($splittedRouteUrl[$i]==$splittedUrl[$i])
			{
				$matchedIndex = $i;
			}
		}

		// if found some top elements equality
		if(isset($matchedIndex))
		{
			for($i = $matchedIndex+1; $i<$splittedRouteUrlCount; $i++)
			{
				if((strpos($splittedRouteUrl[$i], ':')!==0)||($splittedRouteUrl[$i]!=='*'))
				{
					// if element is not a parameter or wilcard
					return null;
				}
			}
		}

		unset($splittedRouteUrl);
		unset($splittedUrlCount);
		unset($splittedRouteUrlCount);

		return $matchedIndex;
	}
}