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
	use Spherus\Components\ORM\Component\SqlModel\Enums\RelationshipType;
	use Spherus\Components\ORM\Component\SqlModel\Enums\OnActionType;
	use Spherus\Components\ORM\Component\SqlModel\DomainModel\Model;
	use Spherus\Components\ORM\Component\SqlModel\DomainModel\Property;
			
	/**
	 * Class that represents a relationship entity for SPHERUS Framework
	 * 
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.orm
	 */
	class Relationship extends Entity
	{
	    
	    /* CONSTRUCTOR */
	    
	    /**
	    * Initializes a new instance of Relationship class.
	    * 
	    * @param string $name The relationship name.
	    * 
	    * @throws SpherusException When $name parameter is not set.
	    */
	    public function __construct($name)
	    {
	        Check::IsNullOrEmpty($name);
        
	        parent::__construct(EntityType::Relationship);
	        $this->name = $name;
	    }
	    
	    
	    /* FIELDS */
			
		/**
		 * Defines the property name
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Defines the foreign Model entity
		 * @var Model
		 */
		private $foreignModel = null;
		
		/**
		 * Defines the relationhip property
		 * @var Property
		 */
		private $property = null;
		
		/**
		 * Defines the relationhip foreign property
		 * @var Property
		 */
		private $foreignProperty = null;
		
		/**
		 * Defines the relationship type
		 * @var string. Uses RelationshipType enum.
		 */
		private $type = RelationshipType::OneToMany;
		
		/**
		 * Defines the OnDelete behaviour.
		 * @var string
		 */
		private $onDelete = OnActionType::Restrict;
		
		/**
		 * Defines the OnUpdate behaviour.
		 * @var string
		 */
		private $onUpdate = OnActionType::Restrict;
		

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
		 * Gets the foreign Model
		 * @var Model
		 */
		public function getForeignModel()
		{
			return $this->foreignModel;
		}
	
		
		/**
		 * Sets the foreign Model
		 * @param Model $foreignModel The foreign model to set.
		 */
		public function setForeignModel(Model $foreignModel)
		{
			$this->foreignModel = $foreignModel;
		}
		

		/**
		 * Gets the relationship property
		 * @var Property
		 */
		public function getProperty()
		{
			return $this->property;
		}
	
		
		/**
		 * Sets the relationship property
		 * @param Property $property The property to set.
		 */
		public function setProperty(Property $property)
		{
			$this->property = $property;
		}
	
		
		/**
		 * Gets the relationship foreign property
		 * @var Property
		 */
		public function getForeignProperty()
		{
			return $this->foreignProperty;
		}
	
		
		/**
		 * Sets the relationship foreign property
		 * @param Property $property The foreign property to set.
		 */
		public function setForeignProperty(Property $foreignProperty)
		{
			$this->foreignProperty = $foreignProperty;
		}
	
		
		/**
		 * Gets the relationship type
		 * @var string Uses RelationshipType enum.
		 */
		public function getType()
		{
			return $this->type;
		}
	
		
		/**
		 * Sets the relationship type
		 * @param $type The relationship type. Uses RelationshipType enum.
		 */
		public function setType($type)
		{
			$this->type = $type;
		}
	
		
		/**
		 * Gets the OnDelete behaviour.
		 * @return string Uses OnActionType enum.
		 */
		public function getOnDelete()
		{
			return $this->onDelete;
		}
	
		
		/**
		 * Sets the OnDelete behaviour.
		 * @param string $onDelete The OnDelete parameter. Uses OnActionType enum.
		 */
		public function setOnDelete($onDelete)
		{
			$this->onDelete = $onDelete;
		}
	
		
		/**
		 * Gets the OnUpdate behaviour.
		 * @return string Uses OnActionType enum.
		 */
		public function getOnUpdate()
		{
			return $this->onUpdate;
		}
	
		
		/**
		 * Sets the OnUpdate behaviour.
		 * @param string $onUpdate The OnUpdate parameter. Uses OnActionType enum.
		 */
		public function setOnUpdate($onUpdate)
		{
			$this->onUpdate = $onUpdate;
		}


	}