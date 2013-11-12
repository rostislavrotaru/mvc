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
	
	/**
	 * Class that represents the base for all models
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	
	abstract class Model extends Entity
	{
		
		/* FIELDS */
		
		/**
		 * Defines the model name
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Defines the models collection name
		 * @var string
		 */
		private $collectionName = null;
		
		/**
		 * Defines the model properties
		 * @var array
		 */
		private $properties = [];
		
		/**
		 * Defines the model navigation properties
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
		 * Gets the models collection name
		 * @return array
		 */
		public function getCollectionName() 
		{
			return $this->collectionName;
		}
	
		/**
		 * Sets the models collection name
		 * @param string $collectionName The collection name to set.
		 */
		public function setCollectionName($collectionName) 
		{
			$this->collectionName = $collectionName;
		}
	
		/**
		 * Gets the model properties
		 * @return array
		 */
		public function getProperties() 
		{
			return $this->properties;
		}
	
		/**
		 * Sets the model properties
		 * @param array $properties The properties to set.
		 */
		public function setProperties($properties) 
		{
			$this->properties = $properties;
		}
	
		/**
		 * Gets the model navigation properties
		 * @return array
		 */
		public function getNavigationProperties() 
		{
			return $this->navigationProperties;
		}
	
		/**
		 * Sets the model navigation properties
		 * @param array $navigationProperties The navigation properties to set.
		 */
		public function setNavigationProperties($navigationProperties) 
		{
			$this->navigationProperties = $navigationProperties;
		}

	}