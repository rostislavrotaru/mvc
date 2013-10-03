<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Statements;
					
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlExpression;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlTable;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlColumn;
    use Spherus\Core\Check;
					
	/**
     * Class that represents a sql select statement
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlSelect extends SqlExpression
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of SqlSelect class.
	     *
	     * @param SqlTable $from The from sql table.
	     */
	    public function __construct($from = null)
	    {
	        parent::__construct(SqlEntityType::Select);
	        $this->from = $from;
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * Represents a from sql table
	     * @var SqlTable
	     */
	    private $from = null;
	
	    /**
	     * Contains a collection of sql select columns.
	     * @var array
	     */
	    private $columns = array();
	
	    /**
	     * Represents a sql select where expression
	     * @var SqlExpression
	    */
	    private $where = null;
	
	    /**
	     * Contains a collection of sql select group by.
	     * @var array
	     */
	    private $groupBy = array();
	
	    /**
	     * Contain sql select having expression.
	     * @var SqlExpression
	    */
	    private $having = null;
	
	    /**
	     * Contains an ordered collection of expressions
	     * @var array
	     */
	    private $orderBy = array();
	
	    /**
	     * Determine if sql select is distinct or not. Default is false.
	     * @var boolean
	    */
	    private $distinct = false;
	
	    /**
	     * Contains limit sql expression
	     * @var SqlExpression
	     */
	    private $limit = null;
	
	    /**
	     * Contains offset sql expression.
	     * @var SqlExpression
	     */
	    private $offset = null;
	
	
	    /* PROPERTIES */
	
	    /**
	     * Determine if current sql select expression is distinct or not.
	     *
	     * @return the $distinct
	     */
	    public function getDistinct()
	    {
	        return $this->distinct;
	    }
	
	    /**
	     * Gets current sql select expression columns collection.
	     *
	     * @return Array $columns
	     */
	    public function getColumns()
	    {
	        return $this->columns;
	    }
	
	    /**
	     * @return the $from expression
	     */
	    public function getFrom()
	    {
	        return $this->from;
	    }
	
	    /**
	     * @return the $where
	     */
	    public function getWhere()
	    {
	        return $this->where;
	    }
	
	    /**
	     * @return the $groupBy
	     */
	    public function getGroupBy()
	    {
	        return $this->groupBy;
	    }
	
	    /**
	     * @return the $having
	     */
	    public function getHaving()
	    {
	        return $this->having;
	    }
	
	    /**
	     * @return the $orderBy
	     */
	    public function getOrderBy()
	    {
	        return $this->orderBy;
	    }
	
	
	    /* PUBLIC METHODS */
	
	    /**
	     * Adds from expression to select statement.
	     *
	     * @param SqlTable $from The from sql table.
	     *
	     * @return SqlSelect
	     */
	    public function From(SqlTable $from)
	    {
	        $this->from = $from;
	        return $this;
	    }
	
	    /**
	     * Add a group by expression(s).
	     *
	     * @param mixed $groupBy The group by expression(s).
	     *
	     * @return SqlSelect
	     */
	    public function GroupBy($groupBy)
	    {
	        if (is_array($groupBy))
	        {
	            foreach ($groupBy as $item)
	            {
	                $this->groupBy[] = $item;
	            }
	        }
	        else
	        {
	            $this->groupBy[] = $groupBy;
	        }
	        	
	        return $this;
	    }
	
	    /**
	     * Adds having expression.
	     *
	     * @param SqlExpression $having The having sql expression.
	     *
	     * @return SqlSelect
	     */
	    public function Having($having)
	    {
	        $this->having = $having;
	        return $this;
	    }
	
	    /**
	     * Adds where sql expression.
	     *
	     * @param SqlExpression $where The where sql expression.
	     *
	     * @return SqlSelect
	     */
	    public function Where($where)
	    {
	        $this->where = $where;
	        return $this;
	    }
	
	    /**
	     * Adds order by sql orders.
	     *
	     * @param mixed $order Array or single object of sql orders.
	     *
	     * @return SqlSelect
	     */
	    public function OrderBy($order)
	    {
	        if (is_array($order))
	        {
	            foreach ($order as $item)
	            {
	                $this->orderBy[] = $item;
	            }
	        }
	        else
	        {
	            $this->orderBy[] = $order;
	        }
	
	        return $this;
	    }
	
	    /**
	     * Adds ofset sql expression.
	     *
	     * @param SqlExpression $offset The offset sql expression.
	     *
	     * @return SqlSelect
	     */
	    public function Offset($offset)
	    {
	        $this->offset = $offset;
	        return $this;
	    }
	
	    /**
	     * Adds limit sql expression.
	     *
	     * @param SqlExpression $limit The limit sql expression.
	     *
	     * @return SqlSelect
	     */
	    public function Limit($limit)
	    {
	        $this->limit = $limit;
	        return $this;
	    }
	
	    /**
	     * Determine if current select is distinct or not.
	     *
	     * @return SqlSelect
	     */
	    public function Distinct()
	    {
	        $this->distinct = true;
	        return $this;
	    }
	
	    /**
	     * Adds column to the select statement.
	     *
	     * @param SqlColumn $column The sql column to add.
	     *
	     * @return SqlSelect
	     */
	    public function AddColumn(SqlColumn $column)
	    {
	        Check::IsNullOrEmpty($column);
	        
	        $this->columns[] = $column;
	        return $this;
	    }
	
	
	    /* PUBLIC METHODS */
	
	    /**
	     * Accepts visitor for the current sql object.
	     *
	     * @param SqlCompiler $visitor The visitor as SqlCompiler.
	     */
	    public function AcceptVisitor($visitor)
	    {
	        $visitor->VisitSelect($this);
	    }
	
	}
?>