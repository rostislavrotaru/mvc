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

	/**
	 * Class that represents the base for all application modules
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	abstract class ModuleBase
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of ModuleBase class.
		 * 
		 * @param string $name The module name.
		 * @param string $namespace The module namespace.
		 * 
		 * @throws SpherusException when $name parameter is null or empty.
		 * @throws SpherusException when $namespace parameter is null or empty.
		 */
		public function __construct($name, $namespace)
		{
			Check::IsNullOrEmpty($name);
			Check::IsNullOrEmpty($namespace);
			
			$this->name = $name;
			$this->namespace = $namespace;
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
	
		
		/* ABSTRACTS */
	
		/**
		 * Permits to write custom functionality after module is loaded
		 */
		public abstract function Run();

	}