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
	use Spherus\Components\ORM\Component\SqlModel\Interfaces\IORMSelect;
	use Spherus\Components\ORM\Component\SqlModel\DomainModel\Model;
	use Spherus\Components\ORM\Component\SqlModel\Enums\EntityType;
	use Spherus\Core\Check;
	use Spherus\Components\ORM\Component\SqlModel\Base\ORMExpression;
																
	/**
     * Class that represents an ORM select statement
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
	class ORMSelect extends ORMStatement implements IORMSelect
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of ORMSelect class.
	     *
	     * @param string $model The ORM model.
	     */
	    public function __construct($model)
	    {
	    	Check::IsNullOrEmpty($model);
	    	
	        parent::__construct(EntityType::Select);
	        $this->from = $model;
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * Represents an orm model entiry
	     * @var Model
	     */
	    private $model = null;
	
	    /**
	     * Contains a collection of orm select properties.
	     * @var array
	     */
	    private $properties = array();
	
	    /**
	     * Represents a orm select where expression
	     * @var OrmExpression
	    */
	    private $where = null;
	
	    /**
	     * Contains a collection of orm select group by.
	     * @var array
	     */
	    private $groupBy = array();
	
	    /**
	     * Contains an ordered collection of expressions
	     * @var array
	     */
	    private $orderBy = array();
	
	    /**
	     * Determine if orm select is distinct or not. Default is false.
	     * @var boolean
	    */
	    private $distinct = false;
	
	    /**
	     * Contains take limit orm expression
	     * @var ORMExpression
	     */
	    private $take = null;
	
	    /**
	     * Contains elements skip orm expression.
	     * @var ORMExpression
	     */
	    private $skip = null;
	    
	    /**
	     * Contain ORM select includes.
	     * @var array
	     */
	    private $includes = []; 
	
	
	    /* PROPERTIES */
	
	    /**
	     * Determine if current orm select expression is distinct or not.
	     *
	     * @return the $distinct
	     */
	    public function getDistinct()
	    {
	        return $this->distinct;
	    }
	
	    /**
	     * Gets current orm select expression columns collection.
	     *
	     * @return Array $columns
	     */
	    public function getColumns()
	    {
	        return $this->columns;
	    }
	
	    /**
	     * Gets the orm model entity
	     * @var Model
	     */
	    public function getModel()
	    {
	        return $this->model;
	    }
	
	    /**
	     * Gets the orm entity where expression
	     * @var ORMExpression
	     */
	    public function getWhere()
	    {
	        return $this->where;
	    }
	
	    /**
	     * Gets the orm entity GroupBy expression
	     * @var ORMExpression
	     */
	    public function getGroupBy()
	    {
	        return $this->groupBy;
	    }
	
	    /**
	     * @return the $orderBy
	     */
	    public function getOrderBy()
	    {
	        return $this->orderBy;
	    }
	    
	    /**
	     * @return the $includes
	     */
	    public function getIncludes()
	    {
	    	return $this->includes;
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
	     * Adds where sql expression.
	     *
	     * @param SqlExpression $where The where sql expression.
	     *
	     * @return IORMSelect
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
	     * @return IORMSelect
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
	     * @return IORMSelect
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
	     * @return IORMSelect
	     */
	    public function Take($take)
	    {
	        $this->take = $take;
	        return $this;
	    }
	
	    /**
	     * Determine if current select is distinct or not.
	     *
	     * @return IORMSelect
	     */
	    public function Distinct()
	    {
	        $this->distinct = true;
	        return $this;
	    }
	    
	    /**
	     * Includes an ORM expression
	     * @param ORMExpression $expression The ORM expression to include
	     * 
	     * @return IORMSelect
	     */
	    public function Include_($expression)
	    {
	    	$this->includes[] = $expression;
	    	return $this;
	    }
	
	    /**
	     * Gets first element or null if not found
	     */
	    public function First()
	    {
	    	
	    }
	     
	    /**
	     * Gets a list of elements
	    */
	    public function ToList()
	    {
	    	
	    }
	    
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