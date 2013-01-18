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
 * Defines a Route rule parameter class
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.routing
 */
class RouteRuleParameter
{

	/* CONSTRUCTOR */

	/**
	 * Initializes a new instance of route rule parameter class
	 *
	 * @param string $parameterName The name of parameter,
	 * @param string $parameterType The parameter type (taken from constants)
	 * @param string $parameterValue The parameter value. Optional.
	 * @throws SpherusException When $parameterName is null or empty.
	 * @throws SpherusException When $parameterType is null or empty.
	 * @throws SpherusException When $parameterType is regex and $parameterValue is null or empty.
	 */
	public function __construct($parameterName, $parameterType, $parameterValue = null)
	{
		Check::IsNullOrEmpty($parameterName);
		Check::IsNullOrEmpty($parameterType);
		$parameterType===$this::PARAMETER_REGEX ? Check::IsNullOrEmpty($parameterValue) : null;

		$parameter['name'] = $parameterName;
		$parameter['type'] = $parameterType;
		$parameter['value'] = $parameterValue;
	}

	/* CONSTANTS */
	const PARAMETER_NUMBER = 'PARAMETER_NUMBER';
	const PARAMETER_STRING = 'PARAMETER_STRING';
	const PARAMETER_REGEX = 'PARAMETER_REGEX';

	/* FIELDS */

	/**
	 * Defines the parameter name
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Defines the parameter type (taken from constants)
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Defines the parameter value;
	 *
	 * @var string
	 */
	private $value;

	/* PROPERTIES */

	/**
	 * Gets the parameter name.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets the parameter name.
	 *
	 * @param string $name The name of parameter to set.
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Gets the parameter type.
	 *
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Sets the parameter type.
	 *
	 * @param string $name The type of parameter to set (taken from constants).
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * Gets the parameter value.
	 *
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Sets the parameter value.
	 *
	 * @param string $name The value of parameter to set.
	 */
	public function setValue($value)
	{
		$this->value = $value;
	}
}