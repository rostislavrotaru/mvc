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
					
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlStatement;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
																
	/**
     * Class that represents a sql assignment
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlAssignment extends SqlStatement
    {
    
        /* CONSTRUCTOR */
    
        /**
         * Initializes a new instance of SqlAssignment class.
         *
         * @param SqlExpression $leftExpression The left sql expression.
         * @param SqlExpression $rightExpression The right sql expression.
         */
        public function __construct($leftExpression, $rightExpression)
        {
            parent::__construct(SqlEntityType::Assign);
            	
            $this->leftExpression = $leftExpression;
            $this->rightExpression = $this->CheckIsLiteral($rightExpression);
        }
    
    
        /* FIELDS */
    
        /**
         * Contains the left sql expression.
         *
         * @var SqlExpression
         */
        private $leftExpression = null;
    
        /**
         * Contains the right sql expression.
         *
         * @var SqlExpression
         */
        private $rightExpression = null;
    
    
        /* PROPERTIES */
    
        /**
         * @return the $leftExpression
         */
        public function getLeftExpression()
        {
            return $this->leftExpression;
        }
    
        /**
         * @return the $rightExpression
         */
        public function getRightExpression()
        {
            return $this->rightExpression;
        }
    
    
        /* PUBLIC METHODS */
    
        /**
         * Accepts visitor for the current sql entity.
         *
         * @param SqlCompiler $visitor The visitor as SqlCompiler.
         */
        public function AcceptVisitor($visitor)
        {
            $visitor->VisitAssign($this);
        }
    }