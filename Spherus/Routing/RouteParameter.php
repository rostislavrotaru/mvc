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
 * Defines a Route parameter class
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.routing
 */
class RouteParameter
{

	/* CONSTRUCTOR */


	/**
	 * Initializes a new instance of RouteParameter class
	 * 
	 * @param string $name The parameter name.
	 * @param string $value The parameter value.
	 * @param boolean $required Determine if the parameter is required. Optional. Default value is true.
	 * 
	 * @throws SpherusException When $name parameter is null or empty
	 * @throws SpherusException When $value parameter is null or empty
	 * @throws SpherusException When $required parameter is null or empty
	 */
	public function __construct($name, $value, $required = true)
	{
		Check::IsNullOrEmpty($name);
		Check::IsNullOrEmpty($value);
		Check::IsNullOrEmpty($required);
		
		$this->name = $name;
		$this->value = $value;
		$this->required = $required;
		
	}

	/* FIELDS */

	/**
	 * Defines the route parameter name
	 * 
	 * @var string
	 */
	private $name = null;
	
	/**
	 * Defines the route parameter value
	 *
	 * @var string
	 */
	private $value = null;
	
	/**
	 * Defines if the route parameter is required
	 *
	 * @var boolean
	 */
	private $required = true;

	
	/* PROPERTIES */
	
	/**
	 * Gets the route parameter name
	 * 
	 * @var string
	 */
	public function getName() 
	{
		return $this->name;
	}

	/**
	 * Gets the route parameter value
	 *
	 * @var string
	 */
	public function getValue() 
	{
		return $this->value;
	}

	/**
	 * Gets if the route parameter is required
	 *
	 * @var boolean
	 */
	public function getRequired() 
	{
		return $this->required;
	}

}