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
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SelectType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlSelect;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlColumn;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\ColumnType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlTable;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\TableType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlBinary;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
    use Spherus\Core\SpherusException;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlOrder;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlOrderType;
										
		/**
     * Class that represents the sql database engine compiler
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlTranslator
	{
		
		/* FIELDS */
		
		/**
		 * Defines the open bracket symbol.
		 * 
		 * @var string
		 */
		private $openBracket = '[';
		
		/**
		 * Defines the close bracket symbol.
		 * 
		 * @var string
		 */
		private $closeBracket = ']';
		
		/**
		 * Defines the quote symbol.
		 * @var string
		 */
		private $quote = '\'';
		
		/**
		 * Defines the opening parenthesis symbol.
		 * @var string
		 */
		private $openingParenthesis = '(';
		
		/**
		 * Defines the closing parenthesis symbol.
		 * @var string
		 */
		private $closingParenthesis = ')';
		
		/**
		 * Defines the Column delimiter symbol.
		 * @var string
		 */
		private $columnDelimiter = ',';
		
		/**
		 * Defines the argument delimiter symbol.
		 * @var string
		 */
		private $argumentDelimiter = ',';
		
		/**
		 * Defines the asterisc symbol
		 * @var string
		 */
		private $asterisk = '*';
		
		/**
		 * Defines the begin batch symbol
		 * @var string
		 */
		private $batchBegin = null;
		
		/**
		 * Defines the end batch symbol
		 * @var string
		 */
		private $batchEnd = null;
		
		/**
		 * Defines the delimiter batch symbol
		 * @var string
		 */
		private $batchDelimiter = ';';
		
		
		/* PROPERTIES */
		
		/* (non-PHPdoc)
		 * @see ISqlTranslator::getOpenBracket()
		*/
		public function getOpenBracket() 
		{
			return $this->openBracket;		
		}
				
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getCloseBracket()
		*/
		public function getCloseBracket() 
		{
			return $this->closeBracket;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getQuote()
		*/
		public function getQuote() 
		{
			return $this->quote;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getOpeningParenthesis()
		*/
		public function getOpeningParenthesis() 
		{
			return $this->openingParenthesis;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getClosingParenthesis()
		*/
		public function getClosingParenthesis() 
		{
			return $this->closingParenthesis;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getColumnDelimiter()
		*/
		public function getColumnDelimiter() 
		{
			return $this->columnDelimiter;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getArgumentDelimiter()
		*/
		public function getArgumentDelimiter() 
		{
			return $this->argumentDelimiter;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getAsterisk()
		*/
		public function getAsterisk() 
		{
			return $this->asterisk;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getBatchBegin()
		*/
		public function getBatchBegin() 
		{
			return $this->batchBegin;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getBatchEnd()
		*/
		public function getBatchEnd() 
		{
			return $this->batchEnd;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getBatchDelimiter()
		*/
		public function getBatchDelimiter() 
		{
			return $this->batchDelimiter;
		}
		
		
		/* PUBLIC METHODS */
		
		/**
		 * Encapsulates given string in brackets.
		 * 
		 * @param string $string The string to encapsulate.
		 * 
		 * @return string Encapsulated string.
		 */
		public function EncapsulateInBrackets($string)
		{
			return $this->openBracket.$string.$this->closeBracket;
		}
		
		/**
		 * Encapsulates given string in quotes.
		 * 
		 * @param string $string The string to encapsulate.
		 * 
		 * @return string Encapsulated string.
		 */
		public function EncapsulateInQuotes($string)
		{
			return $this->quote.str_replace("'", "''", $string).$this->quote;
		}
	
		/**
		 * Translates literal value expression.
		 *
		 * @param SqlLiteral $sqlEntity The SqlLiteral expression to translate.
		 *
		 * @return string Translated sql literal expression value.
		 */
		public function TranslateLiteral(SqlLiteral $sqlEntity)
		{
		    $value = $sqlEntity->getValue();

		    if (is_numeric($value))
		    {
		        return $value;
		    }
		    elseif (is_string($value))
		    {
		        return $this->EncapsulateInQuotes($value);
		    }
		    	
		    return $value;
		}

		/**
		 * Translates select sqlpression.
		 *
		 * @param SqlSelect $sqlEntity The sql select object.
		 * @param SelectType $selection The type of sql section.
		 */
		public function TranslateSelect(SqlSelect $sqlEntity, $section)
		{
		    switch ($section)
		    {
		    	case SelectType::Entry:
		    	    {
		    	        return $sqlEntity->getDistinct() ? 'SELECT DISTINCT': 'SELECT';
		    	    }
		    	case SelectType::From:
		    	    {
		    	        return 'FROM';
		    	    }
		    	case SelectType::Where:
		    	    {
		    	        return 'WHERE';
		    	    }
		    	case SelectType::GroupBy:
		    	    {
		    	        return 'GROUP BY';
		    	    }
		    	case SelectType::Having:
		    	    {
		    	        return 'HAVING';
		    	    }
		    	case SelectType::OrderBy:
		    	    {
		    	        return 'ORDER BY';
		    	    }
		    	case SelectType::Take:
		    	    {
		    	        return 'LIMIT';
		    	    }
		    	case SelectType::Skip:
		    	    {
		    	        return 'OFFSET';
		    	    }
		    }
		    	
		    return null;
		}
		
		/**
		 * Translates column expression.
		 *
		 * @param SqlColumn $sqlEntity The sql entity to translate.
		 * @param ColumnSection $section The section type
		 */
		public function TranslateColumn(SqlColumn $sqlEntity, $section)
		{
		    switch ($section)
		    {
		    	case ColumnType::Entry:
		    	    {
		    	        return $this->EncapsulateInBrackets($sqlEntity->getSqlTable()->getName()).'.'.$this->EncapsulateInBrackets($sqlEntity->getName());
		    	    }
		    	case ColumnType::Alias:
		    	    {
		    	        $alias = $sqlEntity->getAlias();
		    	        return isset($alias) ? ('AS '.$this->EncapsulateInBrackets($alias)) : null;
		    	    }
		    	default:
		    	    {
		    	    	return null;
		    	    }
		    }
		}
	
		/**
		 * Translates table object.
		 *
		 * @param SqlTable $sqlEntity The sql table object to translate.
		 * @param TableType $section The TableType to parse.
		 *
		 * @return string|Ambigous <string, NULL>|NULL
		 */
		public function TranslateTable(SqlTable $sqlEntity, $section)
		{
		    switch ($section)
		    {
		    	case TableType::Entry:
		    	    {
		    	        return $this->EncapsulateInBrackets($sqlEntity->getName());
		    	    }
		    	case TableType::Alias:
		    	    {
		    	        $alias = $sqlEntity->getAlias();
		    	        if (isset($alias))
		    	        {
		    	            return $this->EncapsulateInBrackets($alias);
		    	        }
		    	    }
		    }
		    	
		    return null;
		}
	
		/**
		 * Translates binary object,
		 *
		 * @param SqlBinary $sqlEntity The sql binary expression object.
		 * @param SqlEntityType $section The sql object section type.
		 * @return Ambigous <NULL, string>|NULL
		 */
		public function TranslateBinary(SqlBinary $sqlEntity, $section)
		{
		    $sqlEntityType = $sqlEntity->getSqlEntityType();
		    switch ($section)
		    {
		    	case SqlEntityType::Entry:
		    	    {
		    	        switch ($sqlEntityType)
		    	        {
		    	        	case SqlEntityType::RawConcat:
		    	        	case SqlEntityType::In:
		    	        	    return $this->openingParenthesis;
		    	        	    default:
		    	        	        {
		    	        	            return null;
		    	        	        }
		    	        }
		    	        
		    	        //return ($sqlEntity->getSqlEntityType() === SqlEntityType::RawConcat) ? null : $this->openingParenthesis;
		    	    }
		    	case SqlEntityType::Exit_:
		    	    {
		    	        switch ($sqlEntityType)
		    	        {
		    	        	case SqlEntityType::RawConcat:
		    	        	case SqlEntityType::In:
		    	        	    return $this->closingParenthesis;
		    	        	default:
		    	        	    {
		    	        	        return null;
		    	        	    }
		    	        }
		    	        //return ($sqlEntity->getSqlEntityType() === SqlEntityType::RawConcat) ? null : $this->closingParenthesis;
		    	    }
		    }
		    	
		    return null;
		}
		
		/**
		 * Transates sql object types.
		 *
		 * @param SqlEntityType $sqlEntityType The sql object type to tranlsate.
		 *
		 * @throws Exception Not supported type exception.
		 * @return string|NULL
		 */
		public function TranslateType($sqlEntityType)
		{
		    switch ($sqlEntityType)
		    {
		    	case SqlEntityType::All:
		    	    return 'ALL';
		    	case SqlEntityType::Any:
		    	    return 'ANY';
		    	case SqlEntityType::Some:
		    	    return 'SOME';
		    	case SqlEntityType::Exists:
		    	    return 'EXISTS';
		    	case SqlEntityType::BitAnd:
		    	    return '&';
		    	case SqlEntityType::BitNot:
		    	    return '~';
		    	case SqlEntityType::BitOr:
		    	    return '|';
		    	case SqlEntityType::BitXor:
		    	    return '^';
		    	case SqlEntityType::In:
		    	    return 'IN';
		    	case SqlEntityType::Between:
		    	    return 'BETWEEN';
		    	case SqlEntityType::And_:
		    	    return 'AND';
		    	case SqlEntityType::Or_:
		    	    return 'OR';
		    	case SqlEntityType::IsNull:
		    	    return 'IS NULL';
		    	case SqlEntityType::IsNotNull:
		    	    return 'IS NOT NULL';
		    	case SqlEntityType::Not:
		    	    return 'NOT';
		    	case SqlEntityType::NotBetween:
		    	    return 'NOT BETWEEN';
		    	case SqlEntityType::NotIn:
		    	    return 'NOT IN';
		    	case SqlEntityType::GreaterThan:
		    	    return '>';
		    	case SqlEntityType::GreaterThanOrEqual:
		    	    return '>=';
		    	case SqlEntityType::LessThan:
		    	    return '<';
		    	case SqlEntityType::LessThanOrEqual:
		    	    return '<=';
		    	case SqlEntityType::Equal:
		    	case SqlEntityType::Assign:
		    	    return '=';
		    	case SqlEntityType::NotEqual:
		    	    return '<>';
		    	case SqlEntityType::Add:
		    	    return '+';
		    	case SqlEntityType::Subtract:
		    	case SqlEntityType::Negate:
		    	    return '-';
		    	case SqlEntityType::Multiply:
		    	    return '*';
		    	case SqlEntityType::Mod:
		    	    return '%';
		    	case SqlEntityType::Divide:
		    	    return '/';
		    	case SqlEntityType::Avg:
		    	    return 'AVG';
		    	case SqlEntityType::Count:
		    	    return 'COUNT';
		    	case SqlEntityType::Max:
		    	    return 'MAX';
		    	case SqlEntityType::Min:
		    	    return 'MIN';
		    	case SqlEntityType::Sum:
		    	    return 'SUM';
		    	case SqlEntityType::Concat:
		    	    return '||';
		    	case SqlEntityType::Unique:
		    	    return 'UNIQUE';
		    	case SqlEntityType::Union:
		    	    return 'UNION';
		    	case SqlEntityType::Intersect:
		    	    return 'INTERSECT';
		    	case SqlEntityType::Except:
		    	    return 'EXCEPT';
		    	case SqlEntityType::Overlaps:
		    	    return 'OVERLAPS';
		    	case SqlEntityType::RawConcat:
		    	    return null;
		    	default:
		    	    throw new SpherusException(EXCEPTION_OPERATION_NOT_SUPPORTED.': "'.$sqlEntityType. '".');
		    }
		}
	
		/**
		 * Translates OrderBy expression.
		 *
		 * @param SqlOrder $sqlEntity The sql order entity.
		 * @param SqlOrderType $section. The type of sql order.
		 *
		 * @return string
		 */
		public function TranslateOrderBy(SqlOrder $sqlEntity, $section)
		{
		    switch ($section)
		    {
		    	case SqlEntityType::Exit_:
		    	    {
		    	        if ($sqlEntity->getSqlOrderType() == SqlOrderType::Ascending)
		    	        {
		    	            return 'ASC';
		    	        }
		    	        elseif ($sqlEntity->getSqlOrderType() == SqlOrderType::Descending)
		    	        {
		    	            return 'DESC';
		    	        }
		    	    }
		    }
		    	
		    return null;
		}
	
	}

?>