<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler;

    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlLiteral;
    use pherus\Components\Query\Component\SqlDatabaseQuery\Enums\ColumnType;
								/**
     * Class that represents the sql database engine compiler
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlCompiler
    {
	
    	/* CONSTRUCTOR */
	
		/**
    	 * Initializes a new instance of SqlCompiler class
    	 * 
    	 * @param SqlCompilerContext $sqlCompilerContext The sql compiler context.
    	 * @param SqlTranslator $sqlTranslator The sql translator.
    	 */
		public function __construct(SqlCompilerContext $sqlCompilerContext, SqlTranslator $sqlTranslator) 
		{
			$this->sqlCompilerContext = $sqlCompilerContext;
			$this->sqlTranslator = $sqlTranslator;
		}

		/* FILEDS */
		
		/**
		 * Defines the sql compiler context
		 * @var SqlCompilerContext
		 */
		private $sqlCompilerContext = null;
		
		/**
		 * Defines the sql translator
		 * @var SqlTranslator
		 */
		private $sqlTranslator = null;

		
		/* PROPERTIES */
		
		/* (non-PHPdoc)
		 * @see ISqlCompiler::getSqlCompilerContext()
		*/
		public function getSqlCompilerContext() 
		{
			return $this->sqlCompilerContext;
		}
		
		/* (non-PHPdoc)
		 * @see SqlCompiler::getSqlTranslator()
		*/
		public function getSqlTranslator() 
		{
			return $this->sqlTranslator;
		}
		
		/* VISITOR  METHODS*/
		
		/**
		 * Visits literal expression
		 *
		 * @param SqlLiteral $sqlEntity The SqlLiteral expression to visit.
		 */
		public function VisitLiteral(SqlLiteral $sqlEntity)
		{
		    $this->context->AppendText($this->sqlTranslator->TranslateLiteral($sqlEntity));
		}
		
		/**
		 * Visits column entity
		 *
		 * @param SqlColumnExpression $sqlObject The SqlColumnExpression to visit.
		 */
		public function VisitColumn($sqlObject)
		{
		    $this->context->AppendText($this->translator->TranslateColumn($sqlObject, ColumnType::Entry));
		}

    }