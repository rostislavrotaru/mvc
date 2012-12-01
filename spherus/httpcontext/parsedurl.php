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
			 * @param string $module The ParsedUrl module
			 * @param string $controller The ParsedUrl controller
			 * @param string $action The ParsedUrl action
			 * @param array $parameters The ParsedUrl parameters array
			 * @param Spherus\Core\Route $route The ParsedUrl Route
			 * 
			 * @throws SpherusException When $module parameter is null or empty
			 * @throws SpherusException When $controller parameter is null or empty
			 * @throws SpherusException When $action parameter is null or empty
			 * @throws SpherusException When $parameters parameter is null
			 * @throws SpherusException When $route parameter is null or empty
			 */
			public function __construct($module, $controller, $action, $parameters, $route)
			{
				Check::IsNullOrEmpty($module);
				Check::IsNullOrEmpty($controller);
				Check::IsNullOrEmpty($action);
				Check::IsNull($parameters);
				Check::IsNullOrEmpty($route);
				
				$this->module = $module;
				$this->controller = $controller;
				$this->action = $action;
				$this->parameters = $parameters;
				$this->route = $route;
			}
			
			
			/* FIELDS */
			
			/**
			 * Defines the ParsedUrl object module
			 * @var string
			 */
			private $module = null;
			
			/**
			 * Defines the ParsedUrl object controller
			 * @var string
			 */
			private $controller = null;
			
			/**
			 * Defines the ParsedUrl object action
			 * @var string
			 */
			private $action = null;
			
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
			public function getModule() 
			{
				return $this->module;
			}

			/**
			 * Gets controller name
			 *
			 * @return string
			 */
			public function getController() 
			{
				return $this->controller;
			}

			/**
			 * Gets action name
			 *
			 * @return string
			 */
			public function getAction() 
			{
				return $this->action;
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