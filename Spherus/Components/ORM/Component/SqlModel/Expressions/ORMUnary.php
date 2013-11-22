<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlModel\Expressions;
					
	use Spherus\Components\ORM\Component\SqlModel\Base\ORMExpression;
	
	/**
     * Class that represents an ORM unary expressions
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
	class ORMUnary extends ORMExpression
	{
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of ORMUnary class.
	     *
	     * @param string $entityType The type of unary expression.
	     * @param ORMExpression $operand The operand of the unary operator
	     */
	    public function __construct($entityType, $operand)
	    {
	        parent::__construct($entityType);
	        $this->operand = $this->CheckIsLiteral($operand);
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * The operand of the unary operator
	     * @var ORMExpression
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
	     * Accepts visitor for the current ORM entity.
	     *
	     * @param ORMCompiler $visitor The visitor as ORMCompiler.
	     */
	    public function AcceptVisitor($visitor)
	    {
	        $visitor->VisitUnary($this);
	    }
	
	}