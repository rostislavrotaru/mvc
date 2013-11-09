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
			
	/**
     * Class that represents a sql aggregate expressions
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlCase extends SqlExpression
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initialize a new instance of SqlCase object.
	     *
	     * @param SqlExpressioin $input The input expression.
	     */
	    public function __construct($input = null)
	    {
	        parent::__construct(SqlEntityType::Case_);
	        	
	        $this->input = $input;
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * Contains CASE input expression.
	     * @var SqlExpression
	     */
	    private $input = null;
	
	    /**
	     * Contains CASE expressions array of SqlCaseObject's
	     * @var array
	     */
	    private $expressions = array();
	
	    /**
	     * Contains ELSE expression
	     * @var SqlExpression
	    */
	    private $else = null;
	
	
	    /* PROPERTIES */
	
	    /**
	     * @return the CASE input expression
	     */
	    public function getInput()
	    {
	        return $this->input;
	    }
	
	    /**
	     * @return The CASE expressions array of SqlCaseObject's
	     */
	    public function getExpressions()
	    {
	        return $this->expressions;
	    }
	
	    /**
	     * @return the $else expression
	     */
	    public function getElse()
	    {
	        return $this->else;
	    }
	
	    /* PUBLIC METHODS*/
	
	    /**
	     * Sets ELSE expression for CASE.
	     *
	     * @param SqlExpression $else
	     */
	    public function Else_($else)
	    {
	        $this->else = $this->CheckIsLiteral($else);
	    }
	
	    /**
	     * Adds a condition to the SqlCase expression.
	     *
	     * @param SqlExpression $when The WHEN sql expression.
	     * @param SqlExpression $then The THEN sql expression.
	     */
	    public function Condition($when, $then)
	    {
	        $this->expressions[] = new SqlCaseObject($when, $then);
	    }
	
	    /**
	     * Accepts visitor for the current sql entity.
	     *
	     * @param SqlCompiler $visitor The visitor as SqlCompiler.
	     */
	    public function AcceptVisitor($visitor)
	    {
	        $visitor->VisitCase($this);
	    }
	
	}