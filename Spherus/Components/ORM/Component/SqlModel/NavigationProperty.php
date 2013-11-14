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
	use Spherus\Components\ORM\Component\Enums\OnActionType;
	use Spherus\Components\ORM\Component\Entity;
	use Spherus\Components\ORM\Component\Enums\MultiplicityType;
	use Spherus\Components\ORM\Component\SqlModel\Model;
				
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
	    * Initializes a new instance of Property class.
	    * 
	    * @param string $name The entity name.
	    * @param string $columnName The entity column name.
	    * 
	    * @throws SpherusException When $name parameter is not set.
	    * @throws SpherusException When $columnName parameter is not set.
	    */
	    public function __construct($name)
	    {
	        Check::IsNullOrEmpty($name);
	        
	        parent::__construct(EntityType::NavigationProperty);
	        $this->name = $name;
	    }
	    
	    
	    /* FIELDS */
			
		/**
		 * Defines the property name
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Defines the navigation property multiplicity 
		 * @var string Uses MultiplicityType enum.
		 */
		private $multiplicity = MultiplicityType::Many;
		
		/**
		 * Defines the source model
		 * @var Model
		 */
		private $fromModel = null;
			
		/**
		 * Defines the target model
		 * @var Model
		 */
		private $toModel = null;
		
		/**
		 * Defines the on delete action type
		 * @var string Uses OnActionType enum.
		 */
		private $onDelete = OnActionType::Restrict; 
		
		/**
		 * Defines the on update action type
		 * @var string Uses OnActionType enum.
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
		 * Gets the navigation property multiplicity
		 * @return string
		 */
		public function getMultiplicity() 
		{
			return $this->multiplicity;
		}
			
		/**
		 * Sets the navigation property multiplicity
		 * @param string $multiplicity Uses MultiplicityType enum.
		 */
		public function setMultiplicity($multiplicity) 
		{
			$this->multiplicity = $multiplicity;
		}
				
		/**
		 * Gets the source model
		 * @var \Spherus\Components\ORM\Component\Models\Model
		 */
		public function getFromModel() 
		{
			return $this->fromModel;
		}
		
		/**
		 * Sets the source model
		 * @param Model $fromModel The model to set.
		 */
		public function setFromModel(Model $fromModel) 
		{
			$this->fromModel = $fromModel;
		}
			
		/**
		 * Gets the target model
		 * @var \Spherus\Components\ORM\Component\Models\Model
		 */
		public function getToModel() 
		{
			return $this->toModel;
		}
	
		/**
		 * Sets the target model
		 * @param \Spherus\Components\ORM\Component\Models\Model $fromModel The model to set.
		 */
		public function setToModel($toModel) 
		{
			$this->toModel = $toModel;
		}
	
		/**
		 * Gets On delete action
		 * @return string
		 */
		public function getOnDelete() 
		{
			return $this->onDelete;
		}
	
		/**
		 * Sets on delete action type.
		 * @param string $onDelete Uses OnActionType enum
		 */
		public function setOnDelete($onDelete) 
		{
			$this->onDelete = $onDelete;
		}
		
		/**
		 * Gets On update action
		 * @return string
		 */
		public function getOnUpdate() 
		{
			return $this->onUpdate;
		}
		
		/**
		 * Sets on update action type.
		 * @param string $onUpdate Uses OnActionType enum
		 */
		public function setOnUpdate($onUpdate) 
		{
			$this->onUpdate = $onUpdate;
		}

	}