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
	
	use Spherus\Components\ORM\Component\Entity;
	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	use Spherus\Components\ORM\Component\SqlModel\Enums\EntityType;
						
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
		 * @param string $tableName The model table name.
		 *
		 * @throws SpherusException When $name parameter is not set.
		 * @throws SpherusException When $tableName parameter is not set.
		 */
		public function __construct($name, $tableName)
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
		
		/**
		 * Defines the model entity set name
		 * @var string
		 */
		private $entitySetName = null;
		
		/**
		 * Defines the model table name
		 * @var string
		 */
		private $tableName = null;
		
		/**
		 * Defines array of model Properties
		 * @var array
		 */
		private $properties = [];
		
		/**
		 * Defines array of model Indexes
		 * @var array
		 */
		private $indexes = [];
		
		/**
		 * Defines array of model Relationships
		 * @var array
		 */
		private $relationships = [];
			
		/**
		 * Defines array of model NavigationProperties
		 * @var array
		 */
		private $navigationProperties = [];
		

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
		
		/**
		 * Gets the model entity set name
		 * @return string
		 */
		public function getEntitySetName()
		{
			return $this->entitySetName;
		}
		
		/**
		 * Sets the model entity set name
		 * @param string $entitySetName The entitySetName to set.
		 */
		public function setEntitySetName($entitySetName)
		{
			$this->entitySetName = $entitySetName;
		}
		

		/**
		 * Gets model properties
		 * @return array
		 */
		public function getProperties()
		{
			return $this->properties;
		}
		
		/**
		 * Gets model navigation properties
		 * @return array
		 */
		public function getNavigationProperties()
		{
			return $this->navigationProperties;
		}

		/**
		 * Gets model Indexes
		 * @return array
		 */
		public function getIndexes()
		{
			return $this->indexes;
		}
		
		/**
		 * Gets model relationships
		 * @return array
		 */
		public function getRelationships()
		{
			return $this->relationships;
		}
		
	
		/* PUBLIC METHODS */
		
		/**
		 * Adds property to the properties collection
		 * 
		 * @param Property $property The Property entity to add.
		 * @throws SpherusException When $property parameter is null or empty.
		 */
		public function AddProperty(Property $property)
		{
			Check::IsNullOrEmpty($property);
			$this->properties[$property->getName()] = $property;
		}
		
		/**
		 * Removes Property from the collection
		 * @param Property $property The Property entitity to remove
		 * 
		 * @throws SpherusException When $property parameter is null or empty.
		 */
		public function RemoveProperty(Property $property)
		{
			Check::IsNullOrEmpty($property);
			unset($this->properties[$property->getName()]);
		}
		
		/**
		 * Adds navigation property to collection.
		 *
		 * @param NavigationProperty $navigationProperty The NavigationProperty entity to add.
		 * @throws SpherusException When $navigationProperty parameter is null or empty.
		 */
		public function AddNavigationProperty(NavigationProperty $navigationProperty)
		{
			Check::IsNullOrEmpty($navigationProperty);
			$this->navigationProperties[$navigationProperty->getName()] = $navigationProperty;
		}
		
		/**
		 * Removes NavigationProperty from the collection
		 * @param NavigationProperty $navigationProperty The NavigationProperty entitity to remove
		 * 
		 * @throws SpherusException When $navigationProperty parameter is null or empty.
		 */
		public function RemoveNavigationProperty(NavigationProperty $navigationProperty)
		{
			Check::IsNullOrEmpty($navigationProperty);
			unset($this->navigationProperties[$navigationProperty->getName()]);
		}
	
		/**
		 * Adds Index to the indexes collection
		 *
		 * @param Index $index The Index to add.
		 * @throws SpherusException When $index parameter is null or empty.
		 */
		public function AddIndex(Index $index)
		{
			Check::IsNullOrEmpty($index);
			$this->indexes[$index->getName()] = $index;
		}
		
		/**
		 * Removes Index from the collection
		 * @param Index $index The Index entitity to remove.
		 *
		 * @throws SpherusException When $index parameter is null or empty.
		 */
		public function RemoveIndex(Index $index)
		{
			Check::IsNullOrEmpty($index);
			unset($this->properties[$property->getName()]);
		}
		
		/**
		 * Adds Relationship to the relationships collection
		 *
		 * @param Relationship $index The Index to add.
		 * @throws SpherusException When $index parameter is null or empty.
		 */
		public function AddRelationship(Relationship $relationship)
		{
			Check::IsNullOrEmpty($relationship);
			$this->relationships[$relationship->getName()] = $relationship;
		}
		
		/**
		 * Removes Relationship from the collection
		 * @param Relationship $relationship The Relationship entitity to remove.
		 *
		 * @throws SpherusException When $relationship parameter is null or empty.
		 */
		public function RemoveRelationship(Relationship $relationship)
		{
			Check::IsNullOrEmpty($relationship);
			unset($this->relationships[$relationship->getName()]);
		}
		
	}