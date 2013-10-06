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
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\ColumnType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SelectType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlSelect;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlColumn;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlTable;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\TableType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlBinary;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlOrder;
																												    
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
		
		
		/* VISITOR METHODS*/
		
		/* SELECT */
		
		/**
		 * Visits select object.
		 *
		 * @param SqlSelect $select The SqlSelect to visit
		 */
		public function VisitSelect(SqlSelect $select)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSelect($select, SelectType::Entry));
		    $this->VisitSelectColumns($select);
		    $this->VisitSelectFrom($select);
		    $this->VisitSelectWhere($select);
		    $this->VisitSelectGroupBy($select);
		    $this->VisitSelectOrderBy($select);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSelect($select, SelectType::Exit_));
		    	
		    return $this->sqlCompilerContext->getSql();
		}
		
		/**
		 * Visits select object columns.
		 *
		 * @param SqlSelect $select The SqlSelect to visit
		 */
		public function VisitSelectColumns(SqlSelect $select)
		{
		    $columns = $select->getColumns();
		    if (count($columns) <= 0)
		    {
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->getAsterisk());
		        return;
		    }
		    	
		    $i = 0;
		    foreach ($columns as $column)
		    {
		        if ($i > 0)
		        {
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->getColumnDelimiter());
		        }
		        $i++;
		
		        $column->AcceptVisitor($this);
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateColumn($column, ColumnType::Alias));
		    }
		    
		    unset($i);
		    unset($columns);
		    unset($column);
		}
		
		/**
		 * Visits select FROM expression
		 * @param SqlSelect $select The sql select expression to visit.
		 */
		public function VisitSelectFrom(SqlSelect $select)
		{
		    $from = $select->getFrom();
		    if (!isset($from))
		    {
		        return;
		    }
		    	
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSelect($select, SelectType::From));
		    $from->AcceptVisitor($this);
		}
		
		/**
		 * Visits select WHERE expression.
		 *
		 * @param SqlSelect $select The sql select expression to visit.
		 */
		public function VisitSelectWhere(SqlSelect $select)
		{
		    $where = $select->getWhere();
		    if (!isset($where))
		    {
		        return;
		    }
		    	
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSelect($select, SelectType::Where));
		    $where->AcceptVisitor($this);
		}
    
		/**
		 * Visits select GroupBy section.
		 *
		 * @param SqlSelect $select The sql select to visit.
		 */
		public function VisitSelectGroupBy(SqlSelect $select)
		{
		    $groupBy = $select->getGroupBy();
		    if (count($groupBy) <= 0)
		    {
		        return;
		    }
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSelect($select, SelectType::GroupBy));
		    $i = 0;
		    foreach ($groupBy as $column)
		    {
		        if ($i > 0)
		        {
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->columnDelimiter);
		        }
		        $i++;
		
		        $column->AcceptVisitor($this);
		    }
		    	
		    $having = $select->getHaving();
		    if (!isset($having))
		    {
		        return;
		    }
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSelect($select, SelectType::Having));
		    $having->AcceptVisitor($this);
		}
		
		/**
		 * Visits select OrderBy section.
		 * @param SqlSelect $select
		 */
		public function VisitSelectOrderBy(SqlSelect $select)
		{
		    $orderBy = $select->getOrderBy();
		    if (count($orderBy) <= 0)
		    {
		        return;
		    }
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSelect($select, SelectType::OrderBy));
		    $i = 0;
		    foreach ($orderBy as $orderByObject)
		    {
		        if ($i > 0)
		        {
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->getColumnDelimiter());
		        }
		        $i++;
		
		        $orderByObject->AcceptVisitor($this);
		    }
		}
		
		
		/* MISC */
		
		/**
		 * Visits table object.
		 * @param SqlTable $sqlEntity The sql table object to visit.
		 */
		public function VisitTable(SqlTable $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateTable($sqlEntity, TableType::Entry));
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateTable($sqlEntity, TableType::Alias));
		}
		
		/**
		 * Visits column entity
		 *
		 * @param SqlColumn $sqlEntity The SqlColumnExpression to visit.
		 */
		public function VisitColumn(SqlColumn $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateColumn($sqlEntity, ColumnType::Entry));
		}
		
		/**
		 * Visits literal expression
		 *
		 * @param SqlLiteral $sqlEntity The SqlLiteral expression to visit.
		 */
		public function VisitLiteral(SqlLiteral $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateLiteral($sqlEntity));
		}
    
		/**
		 * Visits binary sql expression.
		 *
		 * @param SqlBinary $sqlEntity The binary sql expression to visit.
		 */
		public function VisitBinary(SqlBinary $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateBinary($sqlEntity, SqlEntityType::Entry));
		    $sqlEntity->getLeftExpression()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateType($sqlEntity->getSqlEntityType()));
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->getOpeningParenthesis());
		    $sqlEntity->getRightExpression()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->getClosingParenthesis());
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateBinary($sqlEntity, SqlEntityType::Exit_));
		}
    
		/**
		 * Visits sql order by object
		 * @param SqlOrder $sqlEntity The sql order entity to visit.
		 */
		public function VisitOrderBy(SqlOrder $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateOrderBy($sqlEntity, SqlEntityType::Entry));
            $sqlExpression = $sqlEntity->getSqlExpression();
			if (isset($sqlExpression))
			{
				$sqlExpression->AcceptVisitor($this);
			}
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateOrderBy($sqlEntity, SqlEntityType::Exit_));
		    	
		}
    
    }