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

		use Spherus\Interfaces\IRouter,
			Spherus\HttpContext\Request,
			Spherus\HttpContext\ParsedUrl,
			Spherus\Core\SpherusException,
			Spherus\Core\Check;

		/**
		* Defines a default router class. Used for standard routing.
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

				$foundRoute = self::GetRouteByUrl(Request::getCurrentUrl());					
				$pathPortions = preg_split('/\//', Request::getCurrentUrl(), null, PREG_SPLIT_NO_EMPTY);
				
				$parameters = array();
				for($i = 3; $i < count($pathPortions); $i++)
				{
					$parameters[] = $pathPortions[$i];
				}
				
				$result = new ParsedUrl(
					isset($pathPortions[0]) ? $pathPortions[0] : \Config::getRoutingDefaults()['module'],
					isset($pathPortions[1]) ? $pathPortions[1] : \Config::getRoutingDefaults()['controller'],
					isset($pathPortions[2]) ? $pathPortions[2] : \Config::getRoutingDefaults()['action'],
					$parameters,
					$foundRoute);

					
				
				
				//Unset all unnecessary variables
				unset($pathPortions);
				unset($parameters);
				unset($foundRoute);
				unset($urlPath);
				unset($i);
				unset($pathPortions);
				
				return $result;
			}
			
			/* (non-PHPdoc)
			* @see \Spherus\Interfaces\IRouter::Initialize()
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
				RouteManager::RegisterRoute(new Route(\Config::getRoutingDefaults()['default_route_name'], '{controller}/{action}/{parameters}'));
			}
			
			private function GetRouteByUrl($url)
			{
			    $urlPath = parse_url($url, PHP_URL_PATH);
			    
			    if(!isset($foundRoute)) //trying to find default route
			    {
			        $foundRoute = RouteManager::GetRouteByName(\Config::getRoutingDefaults()['default_route_name']);
			        if(!isset($foundRoute))
			        {
			            throw new SpherusException(EXCEPTION_DEFAULT_ROUTE_NOT_FOUND);
			        }
			        return $foundRoute;
			    }
			    
				return null;
			}
		
		}
	}
?>