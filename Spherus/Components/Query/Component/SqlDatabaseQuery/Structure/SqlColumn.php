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
		 */
		public function __construct($name, SqlTable $sqlTable = null)
		{
			parent::__construct(SqlEntityType::Column);
			
			$this->name = $name;
			$this->sqlTable = $sqlTable;
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
		
		
		/* PROPERTIES */
	
		/**
		 * @return string The name of sql column.
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
	
	
		/* PUBLIC METHODS */
		
		/**
		 * Accepts visitor for the current sql object.
		 * 
		 * @param ISqlCompiler $visitor The visitor as SqlCompiler.
		 */
		public function AcceptVisitor(SqlCompiler $visitor)
		{
			$visitor->VisitColumn($this);
		}
	
	}

?>