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
     * Class that represents a column expression
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlQueryExpression extends SqlExpression
    {
    
        /* CONSTRUCTOR */
    
        /**
         * Initializes a new instance of SqlQueryExpression class.
         *
         * @param SqlEntityType $entityType The type of sql entity.
         * @param SqlExpression $leftExpression The left sql query expression.
         * @param SqlExpression $rightExpression The right sql query expression.
         * @param boolean $all Determine if combine all expressions or not.
         */
        public function __construct($entityType, $leftExpression, $rightExpression, $all)
        {
            parent::__construct($entityType);
            	
            $this->leftExpression = $leftExpression;
            $this->rightExpression = $rightExpression;
            $this->all = $all;
        }
    
    
        /* FIELDS */
    
        /**
         * Represents a right sql query expression.
         *
         * @var SqlExpression
         */
        private $leftExpression = null;
    
        /**
         * Represents right sql query expression.
         *
         * @var SqlExpression
         */
        private $rightExpression = null;
    
        /**
         * Determine all expressions or not.
         * @var boolean
         */
        private $all = false;
        
        
        /* PROPERTIES */
        
        /**
         * Gets left sql expression
         * @return SqlExpression
         */
        public function getLeftExpression()
        {
        	return $this->leftExpression;
        }
        
        /**
         * Gets right sql expression
         * @return SqlExpression
         */
        public function getRightExpression()
        {
            return $this->rightExpression;
        }
        
        /**
         * Gets if expressions sould combine
         * @return boolean
         */
        public function getAll()
        {
            return $this->all;
        }
        
        
        /* PUBLIC METHODS */
        
        /**
         * Accepts visitor for the current sql object.
         *
         * @param SqlCompiler $visitor The visitor as SqlCompiler.
         */
        public function AcceptVisitor($visitor)
        {
            $visitor->VisitSqlQueryExpression($this);
        }
    }