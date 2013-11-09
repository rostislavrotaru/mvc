<?php

/**
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright SPHERUS (http://spherus.net)
 * @license http://license.spherus.net
 * @link http://spherus.net
 * @since 3.0
 */
namespace Spherus\HttpContext;

use Spherus\Core\SpherusException;
use Spherus\Core\Check;
use Spherus\Routing\Route;

/**
 * Class that represents http context parsed url
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.routing
 */
class ParsedUrl
{

	/* CONSTRUCTOR */

	/**
	 * Initializes a new instance of ParsedUrl class
	 *
	 * @param string $moduleName The ParsedUrl module name
	 * @param string $controllerName The ParsedUrl controller name
	 * @param string $actionName The ParsedUrl action name
	 * @param array $parameters The ParsedUrl parameters array
	 * @param Route $route The ParsedUrl Route
	 * @param string $query The ParsedUrl query parameters
	 *
	 * @throws SpherusException When $moduleName parameter is null or empty
	 * @throws SpherusException When $controllerName parameter is null or empty
	 * @throws SpherusException When $actionName parameter is null or empty
	 * @throws SpherusException When $parameters parameter is null
	 * @throws SpherusException When $route parameter is null or empty
	 */
	public function __construct($moduleName, $controllerName, $actionName, $parameters, $route, $query = null)
	{
		Check::IsNullOrEmpty($moduleName);
		Check::IsNullOrEmpty($controllerName);
		Check::IsNullOrEmpty($actionName);
		Check::IsNull($parameters);
		Check::IsNullOrEmpty($route);

		$this->moduleName = $moduleName;
		$this->controllerName = $controllerName;
		$this->actionName = $actionName;
		$this->parameters = $parameters;
		$this->route = $route;
		$this->query = $query;
	}

	/* FIELDS */

	/**
	 * Defines the ParsedUrl object module name
	 *
	 * @var string
	 */
	private $moduleName = null;

	/**
	 * Defines the ParsedUrl object controller name
	 *
	 * @var string
	 */
	private $controllerName = null;

	/**
	 * Defines the ParsedUrl object action name
	 *
	 * @var string
	 */
	private $actionName = null;

	/**
	 * Defines the ParsedUrl object parameters array
	 *
	 * @var array
	 */
	private $parameters = null;

	/**
	 * Defines the ParsedUrl object Route
	 *
	 * @var Route
	 */
	private $route = null;
	
	/**
	 * Defines the ParsedUrl query parameters
	 *
	 * @var string
	 */
	private $query = null; 

	/* PROPERTIES */

	/**
	 * Gets module name
	 *
	 * @return string
	 */
	public function getModuleName()
	{
		return $this->moduleName;
	}

	/**
	 * Gets controller name
	 *
	 * @return string
	 */
	public function getControllerName()
	{
		return $this->controllerName;
	}

	/**
	 * Gets action name
	 *
	 * @return string
	 */
	public function getActionName()
	{
		return $this->actionName;
	}

	/**
	 * Gets parameters array
	 *
	 * @return array
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

	/**
	 * Gets parsed url Route
	 *
	 * @return Spherus\Routing\Route
	 */
	public function getRoute()
	{
		return $this->route;
	}

	/**
	 * Gets parsed url query
	 *
	 * @return string
	 */
	public function getQuery()
	{
		return $this->query;
	}

}