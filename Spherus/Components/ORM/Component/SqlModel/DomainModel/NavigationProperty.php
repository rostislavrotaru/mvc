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
	class NavigationProperty extends Entity
	{
	    
	    /* CONSTRUCTOR */
	    
	    /**
	    * Initializes a new instance of NavigationProperty class.
	    * 
	    * @param string $name The NavigationProperty name.
	    * 
	    * @throws SpherusException When $name parameter is not set.
	    * @throws SpherusException When $relationship parameter is not set.
	    */
	    public function __construct($name, Relationship $relationship)
	    {
	        Check::IsNullOrEmpty($name);
	        Check::IsNullOrEmpty($relationship);
	        
	        parent::__construct(EntityType::NavigationProperty);
	        $this->name = $name;
	        $this->relationship = $relationship;
	    }
	    
	    
	    /* FIELDS */
			
		/**
		 * Defines the property name
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Defines the navigation property relationship
		 * @var Relationship
		 */
		private $relationship = null;
		


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
		 * Gets the Relationship entity.
		 * 
		 * @var Relationship
		 */ 
		function getRelationship()
		{
			return $this->relationship;
		}
	
		
		/**
		 * Sets the Relationship entity.
		 * @param Relationship $relationship The relationship entity to set.
		 */
		public function setRelationship($relationship)
		{
			$this->relationship = $relationship;
		}

	}