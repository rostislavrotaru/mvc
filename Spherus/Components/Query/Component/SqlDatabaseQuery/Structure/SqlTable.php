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
    use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlFactory;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlJoinType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlJoin;
use Spherus\Core\Check;
						
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
		 * @param array $columns Array of column objects.
		 */
		public function __construct($name = null, $alias = null,  array $columns = null)
		{
			parent::__construct(SqlEntityType::Table);
			
			$this->name = $name;
			$this->alias = $alias;
			if (isset($columnNames))
			{
				foreach ($columns as $column)
				{
					$this->AddColumn($column);
				}
			}
		}
		
		/* FIELDS */
		
		/**
		 * Contains collection of sql table columns
		 * @var array
		 */
		public $columns = [];
		
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
		
		
		/* PUBLIC METHODS */
	
		/**
		 * Accepts visitor for the current sql entiry.
		 * 
		 * @param ISqlCompiler $visitor The visitor as SqlCompiler.
		 */
		public function AcceptVisitor(SqlCompiler $visitor)
		{
            $visitor->VisitTable($this);
		}
		
		/**
		 * Adds column to the sql table.
		 *
		 * @param SqlColumn $column The column to add.
		 */
		public function AddColumn(SqlColumn $column)
		{
		    Check::IsNullOrEmpty($column);
		    
		    $column->setSqlTable($this);
		    $this->columns[$column->getName()] = $column;
		}
		
		/**
		* Creates a left join for table.
		*
		* @param SqlTable $foreignTable The foreign table or joined table.
		* @param array|SqlJoinColumn $joinColumns The join columns array or single object.
		*
		* @return SqlTable
		*/
		public function LeftJoin(SqlTable $foreignTable, $joinColumns)
		{
		    return SqlFactory::Join($this, $foreignTable, $joinColumns, SqlJoinType::LeftJoin);
		}
		
		/**
		 * Creates a left outer join for table.
		 *
		 * @param SqlTable $foreignTable The foreign table or joined table.
		 * @param array|SqlJoinColumn $joinColumns The join columns array or single object.
		 *
		 * @return SqlTable
		 */
		public function LeftOuterJoin(SqlTable $foreignTable, $joinColumns)
		{
		    return SqlFactory::Join($this, $foreignTable, $joinColumns, SqlJoinType::LeftOuterJoin);
		}
		
		/**
		 * Creates a right outer join for table.
		 *
		 * @param SqlTable $foreignTable The foreign table or joined table.
		 * @param array|SqlJoinColumn $joinColumns The join columns array or single object.
		 *
		 * @return SqlTable
		 */
		public function RightOuterJoin(SqlTable $foreignTable, $joinColumns)
		{
		    return SqlFactory::Join($this, $foreignTable, $joinColumns, SqlJoinType::RightOuterJoin);
		}
		
		/**
		 * Creates a right join for table.
		 *
		 * @param SqlTable $foreignTable The foreign table or joined table.
		 * @param array|SqlJoinColumn $joinColumns The join columns array or single object.
		 *
		 * @return SqlTable
		 */
		public function RightJoin(SqlTable $foreignTable, $joinColumns)
		{
		    return SqlFactory::Join($this, $foreignTable, $joinColumns, SqlJoinType::RightJoin);
		}
		
		/**
		 * Creates a inner join for table.
		 *
		 * @param SqlTable $foreignTable The foreign table or joined table.
		 * @param array|SqlJoinColumn $joinColumns The join columns array or single object.
		 *
		 * @return SqlTable
		 */
		public function InnerJoin(SqlTable $foreignTable, $joinedColumns)
		{
		    return SqlFactory::Join($this, $foreignTable, $joinedColumns, SqlJoinType::InnerJoin);
		}
		
	}