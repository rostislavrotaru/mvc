<?php

	namespace Spherus\HttpContext
	{
	
		use Spherus\Core\SpherusException;
		use Spherus\Core\Check;

		/**
		 * Class that represents http context parsed url
		 *
		 * @author Rostislav Rotaru
		 * @package spherus.httpcontext
		 * @version 3.0
		 *
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
			 * @param Spherus\Core\Route $route The ParsedUrl Route
			 * 
			 * @throws SpherusException When $moduleName parameter is null or empty
			 * @throws SpherusException When $controllerName parameter is null or empty
			 * @throws SpherusException When $actionName parameter is null or empty
			 * @throws SpherusException When $parameters parameter is null
			 * @throws SpherusException When $route parameter is null or empty
			 */
			public function __construct($moduleName, $controllerName, $actionName, $parameters, $route)
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
			}
			
			
			/* FIELDS */
			
			/**
			 * Defines the ParsedUrl object module name
			 * @var string
			 */
			private $moduleName = null;
			
			/**
			 * Defines the ParsedUrl object controller name
			 * @var string
			 */
			private $controllerName = null;
			
			/**
			 * Defines the ParsedUrl object action name
			 * @var string
			 */
			private $actionName = null;
			
			/**
			 * Defines the ParsedUrl object parameters array
			 * @var array
			 */
			private $parameters = null;
			
			/**
			 * Defines the ParsedUrl object Route
			 * @var Spherus\Routing\Route
			 */
			private $route = null;
			
			
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

		}
		
	}

?>