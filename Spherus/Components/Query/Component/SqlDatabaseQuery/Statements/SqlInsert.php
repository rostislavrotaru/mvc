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
     * Class that represents a sql insert statement
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlInsert extends SqlStatement
    {
    
        /* CONSTRUCTOR */
    
        /**
         * Initializes a new instance of SqlInsert class
         *
         * @param SqlTable $into The into sql table.
         */
        public function __construct($into)
        {
            parent::__construct(SqlEntityType::Insert);
            	
            $this->into = $into;
        }
    
    
        /* FIELDS */
    
        /**
         * The into table object
         * @var SqlTable
         */
        private $into = null;
    
        /**
         * The insert values array.
         * @var array
         */
        private $values = array();
    
    
        /* PROPERTIES */
    
        /**
         * @return the $into
        */
        public function getInto()
        {
            return $this->into;
        }
    
        /**
         * @return the $values
         */
        public function getValues()
        {
            return $this->values;
        }
    
    
        /* PUBLIC METHODS */
    
        /**
         * Add values for specific column.
         *
         * @param SqlColumn $column
         * @param SqlExpression $expression
         */
        public function Add($column, $expression)
        {
            $this->values[] = array($column, $this->CheckIsLiteral($expression));
            return $this;
        }
    
        /**
         * Accepts visitor for the current sql entity.
         *
         * @param SqlCompiler $visitor The visitor as SqlCompiler.
         */
        public function AcceptVisitor($visitor)
        {
            $visitor->VisitInsert($this);
        }
    }