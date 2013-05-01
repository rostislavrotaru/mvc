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
	/* FIELDS */
	private $splittedRouteUrl = null;
	private $splittedUrl = null;
	private $splittedUrlCount = null;
	private $splittedRouteUrlCount = null;
	private $currentRoute = null;
	private $hasWildCard = false;
	private $predefinedParameters = array(':module', ':controller', ':action');
	private $result = [];
	private $parameters = [];
	
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

		$splittedUrl = preg_split('/\//', parse_url(Request::getCurrentUrl())['path'], null, PREG_SPLIT_NO_EMPTY);

		foreach($registeredRoutes as $route)
		{
			$foundRoute = self::MatchRoute($route, $splittedUrl);
			if($foundRoute !== null)
			{
				return $foundRoute;
				break;
			}
		}
		
		throw new SpherusException(EXCEPTION_NO_ROUTE_FOUND);
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

		$this->splittedUrl = $splittedUrl;
		$this->splittedRouteUrl = preg_split('/\//', $route->getUrl(), null, PREG_SPLIT_NO_EMPTY);
		$this->splittedUrlCount = count($splittedUrl);
		$this->splittedRouteUrlCount = count($this->splittedRouteUrl);
		$this->currentRoute = $route;
		
		if(strpos($route->getUrl(), '*') !== false)
		{
			if(!(boolean)preg_match('~[^\*]+/\*$~', $route->getUrl())) // check if wildcard is the last element
			{
				return null;
			}
			else 
			{
				$this->hasWildCard = true;
			}
		}
		
		//A route template length cannot be greather that the request url when not wildcard
		if($this->hasWildCard === false and $this->splittedRouteUrlCount > $this->splittedUrlCount)
		{
			return null;
		}
		
		// find top elements index that are equal
		$matchedIndex = null;
		for($i = 0; $i < $this->splittedRouteUrlCount; $i++)
		{
			if(isset($splittedUrl[$i]) and ($this->splittedRouteUrl[$i] === $splittedUrl[$i]))
			{
				$matchedIndex = $i;
			}
			else 
			{
				break;
			}
		}

		$counter = isset($matchedIndex) ? ($matchedIndex + 1) : 0;
		
		//parse for parameters and wildcard
		if($this->splittedRouteUrlCount > $this->splittedUrlCount)
		{
			for($i = $counter; $i < $this->splittedRouteUrlCount; $i++)
			{
				if(strpos($this->splittedRouteUrl[$i], ':') !== 0 and $this->splittedRouteUrl[$i] !== '*')// if element is not a parameter or wildcard
				{
					return null;
				}
				else 
				{
					if($this->ParseRouteParameters($i) === null)
					{
						return null;
					}
				}
			}
		}
		else 
		{
			for($i = $counter; $i < $this->splittedUrlCount; $i++)
			{
				if($this->ParseRouteParameters($i) === null)
				{
					return null;
				}
			}
		}
		
		$predefinedParameterDifferences = array_diff_key(array_flip($this->predefinedParameters), $this->result);
		
		//parse the rest of predefined parameters
		foreach ($predefinedParameterDifferences as $key=>$value)
		{
			$methodResult = call_user_func(array($route->getRouteRule(), 'get'.str_replace(':', null, $key)));
			if(isset($methodResult))
			{
				$this->result[$key] = $methodResult;
			}
			else
			{
				$this->result[$key] = Config::getRoutingDefaults()[str_replace(':', null, $key)];
			}
		}
		
		//unset unused variables
		unset($route);
		unset($splittedUrl);
		unset($matchedIndex);
		unset($i);
		unset($counter);
		unset($predefinedParameterDifferences);
		
		$query = isset(parse_url(Request::getCurrentUrl())['query']) ? parse_url(Request::getCurrentUrl())['query'] : null;
		
		return new ParsedUrl($this->result[':module'], $this->result[':controller'], $this->result[':action'], $this->parameters, $this->currentRoute, $query);
	}
	
	/**
	 * Parse route parameters
	 * 
	 * @param integer $i The parsing iterator
	 * @return NULL|true Null when entire route is not matched or true if iterator was successful.
	 */
	private function ParseRouteParameters($i)
	{
		if(isset($this->splittedRouteUrl[$i]))
		{
			if(strpos($this->splittedRouteUrl[$i], ':') === 0) //is parameter
			{
				//if predefined parameters
				if(in_array($this->splittedRouteUrl[$i], $this->predefinedParameters))
				{
					$this->result[$this->splittedRouteUrl[$i]] = isset($this->splittedUrl[$i]) ? $this->splittedUrl[$i] : Config::getRoutingDefaults()[str_replace(':', null, $this->splittedRouteUrl[$i])];
				}
				else //additional parameters
				{
					$routeParameter = $this->currentRoute->GetRouteParameterByName($this->splittedRouteUrl[$i]);
					if(isset($routeParameter))
					{
						if(preg_match($routeParameter->getValue(), $this->splittedUrl[$i]))
						{
							$this->result[$this->splittedRouteUrl[$i]] = $this->splittedUrl[$i];
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
				if(isset($this->splittedUrl[$i]))
				{
					$this->parameters[] = $this->splittedUrl[$i];
				}
			}
		}
		else 
		{
			if(isset($this->splittedUrl[$i]))
			{
				$this->parameters[] = $this->splittedUrl[$i];
			}
		}
		
		return true;
	} 

}