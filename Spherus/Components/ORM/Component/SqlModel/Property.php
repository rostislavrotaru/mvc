<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlModel;
	
	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	use Spherus\Components\ORM\Component\Enums\EntityType;
	use Spherus\Components\ORM\Component\Entity;
		
	/**
	 * Class that represents a mapped entity for SPHERUS Framework
	 * 
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.orm
	 */
	class Property extends Entity
	{
	    
	    /* CONSTRUCTOR */
	    
	    /**
	    * Initializes a new instance of Property class.
	    * 
	    * @param string $name The entity name.
	    * @param string $columnName The entity column name.
	    * 
	    * @throws SpherusException When $name parameter is not set.
	    * @throws SpherusException When $columnName parameter is not set.
	    */
	    public function __construct($name, $columnName)
	    {
	        Check::IsNullOrEmpty($name);
	        Check::IsNullOrEmpty($columnName);
	        
	        parent::__construct(EntityType::Property);
	        $this->name = $name;
	        $this->storeName = $columnName;
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
		 * Defines the property column name
		 * @var string
		 */
		private $columnName = null;
		
		/**
		 * Defines if the property is entity key or not
		 * @var boolean
		 */
		private $isEntityKey = false;
		
		/**
		 * Defines the property default value
		 * 
		 * @var string
		 */
		private $defaultValue = null;
		

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
		 * @var string. Use PropertyType enum as parameter.
		 */
		public function setType($type)
		{
			$this->type = $type;
		}
		
		/**
		 * @return Gets the column name.
		 *
		 * @var string
		 */
		public function getColumnName()
		{
		    return $this->columnName;
		}
	
		/**
		 * Sets the column name.
		 * @param string $columnName
		 */
		public function setColumnName($columnName)
		{
			$this->columnName = $columnName;
		}
		
		/**
		 * Gets if the property is entity key
		 * @return boolean
		 */
		public function getIsEntityKey() 
		{
			return $this->isEntityKey;
		}
		
		/**
		 * Sets if the property is entity key
		 * @param boolean $isEntityKey
		 */
		public function setIsEntityKey($isEntityKey) 
		{
			$this->isEntityKey = $isEntityKey;
		}
		
		/**
		 * Gets the property default value
		 * @return string
		 */
		public function getDefaultValue() 
		{
			return $this->defaultValue;
		}
		
		/**
		 * Sets the property default value
		 * @param string $defaultValue
		 */
		public function setDefaultValue($defaultValue) 
		{
			$this->defaultValue = $defaultValue;
		}
		
	}