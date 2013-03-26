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
class RouteRule
{

	/* CONSTRUCTOR */

	/**
	 * Initializes a new instance of Route class.
	 *
	 * @param string $module The route module name, optional
	 * @param string $controller The route controller name, optional
	 * @param string $action The route action name, optional
	 * @param string $parameterName The name of parameter,
	 * @param string $parameterType The parameter type (taken from constants)
	 * @param string $parameterValue The parameter value. Optional.
	 * @throws SpherusException When $parameterName is null or empty.
	 * @throws SpherusException When $parameterType is regex and $parameterValue is null or empty.
	 * @throws SpherusException When one of the following parameters is not set: $module or $controller or $action
	 */
	public function __construct($module = null, $controller = null, $action = null, $parameterName = null, $parameterType = null, $parameterValue = null)
	{
		if(!isset($module) and !isset($controller) and !isset($action))
		{
			throw new SpherusException(EXCEPTION_ROUTE_RULE_CONSTRUCTOR_PARAMETERS_NOT_SET);
		}
		
		$parameterType = isset($parameterType) ? $this::PARAMETER_STRING : $parameterType;
		$parameterType===$this::PARAMETER_REGEX ? Check::IsNullOrEmpty($parameterValue) : null;

		$this->module = $module;
		$this->controller = $controller;
		$this->action = $action;
		$this->parameterName = $parameterName;
		$this->parameterType = $parameterType;
		$this->parameterValue = $parameterValue;
	}

	/* CONSTANTS */
	const PARAMETER_NUMBER = 'PARAMETER_NUMBER';
	const PARAMETER_STRING = 'PARAMETER_STRING';
	const PARAMETER_REGEX = 'PARAMETER_REGEX';

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
	 * Defines the parameter name
	 *
	 * @var string
	 */
	private $parameterName;

	/**
	 * Defines the parameter type (taken from constants)
	 *
	 * @var string
	 */
	private $parameterType;

	/**
	 * Defines the parameter value;
	 *
	 * @var string
	 */
	private $parameterValue;

	/* PROPERTIES */

	/**
	 * Gets the parameter name.
	 *
	 * @return string
	 */
	public function getParameterName()
	{
		return $this->parameterName;
	}

	/**
	 * Sets the parameter name.
	 *
	 * @param string parameterName The name of parameter to set.
	 */
	public function setParameterName($parameterName)
	{
		$this->parameterName = parameterName;
	}

	/**
	 * Gets the parameter type.
	 *
	 * @return string
	 */
	public function getParameterType()
	{
		return $this->parameterType;
	}

	/**
	 * Sets the parameter type.
	 *
	 * @param string $parameterType The type of parameter to set (taken from constants).
	 */
	public function setParameterType($parameterType)
	{
		$this->$parameterType = $parameterType;
	}

	/**
	 * Gets the parameter value.
	 *
	 * @return string
	 */
	public function getParameterValue()
	{
		return $this->parameterValue;
	}

	/**
	 * Sets the parameter value.
	 *
	 * @param string $parameterValue The value of parameter to set.
	 */
	public function setParameterValue($parameterValue)
	{
		$this->parameterValue = $parameterValue;
	}

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
	 * @return Route parameters
	 * @var mixed, array|null
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

}