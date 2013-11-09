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
     * Class that represents a sql if statement
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlIf extends SqlStatement
    {
    
        /* CONSTRUCTOR */
    
        /**
         * Initializes a new instance of SqlIf class.
         *
         * @param SqlExpression $condition The statement condition.
         * @param SqlStatement $true The statement that is executed when condition is true.
         * @param SqlStatement $false The statement that is executed when condition is false.
         */
        public function __construct($condition, $true, $false = null)
        {
            parent::__construct(SqlEntityType::Conditional);
            	
            $this->condition = $condition;
            $this->true = $this->CheckIsLiteral($true);
            $this->false = $this->CheckIsLiteral($false);
        }
    
    
        /* FIELDS */
    
        /**
         * The statement that is executed when condition is true.
         * @var SqlStatement
         */
        private $true = null;
    
        /**
         * The statement that is executed when condition is false.
         * @var SqlStatement
         */
        private $false = null;
    
        /**
         * The statement condition.
         * @var SqlExpression
         */
        private $condition = null;
    
    
        /* PROPERTIES */
    
        /**
         * @return the $true
         */
        public function getTrue()
        {
            return $this->true;
        }
    
        /**
         * @return the $false
         */
        public function getFalse()
        {
            return $this->false;
        }
    
        /**
         * @return the $condition
         */
        public function getCondition()
        {
            return $this->condition;
        }
    
    
        /* PUBLIC METHODS */
    
        /**
         * Accepts visitor for the current sql object.
         *
         * @param SqlCompiler $visitor The visitor as SqlCompiler.
         */
        public function AcceptVisitor($visitor)
        {
            $visitor->VisitIf($this);
        }
    
    }