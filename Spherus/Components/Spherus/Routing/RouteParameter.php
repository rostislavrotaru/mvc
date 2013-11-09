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
	 * 
	 * @throws SpherusException When $name parameter is null or empty
	 * @throws SpherusException When $value parameter is null or empty
	 */
	public function __construct($name, $value)
	{
		Check::IsNullOrEmpty($name);
		Check::IsNullOrEmpty($value);
		
		$this->name = $name;
		$this->value = $value;
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

}