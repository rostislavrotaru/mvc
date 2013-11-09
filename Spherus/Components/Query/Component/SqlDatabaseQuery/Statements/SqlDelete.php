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
     * Class that represents a sql delete statement
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlDelete extends SqlStatement
    {
        /* CONSTRUCTOR */
    
        /**
         * Initializes a new instance of SqlDelete class.
         *
         * @param SqlTable $from The from sql table
         */
        public function __construct($from)
        {
            parent::__construct(SqlEntityType::Delete);
            	
            $this->from = $from;
        }
    
    
        /* FIELDS */
    
        /**
         * Contains FROM sql table
         * @var SqlTable
         */
        private $from = null;
    
        /**
         * Contains WHERE expression
         * @var SqlExpression
         */
        private $where = null;
    
    
        /* PROPERTIES */
    
        /**
         * @return the $from
         */
        public function getFrom()
        {
            return $this->from;
        }
    
        /**
         * @return the $where
         */
        public function getWhere()
        {
            return $this->where;
        }
    
    
        /* PUBLIC METHODS */
    
        /**
         * Adds a from sql table
         * @param SqlTable $tableName
         */
        public function From($tableName)
        {
            $this->from = $tableName;
        }
    
        /**
         * Adds a where sql expression
         * @param SqlExpression $tableName
         */
        public function Where($expression)
        {
            $this->where = $expression;
            return $this;
        }
    
        /**
         * Accepts visitor for the current sql entity.
         *
         * @param SqlCompiler $visitor The visitor as SqlCompiler.
         */
        public function AcceptVisitor($visitor)
        {
            $visitor->VisitDelete($this);
        }
    
    
    }