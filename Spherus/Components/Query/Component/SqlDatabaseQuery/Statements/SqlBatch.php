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
     * Class that represents a sql batch
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlBatch extends SqlStatement
    {
    
        /* CONSTRUCTORS */
    
        /**
         * Initializes a new instance of SqlBatch class.
         */
        public function __construct()
        {
            parent::__construct(SqlEntityType::Batch);
        }
    
    
        /* FIELDS */
    
        /**
         * Contains the list of sql statements
         * @var array
         */
        private $statements = array();
    
    
        /* PROPERTIES */
    
        /**
         * @return the $statements
        */
        public function getStatements()
        {
            return $this->statements;
        }
    
    
        /* PUBLIC METHODS */
    
        /**
         * Adds statement to sql batch
         * @param SqlStatement $statement
         */
        public function Add($statement)
        {
            $this->statements[] = $statement;
        }
    
        /**
         * Accepts visitor for the current sql entity.
         *
         * @param SqlCompiler $visitor The visitor as SqlCompiler.
         */
        public function AcceptVisitor(SqlCompiler $visitor)
        {
            $visitor->VisitBatch($this);
        }
    
    }