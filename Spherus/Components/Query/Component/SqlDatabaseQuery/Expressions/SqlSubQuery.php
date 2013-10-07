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

	use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlExpression;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlStatement;
																																	
	/**
     * Class that represents the sql database engine
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlSubQuery extends SqlExpression
    {
        /* CONSTRUCTOR */
    
        /**
         * Initializes a new instance of SqlSubQuery class.
         *
         * @param SqlStatement $sqlStatement The containing sql statement
         */
        public function __construct(SqlStatement $sqlStatement)
        {
            parent::__construct(SqlEntityType::SubQuery);
            	
            $this->sqlStatement = $sqlStatement;
        }
    
    
        /* FIELDS */
    
        /**
         * Contains subquery sql statement.
         * @var SqlStatement
         */
        private $sqlStatement = null;
    
    
        /* PROPERTIES */
    
        /**
         * @return the $sqlStatement
         */
        public function getSqlStatement()
        {
            return $this->sqlStatement;
        }
    
    
        /* PUBLIC METHODS */
    
        /**
         * Accepts visitor for the current sql entity.
         *
         * @param SqlCompiler $visitor The visitor as SqlCompiler.
         */
        public function AcceptVisitor($visitor)
        {
            $visitor->VisitSubQuery($this);
        }
    
    }