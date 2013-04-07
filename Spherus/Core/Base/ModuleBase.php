<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Core\Base;

	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	use Spherus\Interfaces\IModule;

		/**
	 * Class that represents the base for all application modules
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	class ModuleBase
	{
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of ModuleBase class.
		 * 
		 * @param string $name The module name.
		 * @param string $namespace The module namespace name.
		 * @param object $instance The module object instance.
		 * 
		 * @throws SpherusException when $name parameter is null or empty.
		 * @throws SpherusException when $namespace parameter is null or empty.
		 * @throws SpherusException when $instance parameter is null or empty.
		 */
		public function __construct($name, $namespace, $instance)
		{
			Check::IsNullOrEmpty($name);
			Check::IsNullOrEmpty($namespace);
			Check::IsNullOrEmpty($instance);
			
			$this->name = $name;
			$this->namespace = $namespace;
			$this->instance = $instance;
		}
		
		
		/* FIELDS */
		
		/**
		 * Defines the module name
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Defines the module namespace
		 * @var string
		 */
		private $namespace = null;
		
		/**
		 * Defines the module instance
		 * @var IModule
		 */
		private $instance = null;
	
		
		/* PROPERTIES */
	
		/**
		 * Gets the module name
		 * @var string
		 */
		public function getName() 
		{
			return $this->name;
		}
	
		/**
		 * Gets the module namespace
		 * @var string
		 */
		public function getNamespace() 
		{
			return $this->namespace;
		}
	
		/**
		 * Defines the module instance
		 * @var string
		 */
		public function getInstance() 
		{
			return $this->instance;
		}
	}