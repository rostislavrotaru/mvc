<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	
	namespace Spherus\IoC;
	
	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	use Spherus\Core\Base\ModuleBase;
		
		/**
	 * Class that represents an object containing dependencies
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.ioc
	 */
	class Dependency
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initialize a new instance of Dependency class.
		 * 
		 * @param string $interface The Dependency interface.
		 * @param string $class The Dependency class.
		 * @param ModuleBase $module The Dependency module if needed to limit to this module only (will be used on resolving).
		 * 
		 * @throws SpherusException When $interface parameter is null or empty.
		 * @throws SpherusException When $class parameter is null or empty.
		 */
		public function __construct($interface, $class, ModuleBase $module = null)
		{
			Check::IsNullOrEmpty($interface);
			Check::IsNullOrEmpty($class);
			
			$this->interface = $interface;
			$this->class = $class;
			$this->module = $module;
		}
		
		/* FIELDS */
		
		/**
		 * Defines the interface name.
		 * @var string
		 */
		private $interface = null;
		
		/**
		 * Defines the class name.
		 * @var string
		 */
		private $class = null;
		
		/**
		 * Defines the file path if the class do not use namespaces.
		 * @var unknown
		 */
		private $filePath = null;
		
		/**
		 * Defines the ModuleBase object if dependency is need to be used only in indicated module.
		 * @var ModuleBase
		 */
		private $module = null;
		
		
		/* PROPERTIES */
	
		/**
		 * Gets the interface name.
		 * @var string
		 */
		public function getInterface()
		{
			return $this->interface;
		}
	
		/**
		 * Gets the class name.
		 * @var string
		 */
		public function getClass() 
		{
			return $this->class;
		}
	
		/**
		 * Gets the file path if the class do not use namespaces.
		 * @var unknown
		 */
		public function getFilePath() 
		{
			return $this->filePath;
		}
		
		/**
		 * Sets dependency class file path if it not using namespaces.
		 * 
		 * @param string $filePath The file path to set.
		 */
		public function setFilePath($filePath)
		{
			$this->filePath = $filePath;
		}
		
		/**
		 * Gets the ModuleBase object if dependency is need to be used only in indicated module.
		 * @var ModuleBase
		 */
		public function getModule()
		{
			return $this->module;
		}
		
		/**
		 * Sets module in which the class is containing.
		 *
		 * @param ModuleBase $module The module to set.
		 */
		public function setModule(ModuleBase $module)
		{
			$this->module = $module;
		}
		
	}