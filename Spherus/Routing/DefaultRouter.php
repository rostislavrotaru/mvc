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
				if(self::MatchRoute($route, $splittedUrl) === true)
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
		$route = new Route(Config::getRoutingDefaults()['default_route_name'], '/');
		$route->AddRule(new RouteRule('main', null, null, ':param', RouteRule::PARAMETER_REGEX, '~[^\*]+/\*$~'));
		$route->AddRule(new RouteRule(null, 'test', null, ':param', RouteRule::PARAMETER_STRING));

		RouteManager::RegisterRoute($route);
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
		//if route url is not beginnign with slash
		if(strpos($route->getUrl(), '/') > 0)
		{
			return null;
		}

		$splittedRouteUrl = preg_split('/\//', $route->getUrl(), null, PREG_SPLIT_NO_EMPTY);
		$splittedUrlCount = count($splittedUrl);
		$splittedRouteUrlCount = count($splittedRouteUrl);

		//A route template length cannot be greather that the request url
		if($splittedRouteUrlCount > $splittedUrlCount)
		{
			return null;
		}

		if(strpos($route->getUrl(), '*') !== false)
		{
			if(!(boolean)preg_match('~[^\*]+/\*$~', $route->getUrl())) // check if wildcard is the last element
			{
				return null;
			}
		}

		// find top elements index that are equal
		$matchedIndex = null;
		for($i = 0; $i < $splittedRouteUrlCount; $i++)
		{
			if($splittedRouteUrl[$i] == $splittedUrl[$i])
			{
				$matchedIndex = $i;
			}
		}

		$counter = 0;
		if(isset($matchedIndex))
		{
			$counter = $matchedIndex + 1;
		}

		//parse for parameters and wildcard
		for($i = $counter; $i < $splittedRouteUrlCount; $i++)
		{
			if(strpos($splittedRouteUrl[$i], ':') !== 0 and $splittedRouteUrl[$i] !== '*')// if element is not a parameter or wildcard
			{
				return null;
			}
		}

		//unset unused variables
		unset($splittedRouteUrl);
		unset($splittedUrlCount);
		unset($splittedRouteUrlCount);
		unset($counter);
		unset($route);

		return $matchedIndex;
	}
}