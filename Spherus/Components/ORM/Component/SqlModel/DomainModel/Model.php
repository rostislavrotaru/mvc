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
		 */
		public function RemoveProperty(Property $property)
		{
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
		 */
		public function RemoveNavigationProperty(NavigationProperty $navigationProperty)
		{
			unset($this->navigationProperties[$navigationProperty->getName()]);
		}
	
	}