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
	use Spherus\Components\Data\Component\DatabaseConfig;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlQuery;
	use Spherus\Core\SpherusException;
	use Spherus\Components\Data\Component\Base\SqlDatabase;
	use Spherus\Components\ORM\Component\SqlModel\Enums\EntityType;
														
	/**
	 * Class that represents the model entities collection
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.orm
	 */
	class ModelEntites extends Entity
	{
		
		/* CONSTRUCTOR */
		 
		/**
		 * Initializes a new instance of ModelEntities class.
		 *
		 * @param string $name The model name.
		 * @param string $databaseProvider The database provider. Uses DatabaseProviderType enum.
		 * @param DatabaseConfig $databaseConfig The model database config object.
		 *
		 * @throws SpherusException When $name parameter is not set.
		 * @throws SpherusException When $databaseProvider parameter is not set.
		 * @throws SpherusException When $databaseConfig parameter is not set.
		 */
		public function __construct($name, $databaseProvider, DatabaseConfig $databaseConfig)
		{
			Check::IsNullOrEmpty($name);
			Check::IsNullOrEmpty($databaseProvider);
			Check::IsNullOrEmpty($databaseConfig);
			 
			parent::__construct(EntityType::ModelEntities);
			$this->name = $name;
			$this->Initialize($databaseProvider, $databaseConfig);
		}
		
		
		/* FIELDS */
		
		/**
		 * Defines the model entities name
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Defines the list of models
		 * @var array
		 */
		private $models = []; 
		
		/**
		 * Defines the model entites database
		 * @var SqlDatabase
		 */
		private $database = null;
		
		/**
		 * Defines the model entites database query
		 * @var SqlQuery
		 */
		private $query = null;
		
		/**
		 * Enable Lazy loading for included models
		 * @var boolean
		 */
		private $lazyLoading = false; 
		
		
		/* PROPERTIES */
		
		/**
		 * Gets the model entities name
		 * @return string
		 */
		public function getName() 
		{
			return $this->name;
		}
	
		/**
		 * Sets the model entities name
		 * @param string $name The name to set.
		 */
		public function setName($name) 
		{
			$this->name = $name;
		}
	
		/**
		 * Gets the models collection
		 * @return array
		 */
		public function getModels() 
		{
			return $this->models;
		}
	
		/**
		 * Sets the models collection
		 * @param array $models the collection of models
		 */
		public function setModels($models) 
		{
			$this->models = $models;
		}
		
		/**
		 * Gets Model entities database
		 * @return SqlDatabase
		 */
		public function getDatabase()
		{
			return $this->database;
		}
		
		/**
		 * Gets Model entities query
		 * @return SqlQuery
		 */
		public function getQuery()
		{
			return $this->query;
		}
		
		/**
		 * Gets whether Lazy Loading for included models is enabled.
		 * @return boolean
		 */
		public function getLazyLoading()
		{
			return $this->lazyLoading;
		}
		
		/**
		 * Sets whether Lazy Loading for included models is enabled.
		 * @param boolean $lazyLoading The boolean value for lazy loading
		 * 
		 * @throws SpherusException When $lazyLoading parameter is null or empty.
		 */
		public function setLazyLoading($lazyLoading)
		{
			Check::IsNullOrEmpty($lazyLoading);
			$this->lazyLoading = $lazyLoading;
		}
		
		
		/* PRIVATE METHODS */
		
		/**
		 * Initializes additional properties for ModelEntities.
		 * 
		 * @param string $databaseProvider Uses DatabaseProviderType as enum.
		 * @param DatabaseConfig $databaseConfig The database configuration object.
		 * 
		 * @throws SpherusException When $databaseProvider is not found.
		 */
		private function Initialize($databaseProvider, DatabaseConfig $databaseConfig)
		{
			$database = 'Spherus\Components\Data\Component\Providers\\'.$databaseProvider.'Database';
			$compiler = 'Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\\'.$databaseProvider.'\\'.$databaseProvider.'Compiler';
			
			if(!class_exists($compiler))
			{
				throw new SpherusException(sprintf(EXCEPTION_DATABASE_COMPILER_NOT_FOUND, $compiler));
			}
			if(!class_exists($database))
			{
				throw new SpherusException(sprintf(EXCEPTION_DATABASE_PROVIDER_NOT_FOUND, $database));
			}
			
			$this->database = new $database($databaseConfig);
			$this->query = new SqlQuery(new $compiler);
		} 
		
		/* PUBLIC METHODS */
		
		/**
		 * Adds Model object to entities collection
		 * @param Model $model The model object to add.
		 */
		public function AddModel(Model $model)
		{
			Check::IsNullOrEmpty($model);
			$this->models[$model->getName()] = $model;
		}
		
		/**
		 * Removes Model object from entities collection
		 * @param Model $model The model object to remove.
		 */
		public function RemoveModel(Model $model)
		{
			Check::IsNullOrEmpty($model);
			unset($this->models[$model->getName()]);
		}

	}