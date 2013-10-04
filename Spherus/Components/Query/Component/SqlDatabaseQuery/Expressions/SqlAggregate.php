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
		
	/**
     * Class that represents a sql aggregate expressions
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlAggregate extends SqlExpression
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of SqlAggregate class.
	     *
	     * @param SqlEntityType $entityType The sql object type
	     * @param SqlExpression $expression The aggregate expression.
	     * @param boolean $distinct Determine if SqlExpression is distinct or not
	     */
	    public function __construct($entityType, $expression, $distinct)
	    {
	        parent::__construct($entityType);
	        	
	        $this->expression = $expression;
	        $this->distinct = $distinct;
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * Determine if expression is distinct or not
	     * @var boolean
	     */
	    private $distinct = false;
	
	    /**
	     * Contains sql expression
	     * @var SqlExpression
	     */
	    private $expression = null;
	
	
	    /* PROPERTIES */
	
	    /**
	     * @return the $distinct
	     */
	    public function getDistinct()
	    {
	        return $this->distinct;
	    }
	
	    /**
	     * @return the $expression
	     */
	    public function getExpression()
	    {
	        return $this->expression;
	    }
	
	}

?>