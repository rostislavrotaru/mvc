<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Data\Component;
	
	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
		
	/**
	 * Class that represents a database parameter
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.data
	 */
	class DatabaseParameter
	{

		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of DatabaseParameter class
		 *
		 * @param string $name The parameter name.
		 * @param string $value The parameter value.
		 * @param DatabaseParameterType $type The parameter type.
		 * @param boolean $isOut Determine if parameter is out or not.
		 *
		 * @throws SpherusException When $name parameter is null or empty.
		 * @throws SpherusException When $isOut parameter is null or empty.
		 * @throws SpherusException When $type parameter is null or empty.
		 * @throws SpherusException When $value parameter is null or empty having $isOut parameter false.
		 */
		public function __construct($name, $value, $type = DatabaseParameterType::Varchar, $isOut = false)
		{
			Check::IsNullOrEmpty($name);
			Check::IsNullOrEmpty($isOut);
			Check::IsNullOrEmpty($type);
			if($isOut === false)
			{
				Check::IsNullOrEmpty($value);
			}
			
			$this->name = $name;
			$this->value = $value;
			$this->type = $type;
			$this->isOut = $isOut;
		}
		
		
		/* FIELDS */
		
		/**
		 * Defines the parameter name
		 *
		 * @var string
		 */
		private $name = null;
			
		/**
		 * Defines the parameter type
		 *
		 * @var DatabaseParameterType
		 */
		private $type = DatabaseParameterType::Varchar;
			
		/**
		 * Defines the parameter value
		 *
		 * @var string
		 */
		private $value = null;
			
		/**
		 * Defines whether parameter is output or not
		 *
		 * @var boolean
		 */
		private $isOut = false;
			
			
		/* PROPERTIES */	
		
		/**
		 * Gets the parameter name
		 *
		 * @var string
		 */
		public function getName()
		{
			return $this->name;
		}
			
		/**
		 * Gets the parameter Value
		 *
		 * @var string
		 */
		public function getValue()
		{
			return $this->value;
		}
			
		/**
		 *
		 * Sets the parameter value
		 *
		 * @param string  The value of parameter
		 */
		public function setValue($value)
		{
			$this->value = $value;
		}
			
		/**
		 * Gets the parameter type
		 *
		 * @var DatabaseParameterType
		 */
		public function getType()
		{
			return $this->type;
		}
			
		/**
		 * Gets whether parameter is output or not
		 *
		 * @var boolean
		 */
		public function getIsOut()
		{
			return $this->isOut;
		}

	}