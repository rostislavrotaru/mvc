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
	
	/**
	 * Class that represents the base for all application components
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	abstract class ComponentBase
	{
		
		/* FIELDS */
		
		/**
		 * Defines the component name.
		 * 
		 * @var string
		 */
		private $name = null;
		
		
		/* PROPERTIES */
	
		/**
		 * Gets the component name.
		 * 
		 * @var string
		 */
		public function getName()
		{
			return $this->name;
		}
	
		/**
		 * Sets the component name.
		 * 
		 * @param string $name The component name
		 */
		public function setName($name)
		{
			$this->name = $name;
		}

	}