<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/

	namespace Spherus\Routing
	{

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
			 * Initializes a new instance of Route class
			 * 
			 * @param string $url The route url
			 * @param string $module The route module name, optional
			 * @param string $controller The route controller name, optional
			 * @param string $action The route action name, optional
			 * @param array $parameters The route parameters name, optional
			 * 
			 * @throws SpherusException When $url parameter is null or empty
			 */
			public function __construct($url, $module = null, $controller = null, $action = null, $parameters = null)
			{				
				$this->url = $url;
				$this->module = $module;
				$this->controller = $controller;
				$this->action = $action;
				$this->parameters = $parameters;
			}
			
			
			/* FIELDS */
			
			/**
			 * Defines the route url
			 * @var string
			 */
			var $url;
			
			/**
			 * Defines the route module name
			 * @var string 
			 */
			var $module;
			
			/**
			 * Defines the route controller name
			 * @var string
			 */
			var $controller;
			
			/**
			 * Defines the route action name
			 * @var string
			 */
			var $action;
			
			/**
			 * Defines the route parameters
			 * @var mixed, array|null 
			 */
			var $parameters = null;
			
			/**
			 * Defines the route name
			 * @var string
			 */
			var $name = null;

			

			/* PROPERTIES */
			
			/**
			 * Gets the route name
			 * @return string
			 */
			public function getName()
			{
			    return $this->name;
			}
			
			/**
			 * Sets the route name.
			 * 
			 * @param string $name The name of route to set.
			 * @throws SpherusException When the $name parameter is null or empty
			 */
			public function setName ($name)
			{
			    $this->name = $name;
			}
			
			/**
			 * @return Route url
			 * @var string
			 */
			public function getUrl() 
			{
				return $this->url;
			}
		
			/**
			 * @return Route module name
			 * @var string 
			 */
			public function getModule() 
			{
				return $this->module;
			}
		
			/**
			 * @return Route controller name
			 * @var string
			 */
			public function getController() 
			{
				return $this->controller;
			}
		
			/**
			 * @return Route action name
			 * @var string
			 */
			public function getAction() 
			{
				return $this->action;
			}
			
			/**
			 * @return Route parameters
			 * @var mixed, array|null 
			 */
			public function getParameters()
			{
				return $this->parameters;
			}

		}
	
	}

?>