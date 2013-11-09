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
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
				
	/**
     * Class that represents a sql column entity
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.componenrs.query
     */
	class SqlColumn extends SqlEntity
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of SqlColumn object.
		 * 
		 * @param string $name The sql column name.
		 * @param SqlTable $sqlTable The parent sql table object.
		 * @param string $alias The sql column alias. 
		 */
		public function __construct($name, SqlTable $sqlTable = null, $alias = null)
		{
			parent::__construct(SqlEntityType::Column);
			
			$this->name = $name;
			$this->sqlTable = $sqlTable;
			$this->alias = $alias;
		}
		
		
		/* FIELDS */
		
		/**
		 * Represents the parent sql table
		 * @var SqlTable
		 */
		private $sqlTable = null;
		
		/**
		 * Determine the name of sql column.
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Determine the alias of sql column.
		 * @var string
		 */
		private $alias = null;
		

		/* PROPERTIES */
	
		/**
		 * @return The name of sql column.
		 * @var string
		 */
		public function getName() 
		{
			return $this->name;
		}
		
		/**
		 * @return SqlTable The parent sql table
		 * @var SqlTable
		 */
		public function getSqlTable() 
		{
			return $this->sqlTable;
		}
		
		/**
		 * Sets column table
		 * @param SqlTable $sqlTable The table to set
		 */
		public function setSqlTable(SqlTable $sqlTable)
		{
		    $this->sqlTable = $sqlTable;
		}
	
		/**
		 * @return The alias of sql column.
		 * @var string
		 */
		public function getAlias()
		{
		    return $this->alias;
		}
		
	
		/* PUBLIC METHODS */
		
		/**
		 * Accepts visitor for the current sql entity.
		 * 
		 * @param ISqlCompiler $visitor The visitor as SqlCompiler.
		 */
		public function AcceptVisitor(SqlCompiler $visitor)
		{
			$visitor->VisitColumn($this);
		}
	
	}