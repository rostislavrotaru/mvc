<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions;
					
    use spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlJoinType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlExpression;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlFactory;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlColumn;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlTable;
								
		/**
     * Class that represents a sql literal expression type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlJoin extends SqlExpression
	{
		

	    /* CONSTRUCTOR */
	    
	    /**
	     * Initializes a new instance of SlqJoin class.
	     *
	     * @param SqlTable $table The joined table.
	     * @param SqlTable $foreignTable The foreign joined table.
	     * @param SqlColumn $column The current join column.
	     * @param SqlColumn $foreignColumn The foreign join column.
	     * @param SqlJoinType $joinType The type of join.
	     */
	    public function __construct(SqlTable $table, SqlTable $foreignTable, SqlColumn $column, SqlColumn $foreignColumn, $joinType = SqlJoinType::InnerJoin)
	    {
	        parent::__construct(SqlEntityType::Join);
	        	
	        $this->column = $column;
	        $this->foreignColumn = $foreignColumn;
	        $this->joinType = $joinType;
	        $this->table = $table;
	        $this->foreignTable = $foreignTable;
	    }
	    
	    
	    /* FIELDS */
	    
	    /**
	     * Represents the expression join type
	     *
	     * @var SqlJoinType
	     */
	    private $joinType = SqlJoinType::InnerJoin;
	    
	    /**
	     * Represents the join column.
	     *
	     * @var SqlColumn
	     */
	    private $column = null;
	    
	    /**
	     * Represents the join foreign column.
	     *
	     * @var SqlColumn
	     */
	    private $foreignColumn = null;
	    
	    /**
	     * Represents the foreign joined table
	     * @var SqlTable
	     */
	    private $table = null;
	    
	    /**
	     * Represents the joined foreign table
	     * @var SqlTable
	     */
	    private $foreignTable =  null;
	    
	    
	    /* PROPERTIES */
	    
	    /**
	     * @return the $foreignColumn
	     */
	    public function getForeignColumn()
	    {
	        return $this->foreignColumn;
	    }
	    
	    /**
	     * @return the $joinType
	     */
	    public function getJoinType()
	    {
	        return $this->joinType;
	    }
	    
	    /**
	     * @return the $table
	     */
	    public function getTable()
	    {
	        return $this->table;
	    }
	    
	    /**
	     * @return the $foreignTable
	     */
	    public function getForeignTable()
	    {
	        return $this->foreignTable;
	    }
	    
	    
	    /* PUBLIC METHODS */
	    
	    /**
	     * Get combined join expression.
	     *
	     * @return SqlBinary
	     */
	    public function GetExpression()
	    {
	        return SqlFactory::Equal($this->column, $this->foreignColumn);
	    }
		
	}