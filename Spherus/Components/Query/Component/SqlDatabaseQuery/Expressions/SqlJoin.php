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
	     * @param array|SqlJoinColumn $joinColumns The join columns array or single object.
	     * @param SqlJoinType $joinType The type of join.
	     */
	    public function __construct(SqlTable $table, SqlTable $foreignTable, $joinColumns, $joinType = SqlJoinType::InnerJoin)
	    {
	        parent::__construct(SqlEntityType::Join);
	        	
	        $this->joinType = $joinType;
	        $this->table = $table;
	        $this->foreignTable = $foreignTable;

	        if(is_array($joinColumns))
	        {
                $this->joinColumns = $joinColumns;
	        }
	        else
	        {
	            $this->joinColumns[] = $joinColumns;
	        }
	    }
	    
	    
	    /* FIELDS */
	    
	    /**
	     * Represents the expression join type
	     *
	     * @var SqlJoinType
	     */
	    private $joinType = SqlJoinType::InnerJoin;
	    
	    /**
	     * Represents the joined column expressions.
	     *
	     * @var array
	     */
	    private $joinColumns = null;
	    
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
	     * @return the $joinColumns
	     * var SqlJoinColumn
	     */
	    public function getJoinColumns()
	    {
	        return $this->joinColumns;
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
	        if(count($this->joinColumns) === 1)
	        {
	            return SqlFactory::Equal($this->joinColumns[0]->getColumn(), $this->joinColumns[0]->getForeignColumn());
	        }

	        $i = 0;
	        $currentExpression = null;
	        foreach ($this->joinColumns as $joinColumn) 
	        {
	            if($i === 0)
	            {
	               $currentExpression = SqlFactory::Equal($joinColumn->getColumn(), $joinColumn->getForeignColumn());
	            }
	            else
	            {
	            	$currentExpression = SqlFactory::And_($currentExpression, SqlFactory::Equal($joinColumn->getColumn(), $joinColumn->getForeignColumn()));
	            }
	        	$i++;
	        }
	        
	        unset($i);
	        return $currentExpression;
	    }
		
	}