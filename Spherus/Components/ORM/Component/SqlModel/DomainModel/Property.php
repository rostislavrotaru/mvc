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
	use Spherus\Components\ORM\Component\SqlModel\Enums\PropertyType;
					
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
	    * @param string $name The Property name.
	    * @param string $columnName The Property column name.
	    * @param string $type The Property type. Nullable. Default is PropertyType::Varchar.
	    * 
	    * @throws SpherusException When $name parameter is not set.
	    * @throws SpherusException When $columnName parameter is not set.
	    * 
	    * @return Property Initialized instance
	    * 
	    */
	    public function __construct($name, $columnName, $type = null)
	    {
	        Check::IsNullOrEmpty($name);
	        Check::IsNullOrEmpty($columnName);
	        
	        parent::__construct(EntityType::Property);
	        $this->name = $name;
	        $this->columnName = $columnName;
	        $this->type = isset($type) ? $type : PropertyType::Varchar;
	        return $this;
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
		
		/**
		 * Defines the Property value lenght
		 * @var integer
		 */
		private $length = 0;
		
		/**
		 * Defines if the property is autoincrement
		 * @var boolean
		 */
		private $autoincrement = false;
		

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
		 * 
		 * @return Property Current instance
		 */
		public function setName($name)
		{
			$this->name = $name;
			return $this;
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
		 * @param string. Use PropertyType enum as parameter.
		 * @return Property Current instance
		 */
		public function setType($type)
		{
			$this->type = $type;
			return $this;
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
		 * 
		 * @return Property Current instance
		 */
		public function setColumnName($columnName)
		{
			$this->columnName = $columnName;
			return $this;
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
		 * 
		 * @return Property Current instance
		 */
		public function setIsEntityKey($isEntityKey) 
		{
			$this->isEntityKey = $isEntityKey;
			return $this;
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
		 * Sets the property default value.
		 * 
		 * @param string $defaultValue
		 * @return Property Current instance
		 */
		public function setDefaultValue($defaultValue) 
		{
			$this->defaultValue = $defaultValue;
			return $this;
		}
	
		/**
		 * Gets the property value length
		 * @return number
		 */
		public function getLength()
		{
			return $this->length;
		}
	
		/**
		 * Sets the property value length
		 * @param number $length The property value length
		 * 
		 * @return Property Current instance
		 */
		public function setLength($length)
		{
			$this->length = $length;
			return $this;
		}

		/**
		 * Gets if the property is autoincrement
		 * @return boolean
		 */
		public function getAutoincrement()
		{
			return $this->autoincrement;
		}
		
		/**
		 * Sets if the property is entity key
		 * @param boolean $autoincrement. Default is true
		 * 
		 * @return Property Current instance
		 */
		public function setAutoincrement($autoincrement = true)
		{
			$this->autoincrement = $autoincrement;
			return $this;
		}
		
	}