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

use Spherus\Core\Check;
use Spherus\Core\SpherusException;

/**
 * Defines a Route object class
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.routing
 */
class Route
{

	/* CONSTRUCTOR */

	/**
	 * Initializes a new instance of Route class.
	 *
	 * @param string $url The route url
	 * @param RouteRule $routeRule The Route rule
	 * @param array $routeParameters The Route Parameters. Optional. Default is null.
	 * 
	 * @throws SpherusException When $url parameter is null or empty
	 * @throws SpherusException When $routeRule parameter is null or empty
	 */
	public function __construct($url, $routeRule = null, $routeParameters = null)
	{
		Check::IsNullOrEmpty($url);

		$this->url = $url;
		$this->routeRule = (!isset($routeRule)) ? new RouteRule() : $routeRule;
		$this->routeParameters = $routeParameters;
	}

	
	/* FIELDS */

	/**
	 * Defines the route url
	 *
	 * @var string
	 */
	private $url = null;

	/**
	 * Defines the route rule
	 *
	 * @var RouteRule
	 */
	private $routeRule = null;
	
	/**
	 * Defines the route parameters
	 *
	 * @var array
	 */
	private $routeParameters = null;


	/* PROPERTIES */
	
	/**
	 *	Gets route url
	 *
	 * @var string
	 */
	public function getUrl()
	{
		return $this->url;
	}
	
	/**
	 * Gets route rule
	 *
	 * @return RouteRule
	 */
	public function getRouteRule()
	{
		return $this->routeRule;
	}
	
	/**
	 * Gets the route parameters
	 *
	 * @var array
	 */
	public function getRouteParameters()
	{
		return $this->routeParameters;
	}

	
	/* PUBLIC FUNCTIONS */
	
	/**
	 * Gets RouteParameter by it's parameter name
	 * 
	 * @param string $name The name of parameter
	 * @return RouteParameter|NULL The RouteParameter object or null if not found.
	 */
	public function GetRouteParameterByName($name)
	{
		if(isset($this->routeParameters))
		{
			foreach($this->routeParameters as $routeParameter)
			{
				if($routeParameter->getName() === $name)
				{
					return $routeParameter;
				}
			}
		}
		
		return null;
	} 
	
}