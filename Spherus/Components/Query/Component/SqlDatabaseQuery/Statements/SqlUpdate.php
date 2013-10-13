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
    use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlFactory;
																				
	/**
     * Class that represents a sql update
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlUpdate extends SqlStatement
    {
    
        /* CONSTRUCTOR */
    
        /**
         * Initializes a new instance of SqlUpdate class.
         *
         * @param SqlTable $table The update table object.
         */
        public function __construct($table)
        {
            parent::__construct(SqlEntityType::Update);
            	
            $this->table = $table;
        }
    
        /* FIELDS */
    
        /**
         * Contains the update table
         * @var SqlTable
         */
        private $table = null;
    
        /**
         * Contains the from sql table
         * @var SqlTable
         */
        private $from = null;
    
        /**
         * Contains the where sql expression.
         * @var SqlExpression
         */
        private $where = null;
    
        /**
         * Contains array of update values
         * @var array
         */
        private $values = array();
    
    
        /* PROPERTIES */
    
        /**
         * @return the $table
        */
        public function getTable()
        {
            return $this->table;
        }
    
        /**
         * @return the $values
         */
        public function getValues()
        {
            return $this->values;
        }
    
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
         * Creates a set assignment for sql update.
         *
         * @param SqlColumn $column The sql column to set value expression.
         * @param SqlExpression $expression The sql expression for to set.
         */
        public function Set($column, $expression)
        {
            $this->values[] = SqlFactory::Assign($column, $expression);
            return $this;
        }
    
        /**
         * Adds a from sql table
         * @param SqlTable $tableName
         */
        public function From($tableName)
        {
            $this->from = $tableName;
            return $this;
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
         * Accepts visitor for the current sql object.
         *
         * @param SqlCompiler $visitor The visitor as SqlCompiler.
         */
        public function AcceptVisitor($visitor)
        {
            $visitor->VisitUpdate($this);
        }
    
    }