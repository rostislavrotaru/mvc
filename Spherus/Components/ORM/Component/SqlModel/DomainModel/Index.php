<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlModel\DomainModel;
	
	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	use Spherus\Components\ORM\Component\Entity;
	use Spherus\Components\ORM\Component\SqlModel\Enums\EntityType;
			
	/**
	 * Class that represents a mapped entity for SPHERUS Framework
	 * 
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.orm
	 */
	class Index extends Entity
	{
	    
	    /* CONSTRUCTOR */
	    
	    /**
	    * Initializes a new instance of Property class.
	    * 
	    * @param string $name The index name.
	    * @param string $type The index type. Uses IndexType enum.
	    * 
	    * @throws SpherusException When $name parameter is not set.
	    * @throws SpherusException When $type parameter is not set.
	    */
	    public function __construct($name, $type)
	    {
	        Check::IsNullOrEmpty($name);
	        Check::IsNullOrEmpty($type);
	        
	        parent::__construct(EntityType::Index);
	        $this->name = $name;
	        $this->type = $type;
	    }
	    
	    
	    /* FIELDS */
			
		/**
		 * Defines the property name
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Defines the property type.
		 * @var string
		 */
		private $type = null;
		
		/**
		 * Defines the index properties
		 * @var array
		 */
		private $properties = [];
		

		/* PROPERTIES */
		
		/**
		 * Gets the property name.
		 * 
		 * @var string
		 */
		public function getName() 
		{
			return $this->name;
		}
		
		/**
		 * Sets the property name.
		 * @param string $name
		 */
		public function setName($name)
		{
			$this->name = $name;
		}
		
		/**
		 * @return Gets the property type.
		 *
		 * @var string
		 */
		public function getType()
		{
			return $this->type;
		}
		
		/**
		 * Sets the property type.
		 *
		 * @var string. Use IndexType enum as parameter.
		 */
		public function setType($type)
		{
			$this->type = $type;
		}
			
		/**
		 * Gets index properties
		 * @return array
		 */
		public function getProperties()
		{
			return $this->properties;
		}
		
		/**
		 * Sets index properties
		 * @param array $properties The properties to set.
		 */
		public function setProperties($properties)
		{
			$this->properties = $properties;
		}
	}