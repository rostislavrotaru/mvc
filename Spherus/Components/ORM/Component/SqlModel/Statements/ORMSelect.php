<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlModel\Statements;
					
	use Spherus\Components\ORM\Component\SqlModel\Base\ORMStatement;
	use Spherus\Components\ORM\Component\SqlModel\DomainModel\Model;
	use Spherus\Components\ORM\Component\SqlModel\Enums\EntityType;
													
	/**
     * Class that represents an ORM select statement
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
	class ORMSelect extends ORMStatement
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of SqlSelect class.
	     *
	     * @param SqlTable $from The from sql table.
	     */
	    public function __construct(Model $model)
	    {
	        parent::__construct(EntityType::Select);
	        $this->from = $model;
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * Represents a from orm entiry
	     * @var Model
	     */
	    private $model = null;
	
	    /**
	     * Contains a collection of sql select columns.
	     * @var array
	     */
	    private $properties = array();
	
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
	     * Contains take limit sql expression
	     * @var SqlExpression
	     */
	    private $take = null;
	
	    /**
	     * Contains elements skip sql expression.
	     * @var SqlExpression
	     */
	    private $skip = null;
	
	
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
	     * @return the $model expression
	     */
	    public function getModel()
	    {
	        return $this->model;
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
	     * Adds skip sql expression.
	     *
	     * @param SqlExpression $skip The skip elements.
	     *
	     * @return SqlSelect
	     */
	    public function Skip($skip)
	    {
	        $this->skip = $skip;
	        return $this;
	    }
	
	    /**
	     * Adds take sql expression.
	     *
	     * @param SqlExpression $take The take limit sql expression.
	     *
	     * @return SqlSelect
	     */
	    public function Take($take)
	    {
	        $this->take = $take;
	        return $this;
	    }
	
	    /**
	     * Determine if current select is distinct or not.
	     *
	     * @return ORMSelect
	     */
	    public function Distinct()
	    {
	        $this->distinct = true;
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