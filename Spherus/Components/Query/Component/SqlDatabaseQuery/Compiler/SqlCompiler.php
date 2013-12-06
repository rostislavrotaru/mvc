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
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlJoinedTable;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlSubQuery;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\CaseType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlCase;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlFunctionType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlFunction;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlRowNumber;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlUnary;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlQueryExpression;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlBatch;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlDelete;
    use Spherus\Core\SpherusException;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlIf;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\InsertType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlAssignment;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlUpdate;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlInsert;
use Spherus\Components\Data\Component\DatabaseParameter;
use Spherus\Components\Data\Component\DatabaseParameterType;
																																																																																																												    
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
		    	
		    return $this->sqlCompilerContext;
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
		
		        $column->getExpression()->AcceptVisitor($this);
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
		
		
		/* MISC STATEMENTS */
		
		/**
		 * Visits sql query expression like union, intersect and except.
		 *
		 * @param SqlQueryExpression $sqlEntity The SqlQueryExpression to visit.
		 */
		public function VisitSqlQueryExpression(SqlQueryExpression $sqlEntity)
		{
		    $sqlEntity->getLeftExpression()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSqlQueryExpression($sqlEntity));
		    $sqlEntity->getRightExpression()->AcceptVisitor($this);
		
		    return $this->sqlCompilerContext;
		}
		
		/**
		 * Visits batch sql statement.
		 *
		 * @param SqlBatch $sqlEntity The sql batch to visit.
		 */
		public function VisitBatch(SqlBatch $sqlEntity)
		{
		    $statements = $sqlEntity->getStatements();
		    if (count($statements) <= 0)
		    {
		        return;
		    }
		    if (count($statements) == 1)
		    {
		        $statements[0]->AcceptVisitor($this);
		    }
		    else
		    {
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->getBatchBegin());
		        foreach($statements as $item)
		        {
		            $item->AcceptVisitor($this);
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->getBatchDelimiter());
		        }
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->getBatchEnd());
		    }
		    	
		    return $this->sqlCompilerContext;
		}
		
		/**
		 * visits delete sql statement.
		 *
		 * @param SqlDelete $sqlObject The sql delete statement to visit.
		 *
		 * @throws Exception Missing FROM sql table object.
		 * @return SqlCompilationResult
		 */
		public function VisitDelete(SqlDelete $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateDelete(SqlEntityType::Entry));
		    
		    $from = $sqlEntity->getFrom();
		    if (!isset($from))
		    {
		        throw new SpherusException(EXCEPTION_INVALID_ARGUMENT);
		    }
		    $from->AcceptVisitor($this);
		    	
		    $where = $sqlEntity->getWhere();
		    if (isset($where))
		    {
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateDelete(SqlEntityType::Where));
		        $where->AcceptVisitor($this);
		    }
		    	
		    return $this->sqlCompilerContext;
		}
		
		/**
		 * Visits IF sql statement.
		 *
		 * @param SqlIf $sqlEntity The SqlIf entity to visit.
		 */
		public function VisitIf(SqlIf $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateIf(SqlEntityType::Entry));
		    	
		    $sqlEntity->getCondition()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateIf(SqlEntityType::True_));
		    $sqlEntity->getTrue()->AcceptVisitor($this);
		    	
		    $false = $sqlEntity->getFalse();
		    if (isset($false))
		    {
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateIf(SqlEntityType::False_));
		        $false->AcceptVisitor($this);
		    }
		    	
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateIf(SqlEntityType::Exit_));
		    return $this->sqlCompilerContext;
		}
		
		/**
		 * Visits sql insert statement.
		 *
		 * @param SqlInsert $sqlEntity The sql insert entity to visit.
		 *
		 * @throws Exception Missing INTO table object.
		 * @return SqlCompilationResult
		 */
		public function VisitInsert(SqlInsert $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateInsert($sqlEntity, InsertType::Entry));
		    	
		    $into = $sqlEntity->getInto();
		    if (!isset($into))
		    {
		        throw new SpherusException(EXCEPTION_INVALID_ARGUMENT);
		    }
		    	
		    $into->AcceptVisitor($this);
	    	
		    $select = $sqlEntity->getSelect();
		    $values = $sqlEntity->getValues();
		    
		    if(isset($select))
		    {
		        if (count($values) > 0)
		        {
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateInsert($sqlEntity, InsertType::ColumnsEntry));

	                $i = 0;
	                foreach ($values as $key=>$value)
	                {
	                    if ($i > 0)
	                    {
	                        $this->sqlCompilerContext->AppendText($this->sqlTranslator->getColumnDelimiter());
	                    }
	                    $i++;
	                    $this->sqlCompilerContext->AppendText($this->sqlTranslator->EncapsulateInBrackets($value[0]->getName()));
	                }
		            	
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateInsert($sqlEntity, InsertType::ColumnsExit));
		        }
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->getOpeningParenthesis());
		        $select->AcceptVisitor($this);
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->getClosingParenthesis());
		    }
		    else
		    {	
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateInsert($sqlEntity, InsertType::ColumnsEntry));
		        
    		    if (count($values) > 0)
    		    {
    		        $i = 0;
    		        foreach ($values as $key=>$value)
    		        {
    		            if ($i > 0)
    		            {
    		                $this->sqlCompilerContext->AppendText($this->sqlTranslator->getColumnDelimiter());
    		            }
    		            $i++;
    		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->EncapsulateInBrackets($value[0]->getName()));
    		        }
    		    }
    		    	
    		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateInsert($sqlEntity, InsertType::ColumnsExit));
		    
    		    if (count($values) == 0)
    		    {
    		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateInsert($sqlEntity, InsertType::DefaultValues));
    		    }
    		    else
    		    {
    		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateInsert($sqlEntity, InsertType::ValuesEntry));
    		        $i = 0;
    		        foreach ($values as $key=>$value)
    		        {
    		            if ($i > 0)
    		            {
    		                $this->sqlCompilerContext->AppendText($this->sqlTranslator->getColumnDelimiter());
    		            }
    		            $i++;
    		            $value[1]->AcceptVisitor($this);
    		        }
    		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateInsert($sqlEntity, InsertType::ValuesExit));
    		    }
		    }
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateInsert($sqlEntity, InsertType::Exit_));
		    	
		    return $this->sqlCompilerContext;
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
		 * Visits joined table object.
		 *
		 * @param SqlJoinedTable $sqlEntity The sql table to visit.
		 */
		public function VisitJoinedTable(SqlJoinedTable $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateJoinExpression($sqlEntity, SqlEntityType::Entry));
		    $sqlEntity->getJoin()->getTable()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateJoinExpression($sqlEntity, SqlEntityType::Specification));
		    $sqlEntity->getJoin()->getForeignTable()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateJoinExpression($sqlEntity, SqlEntityType::Condition));
		    $sqlEntity->getJoin()->GetExpression()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateJoinExpression($sqlEntity, SqlEntityType::Exit_));
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
			$databaseParametersCount = count($this->sqlCompilerContext->getDatabaseParameters());
			$databaseParameterName = $this->sqlTranslator->getParameterPrefix().'p'.($databaseParametersCount + 1);
			$databaseParameter = new DatabaseParameter($databaseParameterName, $this->sqlTranslator->TranslateLiteral($sqlEntity), is_numeric($sqlEntity) ? DatabaseParameterType::Integer: DatabaseParameterType::Varchar);
		    $this->sqlCompilerContext->AppendText($databaseParameter->getName());
		    $this->sqlCompilerContext->AddDatabaseParameter($databaseParameter);
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
		    $sqlEntity->getRightExpression()->AcceptVisitor($this);
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
    
		/**
		 * Visits sql subquery expression.
		 *
		 * @param SqlSubQuery $sqlObject The subquery to visit.
		 */
		public function VisitSubQuery(SqlSubQuery $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSubquery($sqlEntity, SqlEntityType::Entry));
		    $sqlEntity->getSqlStatement()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateSubquery($sqlEntity, SqlEntityType::Exit_));
		}
		
		/**
		 * Visits case sql expression.
		 *
		 * @param SqlCase $sqlEntity The sql CASE expression.
		 */
		public function VisitCase(SqlCase $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateCase(CaseType::Entry));
		    	
		    $input = $sqlEntity->getInput();
		    if (isset($input))
		    {
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateCase(CaseType::Input));
		        $input->AcceptVisitor($this);
		    }
		    	
		    $caseExpressions = $sqlEntity->getExpressions();
		    foreach ($caseExpressions as $caseObject)
		    {
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateCase(CaseType::When));
		        $caseObject->getWhen()->AcceptVisitor($this);
		
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateCase(CaseType::Then));
		        $caseObject->getThen()->AcceptVisitor($this);
		    }
		    	
		    $elseExpression = $sqlEntity->getElse();
		    if (isset($elseExpression))
		    {
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateCase(CaseType::Else_));
		        $elseExpression->AcceptVisitor($this);
		    }
		    	
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateCase(CaseType::Exit_));
		    	
		}
    
		/**
		 * Visits sql function.
		 *
		 * @param SqlFunction $sqlEntity The sql function to visit.
		 */
		public function VisitFunction(SqlFunction $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateFunction($sqlEntity, SqlFunctionType::Entry, -1));
		    $arguments = $sqlEntity->getArguments();
		    if (count($arguments) > 0)
		    {
		        $argumentPosition = 0;
		        foreach ($arguments as $item)
		        {
		            if ($argumentPosition > 0)
		            {
		                $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateFunction($sqlEntity, SqlFunctionType::ArgumentDelimiter, $argumentPosition));
		            }
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateFunction($sqlEntity, SqlFunctionType::ArgumentEntry, $argumentPosition));
		            $item->AcceptVisitor($this);
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateFunction($sqlEntity, SqlFunctionType::ArgumentExit, $argumentPosition));
		            $argumentPosition++;
		        }
		    }
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateFunction($sqlEntity, SqlFunctionType::Exit_, -1));
		}
    
		/**
		 * Visits RowNumber expression.
		 *
		 * @param SqlRowNumber $sqlEntity The SqlRowNumber entity to visit.
		 */
		public function VisitRowNumber(SqlRowNumber $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateRowNumber(SqlEntityType::Entry));
		    	
		    $orderBy = $sqlEntity->getOrderBy();
		    $i = 0;
		    foreach ($orderBy as $item)
		    {
		        if ($i > 0)
		        {
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->columnDelimiter);
		        }
		        $i++;
		        $item->AcceptVisitor($this);
		    }
		    	
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateRowNumber(SqlEntityType::Exit_));
		}
        
		/**
		 * Visits unary expression.
		 *
		 * @param SqlUnary $sqlEntity The SqlUnary to visit.
		 */
		public function VisitUnary(SqlUnary $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateUnary($sqlEntity, SqlEntityType::Entry));
		    $sqlEntity->getOperand()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateUnary($sqlEntity, SqlEntityType::Exit_));
		}
		
		/**
		 * Visits Update sql entity.
		 *
		 * @param SqlUpdate $sqlEntity The sql update entity to visit
		 */
		public function VisitUpdate(SqlUpdate $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateUpdate(SqlEntityType::Entry));
		    $updateTable = $sqlEntity->getTable();
		    if (!isset($updateTable))
		    {
		        throw new SpherusException(EXCEPTION_INVALID_ARGUMENT);
		    }
		    	
		    $updateTable->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateUpdate(SqlEntityType::Set));
		    	
		    $values = $sqlEntity->getValues();
		    $i = 0;
		    foreach ($values as $key=>$value)
		    {
		        if ($i > 0 )
		        {
		            $this->sqlCompilerContext->AppendText($this->sqlTranslator->getColumnDelimiter());
		        }
		        $i++;
		
		        $column = $value->getLeftExpression();
		
		        if ($column->getSqlTable() !== $updateTable)
		        {
		            throw new SpherusException(EXCEPTION_INVALID_ARGUMENT);
		        }
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->EncapsulateInBrackets($column->getName()));
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateType(SqlEntityType::Equal));
		
		        $value->getRightExpression()->AcceptVisitor($this);
		    }
		    	
		    $from = $sqlEntity->getFrom();
		    if (isset($from))
		    {
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateUpdate(SqlEntityType::From));
		        $from->AcceptVisitor($this);
		    }
		    	
		    $where = $sqlEntity->getWhere();
		    if (isset($where))
		    {
		        $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateUpdate(SqlEntityType::Where));
		        $where->AcceptVisitor($this);
		    }
		    	
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateUpdate(SqlEntityType::Exit_));
		    	
		    return $this->sqlCompilerContext;
		}
    
		/**
		 * Visits sql assignment entity.
		 *
		 * @param SqlAssign $sqlEntity The sql assign object to visit.
		 */
		public function VisitAssign(SqlAssignment $sqlEntity)
		{
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateAssign(SqlEntityType::Entry));
		    $sqlEntity->getLeftExpression()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateType($sqlEntity->getEntityType()));
		    $sqlEntity->getRightExpression()->AcceptVisitor($this);
		    $this->sqlCompilerContext->AppendText($this->sqlTranslator->TranslateAssign(SqlEntityType::Exit_));
		}
    }