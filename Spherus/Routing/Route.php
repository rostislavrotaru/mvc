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
	 * @param string $name The route name
	 * @param string $url The route url
	 * @throws SpherusException When $url parameter is null or empty
	 */
	public function __construct($name, $url, $routeRules = null)
	{
		Check::IsNullOrEmpty($url);

		$this->name = $name;
		$this->url = $url;
		if(isset($routeRules))
		{
			is_array($routeRules) ? $this->routeRules = array_merge($this->routeRules, $routeRules) : $this->routeRules[] = $routeRules;
		}
	}

	/* FIELDS */

	/**
	 * Defines the route name
	 *
	 * @var string
	 */
	private $name = null;

	/**
	 * Defines the route url
	 *
	 * @var string
	 */
	private $url = null;

	/**
	 * Defines a list of route rules
	 *
	 * @var mixed Array or single object of RouteRule.
	 */
	private $routeRules = [];


	/* PROPERTIES */

	/**
	 * Gets the route name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 *
	 * @return Route url
	 * @var string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/* PUBLIC FUNCTIONS */

	/**
	 * Add a route rule
	 *
	 * @param Spherus\Routing\RouterUle $routeRule The route rule to add.
	 * @throws SpherusException When $routeRule is not an instance of 'Spherus\Routing\RouteRule'
	 */
	public function AddRule($routeRule)
	{
		Check::IsInstanceOf($routeRule, 'Spherus\Routing\RouteRule');
		$this->routeRules[] = $routeRule;
	}

}