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

/**
 * Defines a Route object class
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.routing
 */
class RouteRule
{

	/* CONSTRUCTOR */

	/**
	 * Initializes a new instance of Route class.
	 *
	 * @param string $module The route module name, optional
	 * @param string $controller The route controller name, optional
	 * @param string $action The route action name, optional
	 * @param mixed string|array $staticParameters One or an array of parameters
	 */
	public function __construct($module = null, $controller = null, $action = null, $staticParameters = null)
	{
		$this->module = $module;
		$this->controller = $controller;
		$this->action = $action;
		
		if(isset($staticParameters))
		{
			if(is_array($staticParameters))
			{
				$this->staticParameters = $staticParameters;
			}
			else
			{
				$this->staticParameters[] = $staticParameters;
			}
		}
		
	}

	/* FIELDS */

	/**
	 * Defines the route module name
	 *
	 * @var string
	 */
	private $module;

	/**
	 * Defines the route controller name
	 *
	 * @var string
	 */
	private $controller;

	/**
	 * Defines the route action name
	 *
	 * @var string
	 */
	private $action;

	/**
	 * Defines the static parameters
	 *
	 * @var array
	 */
	private $staticParameters = null;


	/* PROPERTIES */

	/**
	 *
	 * @return Route Rule module name
	 * @var string
	 */
	public function getModule()
	{
		return $this->module;
	}

	/**
	 *
	 * @return Route controller name
	 * @var string
	 */
	public function getController()
	{
		return $this->controller;
	}

	/**
	 *
	 * @return Route action name
	 * @var string
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 *
	 * @return Route static parameters
	 * @var mixed, array|null
	 */
	public function getStaticParameters()
	{
		return $this->staticParameters;
	}

}