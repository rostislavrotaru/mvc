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
use Spherus\HttpContext\ParsedUrl;

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
				$routeMatchIndex = self::MatchRoute($route, $splittedUrl);
				if($routeMatchIndex !== null)
				{
					$foundRoute = $route;
					break;
				}
			}
		}

		if($foundRoute==null)
		{
			$foundRoute = RouteManager::GetRouteByUrl(Config::getRoutingDefaults()['default_route']);
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
		RouteManager::RegisterRoute(new Route('/:controller/:action/*', new RouteRule('main')));
		RouteManager::RegisterRoute(new Route('/account/:id', new RouteRule('main', 'users', 'view'), array(new RouteParameter(':id', '/^\d+$/'))));
	}

	/**
	 * Determine if given route matches given splitted url
	 *
	 * @param Route $route The route to parse.
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
		
		$result = [];
		$predefinedParameters = array(':module', ':controller', ':action');
		
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

		unset($matchedIndex);
		
		$parameters = [];
		
		//parse for parameters and wildcard
		for($i = $counter; $i < $splittedRouteUrlCount; $i++)
		{
			if(strpos($splittedRouteUrl[$i], ':') !== 0 and $splittedRouteUrl[$i] !== '*')// if element is not a parameter or wildcard
			{
				return null;
			}
			else 
			{
				if(strpos($splittedRouteUrl[$i], ':') === 0) //is parameter
				{
					//if predefined parameters
					if(in_array($splittedRouteUrl[$i], $predefinedParameters))
					{
						$result[$splittedRouteUrl[$i]] = isset($splittedUrl[$i]) ? $splittedUrl[$i] : Config::getRoutingDefaults()[str_replace(':', null, $splittedRouteUrl[$i])];
					}
					else //additional parameters
					{
						$routeParameter = $route->GetRouteParameterByName($splittedRouteUrl[$i]);
						if(isset($routeParameter))
						{
							if(preg_match($routeParameter->getValue(), $splittedUrl[$i]))
							{
								$result[$splittedRouteUrl[$i]] = $splittedUrl[$i];
							}
							else 
							{
								return null;
							}
						}
						else
						{
							return null;
						}
					}
				}
				else 
				{
					$parameters[] = $splittedUrl[$i];
				}
			}
		}
		
		$predefinedParameterDifferences = array_diff_key(array_flip($predefinedParameters), $result);
		
		//parse the rest of predefined parameters
		foreach ($predefinedParameterDifferences as $key=>$value)
		{
			$methodResult = call_user_func(array($route->getRouteRule(), 'get'.str_replace(':', null, $key)));
			if(isset($methodResult))
			{
				$result[$key] = $methodResult;
			}
			else
			{
				$result[$key] = Config::getRoutingDefaults()[str_replace(':', null, $key)];
			}
		}

		//unset unused variables
		unset($key);
		unset($value);
		unset($splittedRouteUrl);
		unset($splittedRouteUrlCount);
		unset($splittedUrl);
		unset($splittedUrlCount);
		unset($counter);
		unset($predefinedParameterDifferences);
		unset($predefinedParameters);
		unset($i);
		unset($methodResult);

		return new ParsedUrl($result[':module'], $result[':controller'], $result[':action'], $parameters, $route);
	}

}