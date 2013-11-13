<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\Models;
	
	use Spherus\Components\ORM\Component\Entity;
	use Spherus\Core\Check;
	use Spherus\Components\ORM\Component\Enums\EntityType;
			
	/**
	 * Class that represents the base for all models
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	
	abstract class Model extends Entity
	{
		
		/* CONSTRUCTOR */
		 
		/**
		 * Initializes a new instance of Model class.
		 *
		 * @param string $name The model name.
		 *
		 * @throws SpherusException When $name parameter is not set.
		 */
		public function __construct($name)
		{
			Check::IsNullOrEmpty($name);
			 
			parent::__construct(EntityType::Model);
			$this->name = $name;
		}
		
		
		/* FIELDS */
		
		/**
		 * Defines the model name
		 * @var string
		 */
		private $name = null;
		
		
		/* PROPERTIES */
		
		/**
		 * Gets the model name
		 * @return string
		 */
		public function getName() 
		{
			return $this->name;
		}
	
		/**
		 * Sets the model name
		 * @param string $name The name to set.
		 */
		public function setName($name) 
		{
			$this->name = $name;
		}

	}