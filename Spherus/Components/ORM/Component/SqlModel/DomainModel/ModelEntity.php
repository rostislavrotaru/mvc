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
	
	use Spherus\Components\ORM\Component\SqlModel\Enums\ModelEntityState;
	use Spherus\Components\ORM\Component\SqlModel\DomainModel\ModelEntities;
					
	/**
	 * Class that represents a model entity for SPHERUS Framework
	 * 
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.orm
	 */
	class ModelEntity
	{
    
	    /* FIELDS */
			
		/**
		 * Defines the model entity state
		 * @var string
		 */
		private $state = ModelEntityState::New_;
		
		/**
		 * Defines the ModelEntities
		 * @var ModelEntities
		 */
		private $modelEntitities = null;
		


		/* PROPERTIES */
	
		/**
		 * Gets the model entity state
		 * @var string
		 */
		public function getState()
		{
			return $this->state;
		}
		
		/**
		 * Sets the model entity state. Uses ModelEntityState enum.
		 * @param string $state The state parameter to set
		 */
		public function setState($state)
		{
			$this->state = $state;
		}
		
		/**
		 * Gets the ModelEntitites
		 * 
		 * @return ModelEntities
		 */
		public function getModelEntitities()
		{
			return $this->modelEntitities;
		}
		
		/**
		 * Sets the ModelEntitites
		 * @param ModelEntities $modelEntitities The ModelEntities to set.
		 */
		public function setModelEntitities($modelEntitities)
		{
			$this->modelEntitities = $modelEntitities;
		}
	
	}