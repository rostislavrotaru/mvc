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
					
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlExpression;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlColumn;
				
	/**
     * Class that represents a join columns expression
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlJoinColumn extends SqlExpression
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of SqlJoinColumn class.
	     *
	     * @param SqlExpression $expression The sql expression.
	     * @param string $alias The column sql expression alias.
	     */
	    public function __construct(SqlColumn $column, SqlColumn $foreignColumn)
	    {
	        parent::__construct(SqlEntityType::JoinedColumns);
	        	
	        $this->column = $column;
	        $this->foreignColumn = $foreignColumn;
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * Constains column expression.
	     * @var SqlColumn
	     */
	    private $column = null;
	
	    /**
	     * Constains foreign column expression.
	     * @var SqlColumn
	     */
	    private $foreignColumn = null;
	
	
	    /* PROPERTIES */
	    
    	/**
         * @return the $column
         */
        public function getColumn()
        {
            return $this->column;
        }

    	/**
         * @return the $foreignColumn
         */
        public function getForeignColumn()
        {
            return $this->foreignColumn;
        }
	}