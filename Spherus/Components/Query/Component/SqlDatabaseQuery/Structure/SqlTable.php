<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Structure;
			
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlEntity;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
		
		/**
     * Class that represents a sql table entity
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlTable extends SqlEntity
	{
		
		/* CONSTRUCTORS */
		
		/**
		 * Initializes a new instance of SqlTable object.
		 * 
		 * @param string $name The sql table name.
		 * @param string $alias The sql table alias.
		 * @param array $columnNames Array of column names.
		 */
		public function __construct($name = null, $alias = null,  array $columnNames = null)
		{
			parent::__construct(SqlEntityType::Table);
			
			$this->name = $name;
			$this->alias = $alias;
			if (isset($columnNames))
			{
				foreach ($columnNames as $columnName)
				{
					$this->AddColumn($columnName);
				}
			}
		}
		
		/* FIELDS */
		
		/**
		 * Contains collection of sql table columns
		 * @var array
		 */
		public $columns = array();
		
		/**
		 * Determine the name of sql table.
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Determine the alias of sql table.
		 * @var string
		 */
		private $alias = null;
		
		/**
		 * Represents the table join object
		 * @var SqlJoin
		 */
		private $join = null;
		
		/* PROPERTIES */
		
		/**
		 * @return the $name
		 */
		public function getName() 
		{
			return $this->name;
		}
	
		/**
		 * @return the $alias
		 */
		public function getAlias() 
		{
			return $this->alias;
		}
		
		/**
		 * @return the $join
		 */
		public function getJoin() 
		{
			return $this->join;
		}
		
		
		/* PUBLIC METHODS */
	
		/**
		 * Accepts visitor for the current sql object.
		 * 
		 * @param ISqlCompiler $visitor The visitor as SqlCompiler.
		 */
		public function AcceptVisitor(SqlCompiler $visitor)
		{
			$visitor->VisitTable($this);
		}
	
	}

?>