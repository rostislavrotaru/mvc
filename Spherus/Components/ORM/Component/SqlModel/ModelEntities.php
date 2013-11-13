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
	use Spherus\Core\Check;
	use Spherus\Components\ORM\Component\Enums\EntityType;
	use Spherus\Components\ORM\Component\SqlModel\Index;
	use Spherus\Components\Data\Component\Base\SqlDatabase;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
	use Spherus\Components\Data\Component\DatabaseConfig;
							
	/**
	 * Class that represents the model entities collection
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	abstract class ModelEntities extends Entity
	{
		
		/* CONSTRUCTOR */
		 
		/**
		 * Initializes a new instance of ModelEntities class.
		 *
		 * @param string $name The model name.
		 * @param SqlDatabase $database The model database object.
		 * @param SqlCompiler $compiler The model sql compiler object.
		 * @param DatabaseConfig $databaseConfig The model database config object.
		 *
		 * @throws SpherusException When $name parameter is not set.
		 */
		public function __construct($name, SqlDatabase $database = null, SqlCompiler $compiler = null, DatabaseConfig $databaseConfig = null)
		{
			Check::IsNullOrEmpty($name);
			 
			parent::__construct(EntityType::ModelEntities);
			$this->name = $name;
			$this->database = $database;
			$this->compiler = $compiler;
			$this->databaseConfig = $databaseConfig;
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
		 * Defines the list of indexes
		 * @var array
		 */
		private $indexes = [];
		
		/**
		 * Defines the model entites database
		 * @var Database
		 */
		private $database = null;
		
		/**
		 * Defines the model entities compiler.
		 * @var SqlCompiler
		 */
		private $compiler = null;
		
		/**
		 * Defines the database config
		 * @var DatabaseConfig
		 */
		private $databaseConfig = null;
		
		
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
		 * Gets the models indexes
		 * @return array
		 */
		public function getIndexes()
		{
			return $this->indexes;
		}
			
		/**
		 * Sets the indexes
		 * @param array $indexes the collection of Index objects
		 */
		public function setIndexes($indexes)
		{
			$this->indexes = $indexes;
		}

		/**
		 * Gets Model entities database
		 * @return Database
		 */
		public function getDatabase()
		{
			return $this->database;
		}
		
		/**
		 * Sets Model entities database
		 * @param Database $database The database to set
		 */
		public function setDatabase($database)
		{
			$this->database = $database;
		}

		/**
		 * Gets the model entities compiler 
		 * @return SqlCompiler
		 */
		public function getCompiler()
		{
			return $this->Compiler;
		}
		
		/**
		 * Sets the model entities compiler
		 * @param SqlCompiler $compiler
		 */
		public function setCompiler(SqlCompiler $compiler)
		{
			$this->$compiler = $compiler;
		}
		
		/**
		 * Gets the model entites database config object.
		 * @return DatabaseConfig
		 */
		public function getDatabaseConfig()
		{
			return $this->databaseConfig;
		}
		
		/**
		 * Sets the model entites database config object.
		 * @param DatabaseConfig $databaseConfig The DatabaseConfig object to set.
		 */
		public function setDatabaseConfig(DatabaseConfig $databaseConfig)
		{
			$this->databaseConfig = $databaseConfig;
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
		
		/**
		 * Adds Model object to entities collection
		 * @param Index $index The index object to add.
		 */
		public function AddIndex(Index $index)
		{
			Check::IsNullOrEmpty($index);
			$this->indexes[$index->getName()] = $index;
		}
		
		/**
		 * Removes Index object from entities collection
		 * @param Index $index The index object to remove.
		 */
		public function RemoveIndex(Index $index)
		{
			Check::IsNullOrEmpty($index);
			unset($this->indexes[$index->getName()]);
		}

	}