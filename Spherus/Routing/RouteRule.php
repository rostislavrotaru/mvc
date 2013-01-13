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
	 * @param array $parameters The route parameters name, optional
	 */
	public function __construct($module = null, $controller = null, $action = null, $parameters = null)
	{
		$this->module = $module;
		$this->controller = $controller;
		$this->action = $action;
		$this->parameters = $parameters;
	}

	/* CONSTANTS */

	const PARAMETER_NUMBER = 1;
	const PARAMETER_STRING = 2;
	const PARAMETER_REGEX = 4;

	/* FIELDS */

	/**
	 * Defines the route module name
	 *
	 * @var string
	 */
	var $module;

	/**
	 * Defines the route controller name
	 *
	 * @var string
	 */
	var $controller;

	/**
	 * Defines the route action name
	 *
	 * @var string
	 */
	var $action;

	/**
	 * Defines the route parameters
	 *
	 * @var mixed, array|null
	 */
	var $parameters = null;

	/* PROPERTIES */

	/**
	 *
	 * @return Route module name
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
	 * @return Route parameters
	 * @var mixed, array|null
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

	/* PUBLIC FUNCTIONS */

	public function AddParameter($parameterName, $parameterType, $parameterValue = null)
	{
		Check::IsNullOrEmpty($parameterName);
		Check::IsNullOrEmpty($parameterType);
		if($parameterType & $this::PARAMETER_REGEX)
		{
			Check::IsNullOrEmpty($parameterValue);
			$this->parameters[$parameterName][$this::PARAMETER_REGEX] = $parameterValue;
		}

		if($parameterType & $this::PARAMETER_NUMBER)
		{
			$this->parameters[$parameterName][$this::PARAMETER_NUMBER] = null;
		}

		if($parameterType & $this::PARAMETER_STRING)
		{
			$this->parameters[$parameterName][$this::PARAMETER_STRING] = null;
		}
	}
}