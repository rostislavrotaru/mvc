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
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
		
	/**
     * Class that represents a sql unary expressions
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlUnary extends SqlExpression
	{
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of SqlUnary class.
	     *
	     * @param SqlEntityType $entityType The type of unary expression.
	     * @param SqlExpression $operand The operand of the unary operator
	     */
	    public function __construct($entityType, $operand)
	    {
	        parent::__construct($entityType);
	        $this->operand = $operand;
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * The operand of the unary operator
	     * @var SqlExpression
	     */
	    private $operand = null;
	
	
	    /* PROPERTIES */
	
	    /**
	     * @return the $operand
	     */
	    public function getOperand()
	    {
	        return $this->operand;
	    }
	
	    /* PUBLIC METHODS */
	
	    /**
	     * Accepts visitor for the current sql object.
	     *
	     * @param SqlCompiler $visitor The visitor as SqlCompiler.
	     */
	    public function AcceptVisitor($visitor)
	    {
	        $visitor->VisitUnary($this);
	    }
	
	}

?>