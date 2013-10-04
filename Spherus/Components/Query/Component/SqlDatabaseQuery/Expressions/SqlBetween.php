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
     * Class that represents a sql between expressions
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlBetween extends SqlExpression
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of SqlBetween class.
	     *
	     * @param SqlEntityType $entityType The type of sql object.
	     * @param SqlExpression $sqlExpression The SqlBetween expression.
	     * @param SqlExpression $leftBoundary The SqlBetween left boundary.
	     * @param SqlExpression $rightBoundary The SqlBetween right boundary.
	     */
	    public function __construct($entityType, $sqlExpression, $leftBoundary, $rightBoundary)
	    {
	        parent::__construct($entityType);
	        	
	        $this->sqlExpression = $this->CheckIsLiteral($sqlExpression);
	        $this->leftBoundary = $this->CheckIsLiteral($leftBoundary);
	        $this->rightBoundary = $this->CheckIsLiteral($rightBoundary);
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * Contains SqlBetween expression
	     * @var SqlExpression
	     */
	    private $sqlExpression = null;
	
	    /**
	     * Contains SqlBetween left boundary
	     * @var SqlExpression
	     */
	    private $leftBoundary = null;
	
	    /**
	     * Contains SqlBetween right boundary
	     * @var SqlExpression
	     */
	    private $rightBoundary = null;
	
	
	    /* PROPERTIES */
	
	    /**
	     * @return the $sqlExpression
	     */
	    public function getSqlExpression()
	    {
	        return $this->sqlExpression;
	    }
	
	    /**
	     * @return the $leftBoundary
	     */
	    public function getLeftBoundary()
	    {
	        return $this->leftBoundary;
	    }
	
	    /**
	     * @return the $rightBoundary
	     */
	    public function getRightBoundary()
	    {
	        return $this->rightBoundary;
	    }
	
	
	    /* PUBLIC METHODS */
	
	    /**
	     * Accepts visitor for the current sql object.
	     *
	     * @param SqlCompiler $visitor The visitor as SqlCompiler.
	     */
	    public function AcceptVisitor($visitor)
	    {
	        $visitor->VisitBetween($this);
	    }
	}

?>