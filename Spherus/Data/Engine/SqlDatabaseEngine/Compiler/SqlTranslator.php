<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Data\Engine\SqlDatabaseEngine\Compiler;

    /**
     * Class that represents the sql database engine compiler
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
	abstract class SqlTranslator
	{
		
		/* PROPERTIES */
		
		/**
		 * Defines the open bracket symbol.
		 * 
		 * @var string
		 */
		public $openBracket = '[';
		
		/**
		 * Defines the close bracket symbol.
		 * 
		 * @var string
		 */
		public $closeBracket = ']';
		
		/**
		 * Defines the quote symbol.
		 * @var string
		 */
		public $quote = '\'';
		
		/**
		 * Defines the opening parenthesis symbol.
		 * @var string
		 */
		public $openingParenthesis = '(';
		
		/**
		 * Defines the closing parenthesis symbol.
		 * @var string
		 */
		public $closingParenthesis = ')';
		
		/**
		 * Defines the Column delimiter symbol.
		 * @var string
		 */
		public $columnDelimiter = ',';
		
		/**
		 * Defines the argument delimiter symbol.
		 * @var string
		 */
		public $argumentDelimiter = ',';
		
		/**
		 * Defines the asterisc symbol
		 * @var string
		 */
		public $asterisc = '*';
		
		/**
		 * Defines the begin batch symbol
		 * @var string
		 */
		public $batchBegin = null;
		
		/**
		 * Defines the end batch symbol
		 * @var string
		 */
		public $batchEnd = null;
		
		/**
		 * Defines the delimiter batch symbol
		 * @var string
		 */
		public $batchDelimiter = ';';
		
		
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
		 * Translates select sqlpression.
		 * 
		 * @param SqlSelect $sqlObject The sql select object.
		 * @param SelectSectionType $selection The type of sql section.
		 */
		public function TranslateSelect($sqlObject, $section)
		{
			switch ($section)
			{
				case SelectSectionType::Entry:
				{
					return $sqlObject->getDistinct() ? 'SELECT DISTINCT': 'SELECT';
				}
				case SelectSectionType::From:
				{
					return 'FROM';
				}
				case SelectSectionType::Where:
				{
					return 'WHERE';
				}
				case SelectSectionType::GroupBy:
				{
					return 'GROUP BY';
				}
				case SelectSectionType::Having:
				{
					return 'HAVING';
				}
				case SelectSectionType::OrderBy:
				{
					return 'ORDER BY';
				} 
				case SelectSectionType::Limit:
				{
					return 'LIMIT';
				}
				case SelectSectionType::Offset:
				{
					return 'OFFSET';
				}
			}
			
			return null;
		}
	
		/**
		 * Translates column expression.
		 * 
		 * @param SqlColumn $sqlObject The sql object to translate.
		 * @param ColumnSectionType $section The section type
		 */
		public function TranslateColumn($sqlObject, $section)
		{
			switch ($section)
			{
				case ColumnSectionType::Entry:
				{
					$tableAlias = $sqlObject->getSqlTable()->getAlias();
					$tableName = isset($tableAlias) ? $tableAlias : $sqlObject->getSqlTable()->getName();
					return $this->EncapsulateInBrackets($tableName).'.'.$this->EncapsulateInBrackets($sqlObject->getName());
				}
				case ColumnSectionType::AliasDeclaration:
				{
					$alias = $sqlObject->getAlias();
					return isset($alias) ? ('AS '.$this->EncapsulateInBrackets($alias)) : null;
				}
			}
		}
	
		/**
		 * Translates table object.
		 * 
		 * @param SqlTable $sqlObject The sql table object to translate.
		 * @param SqlTableSectionType $section The SqlTableSectionType to parse.
		 * 
		 * @return string|Ambigous <string, NULL>|NULL
		 */
		public function TranslateTable($sqlObject, $section)
		{
			switch ($section)
			{
				case SqlTableSectionType::Entry:
				{
					return $this->EncapsulateInBrackets($sqlObject->getName());
				}
				case SqlTableSectionType::AliasDeclaration:
				{
					$alias = $sqlObject->getAlias();
					if (isset($alias))
					{
						return ($alias != $sqlObject->getName() ? ' '.$this->EncapsulateInBrackets($alias) : null);
					}
				}
			}
			
			return null;
		}
		
		/**
		 * Translates CASE types
		 * @param SqlObject $sqlObject The case expression to translate.
		 * @param CaseSectionType $section The CASE sectin type.
		 * @return string|NULL
		 */
		public function TranslateCase($sqlObject, $section)
		{
			switch ($section)
			{
				case CaseSectionType::Entry:
				{
					return '(CASE';
				}
				case CaseSectionType::Else_:
				{
					return 'ELSE';
				}
				case CaseSectionType::Exit_:
				{
					return 'END)';
				}
				case CaseSectionType::When:
				{
					return 'WHEN';
				}
				case CaseSectionType::Then:
				{
					return 'THEN';
				}
			}
			
			return null;
		}
		
		/**
		 * Translates literal value expression.
		 * 
		 * @param SqlLiteral $sqlObject The SqlLiteral expression to translate.
		 * 
		 * @return string Translated sql literal expression value.
		 */
		public function TranslateLiteral($sqlObject)
		{
			$value = $sqlObject->getValue();
			
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
		 * Translates binary object,
		 * 
		 * @param SqlBinary $sqlObject The sql binary expression object.
		 * @param SqlObjectSectionType $section The sql object section type.
		 * @return Ambigous <NULL, string>|NULL
		 */
		public function TranslateBinary($sqlObject, $section)
		{
			switch ($section)
			{
				case SqlObjectSectionType::Entry:
				{
					return ($sqlObject->getObjectType() == SqlObjectType::RawConcat) ? null : $this->openingParenthesis;
				}
				case SqlObjectSectionType::Exit_:
				{
					return ($sqlObject->getObjectType() == SqlObjectType::RawConcat) ? null : $this->closingParenthesis;
				}
			}
			
			return null;
		}
		
		/**
		 * Transates sql object types.
		 * 
		 * @param SqlObjectType $sqlObjectType The sql object type to tranlsate.
		 * 
		 * @throws Exception Not supported type exception.
		 * @return string|NULL
		 */
		public function TranslateType($sqlObjectType)
		{
			switch ($sqlObjectType)
			{
				case SqlObjectType::All:
					return 'ALL';
				case SqlObjectType::Any:
					return 'ANY';
				case SqlObjectType::Some:
					return 'SOME';
				case SqlObjectType::Exists:
					return 'EXISTS';
				case SqlObjectType::BitAnd:
					return '&';
				case SqlObjectType::BitNot:
					return '~';
				case SqlObjectType::BitOr:
					return '|';
				case SqlObjectType::BitXor:
					return '^';
				case SqlObjectType::In:
					return 'IN';
				case SqlObjectType::Between:
					return 'BETWEEN';
				case SqlObjectType::And_:
					return 'AND';
				case SqlObjectType::Or_:
					return 'OR';
				case SqlObjectType::IsNull:
					return 'IS NULL';
				case SqlObjectType::IsNotNull:
					return 'IS NOT NULL';
				case SqlObjectType::Not:
					return 'NOT';
				case SqlObjectType::NotBetween:
					return 'NOT BETWEEN';
				case SqlObjectType::NotIn:
					return 'NOT IN';
				case SqlObjectType::GreaterThan:
					return '>';
				case SqlObjectType::GreaterThanOrEqual:
					return '>=';
				case SqlObjectType::LessThan:
					return '<';
				case SqlObjectType::LessThanOrEqual:
					return '<=';
				case SqlObjectType::Equal:
				case SqlObjectType::Assign:
					return '=';
				case SqlObjectType::NotEqual:
					return '<>';
				case SqlObjectType::Add:
					return '+';
				case SqlObjectType::Subtract:
				case SqlObjectType::Negate:
					return '-';
				case SqlObjectType::Multiply:
					return '*';
				case SqlObjectType::Mod:
					return '%';
				case SqlObjectType::Divide:
					return '/';
				case SqlObjectType::Avg:
					return 'AVG';
				case SqlObjectType::Count:
					return 'COUNT';
				case SqlObjectType::Max:
					return 'MAX';
				case SqlObjectType::Min:
					return 'MIN';
				case SqlObjectType::Sum:
					return 'SUM';
				case SqlObjectType::Concat:
					return '||';
				case SqlObjectType::Unique:
					return 'UNIQUE';
				case SqlObjectType::Union:
					return 'UNION';
				case SqlObjectType::Intersect:
					return 'INTERSECT';
				case SqlObjectType::Except:
					return 'EXCEPT';
				case SqlObjectType::Overlaps:
					return 'OVERLAPS';
				case SqlObjectType::RawConcat:
					return null;
				default:
					throw new Exception('Operation '.$sqlObjectType. ' is not supported.');
			}
		}
		
		/**
		 * Translates Between expression.
		 * 
		 * @param SqlBetween $sqlObject The sql between expression to visit.
		 * @param BetweenSectionType $section The between section type to visit.
		 *
		 * @return Ambigous <string, NULL>|string|NULL
		 */
		public function TranslateBetween($sqlObject, $section)
		{
			switch ($section)
			{
				case BetweenSectionType::Between:
				{
					return $this->TranslateType($sqlObject->getObjectType());
				}
				case BetweenSectionType::And_:
				{
					return 'AND';
				}
			}
			
			return null;
		}
		
		/**
		 * Translates OrderBy expression.
		 * 
		 * @param SqlOrder $sqlObject The sql order object.
		 * @param SqlOrderType $section. The type of sql order.
		 * 
		 * @return string
		 */
		public function TranslateOrderBy($sqlObject, $section)
		{
			switch ($section)
			{
				case SqlObjectSectionType::Exit_:
				{
					if ($sqlObject->getSqlOrderType() == SqlOrderType::Ascending)
					{
						return 'ASC';
					}
					elseif ($sqlObject->getSqlOrderType() == SqlOrderType::Descending)
					{
						return 'DESC';
					}
				}
			}
			
			return null;
		}
		
		/**
		 * Translates joined table expression.
		 *  
		 * @param SqlJoinedTable $sqlObject
		 * @param SqlJoinSectionType $section The SqlJoinSectionType section.
		 * 
		 * @return string
		 */
		public function TranslateJoinExpression($sqlObject, $section)
		{
			switch ($section)
			{
				case SqlJoinSectionType::Specification:
				{
					return $this->TranslateJoin($sqlObject->getJoin()->getJoinType()).' JOIN';
				}
				case SqlJoinSectionType::Condition:
				{
					return 'ON';
				}
			}
			
			return null;
		}
		
		/**
		 * Translates join according the its type.
		 * 
		 * @param SqlJoinType $sqlObject The type of sql join.
		 * 
		 * @return string
		 */
		public function TranslateJoin($sqlObject)
		{
			switch ($sqlObject)
			{
				case SqlJoinType::InnerJoin:
				{
					return 'INNER';
				}
				case SqlJoinType::LeftJoin:
				{
					return 'LEFT';
				}
				case SqlJoinType::LeftOuterJoin:
				{
					return 'LEFT OUTER';
				}
				case SqlJoinType::RightJoin:
				{
					return 'RIGHT';
				}
				case SqlJoinType::RightOuterJoin:
				{
					return 'RIGHT OUTER';
				}
			}
			
			return null;
		}
		
		/**
		 * Translates SqlRowNumber expression.
		 * 
		 * @param SqlRowNumber $sqlObject The SqlRowNumber expression to translate.
		 * @param SqlObjectSectionType $section The SqlObjectSectionType section.
		 */
		public function TranslateRowNumber($sqlObject, $section)
		{
			switch ($section)
			{
				case SqlObjectSectionType::Entry:
				{
					return 'ROW_NUMBER() OVER(ORDER BY';
				}
				case SqlObjectSectionType::Exit_:
				{
					return ')';
				}
			}
			
			return null;
		}
		
		/**
		 * Translates SqlSubquery expression.
		 * 
		 * @param SqlSubquery $sqlObject The SqlSubQuery expression to translate.
		 * @param SqlObjectSectionType $section The SqlObjectSectionType section.
		 */
		public function TranslateSubQuery($sqlObject, $section)
		{
			switch ($section)
			{
				case SqlObjectSectionType::Entry:
				{
					return '(';
				}
				case SqlObjectSectionType::Exit_:
				{
					return ')';
				}  
			}
			
			return null;
		}
		
		/**
		 * Translates sql function.
		 * 
		 * @param SqlFunction $sqlObject The sql function to translate.
		 * @param SqlFunctionSectionType $section The SqlFunctionSectionType enumerator.
		 * @param int $position The argument position.
		 * 
		 * @return string|Ambigous <string, NULL>|NULL
		 */
		public function TranslateFunction($sqlObject, $section, $position)
		{
			$functionType = $sqlObject->getFunctionType();
			switch ($section)
			{
				case SqlFunctionSectionType::Entry:
				{
					switch ($functionType)
					{
						case SqlFunctionType::CurrentUser:
						case SqlFunctionType::SessionUser:
						case SqlFunctionType::SystemUser:
						case SqlFunctionType::User:
						{
							return $this->TranslateFunctionType($functionType);
						}
					}
					if ($functionType == SqlFunctionType::Position)
					{
						return '('.$this->TranslateFunctionType($functionType).'(';
					}
					return count($sqlObject->getArguments()) == 0 ? $this->TranslateFunctionType($functionType).'()' : $this->TranslateFunctionType($functionType).'(';
				}
				case SqlFunctionSectionType::ArgumentEntry:
				{
					switch ($functionType)
					{
						case SqlFunctionType::Position:
						{
							return $position == 1 ? 'IN' : null;	
						}
						case SqlFunctionType::Substring:
						{
							switch ($position)
							{
								case 1:
								{
									return 'FROM';
								}
								case 2:
								{
									return 'FOR';	
								}
								default:
								{
									return null;
								}
							}	
						}
						default:
						{
							return null;	
						}
					}	
				}
				case SqlFunctionSectionType::ArgumentExit:
				{
					return null;
				}
				case SqlFunctionSectionType::ArgumentDelimiter:
				{
					switch ($functionType)
					{
						case SqlFunctionType::Position:
						case SqlFunctionType::Substring:
						{
							return null;	
						}
						default:
						{
							return $this->argumentDelimiter;	
						}
					}			
				}
				case SqlFunctionSectionType::Exit_:
				{
					return count($sqlObject->getArguments()) != 0 ? ')' : null;
				}
			}
			
			return null;
		}
		
		/**
		 * Translates function type.
		 * 
		 * @param SqlFunctionType $functionType The type of sql function.
		 * 
		 * @return string
		 */
		public function TranslateFunctionType($functionType)
		{
			switch ($functionType)
			{
				case SqlFunctionType::CharLength:
				case SqlFunctionType::BinaryLength:
				{
					return 'LENGTH';
				}
				case SqlFunctionType::Concat:
				{
					return 'CONCAT';
				}
				case SqlFunctionType::CurrentDate:
				{
					return 'CURRENT_DATE';
				}
				case SqlFunctionType::CurrentTime:
				{
					return 'CURRENT_TIME';
				}
				case SqlFunctionType::CurrentTimeStamp:
				{
					return 'CURRENT_TIMESTAMP';
				}
				case SqlFunctionType::Lower:
				{
					return 'LOWER';
				}
				case SqlFunctionType::Position:
				{
					return 'POSITION';
				}
				case SqlFunctionType::Substring:
				{
                   	return 'SUBSTRING';
				}
                case SqlFunctionType::Upper:
               	{
                   	return 'UPPER';
               	}
                case SqlFunctionType::Abs:
               	{
                   	return 'ABS';
               	}
                case SqlFunctionType::Acos:
               	{
                   	return 'ACOS';
                }
                case SqlFunctionType::Asin:
                {
                   	return 'ASIN';
                }
                case SqlFunctionType::Atan:
                {
                   	return 'ATAN';
                }
                case SqlFunctionType::Atan2:
                {
                   	return 'ATAN2';
                }
                case SqlFunctionType::Ceiling:
                {
                   	return 'CEILING';
                }
                case SqlFunctionType::Coalesce:
                {
                   	return 'COALESCE';
                }
                case SqlFunctionType::Cos:
                {
                   	return 'COS';
                }
                case SqlFunctionType::Cot:
                {
                   	return 'COT';
                }
                case SqlFunctionType::CurrentUser:
                {
                   	return 'CURRENT_USER';
                }
                case SqlFunctionType::Degrees:
                {
                  	return 'DEGREES';
                }
                case SqlFunctionType::Exp:
                {
                   	return 'EXP';
                }
                case SqlFunctionType::Floor:
                {
                   	return 'FLOOR';
                }
                case SqlFunctionType::Log:
                {
                   	return 'LOG';
                }
                case SqlFunctionType::Log10:
                {
                   	return 'LOG10';
                }
                case SqlFunctionType::NullIf:
                {
                   	return 'NULLIF';
                }
                case SqlFunctionType::Pi:
                {
                   	return 'PI';
                }
                case SqlFunctionType::Power:
                {
                   	return 'POWER';
                }
                case SqlFunctionType::Radians:
                {
                   	return 'RADIANS';
                }
                case SqlFunctionType::Rand:
                {
                   	return 'RAND';
                }
                case SqlFunctionType::Replace:
                {
                   	return 'REPLACE';
                }
                case SqlFunctionType::Round:
                {
                   	return 'ROUND';
                }
                case SqlFunctionType::Truncate:
                {
                   	return 'TRUNCATE';
                }
                case SqlFunctionType::SessionUser:
                {
                   	return 'SESSION_USER';
                }
                case SqlFunctionType::Sign:
                {
                   	return 'SIGN';
                }
                case SqlFunctionType::Sin:
                {
                   	return 'SIN';
                }
                case SqlFunctionType::Sqrt:
                {
                   	return 'SQRT';
                }
                case SqlFunctionType::Square:
                {
                   	return 'SQUARE';
                }
                case SqlFunctionType::SystemUser:
                {
                   	return 'SYSTEM_USER';
                }
                case SqlFunctionType::Tan:
                {
                   	return 'TAN';
                }
			}
		}
		
		/**
		 * Translates Update function.
		 * 
		 * @param SqlUpdate $sqlObject The sql update object to translate.
		 * @param UpdateSectionType $section The update section type.
		 * @return string
		 */
		public function TranslateUpdate($sqlObject, $section)
		{
			switch ($section)
			{
				case UpdateSectionType::Entry:
				{
					return 'UPDATE';
				}
				case UpdateSectionType::Set:
				{
					return 'SET';
				}
				case UpdateSectionType::From:
				{
					return 'FROM';
				}
				case UpdateSectionType::Where:
				{
					return 'WHERE';
				}
			}
		}

		/**
		 * Translates assignment statement.
		 * 
		 * @param SqlAssign $sqlObject The sql assignment object to translate.
		 * @param SqlObjectSectionType $section The SqlObjectSectionType type.
		 * 
		 * @return string|NULL
		 */
		public function TranslateAssign($sqlObject, $section)
		{
			switch ($section)
			{
				case SqlObjectSectionType::Entry:
				{
					return 'SET';
				}
			}
			
			return null;
		}
		
		/**
		 * Translates insert statement.
		 * 
		 * @param SqlInsert $sqlObject The sql insert object to translate.
		 * @param InsertSectionType $section The InsertSectionType.
		 * 
		 * @return string|Ambigous <string, NULL>|NULL
		 */
		public function TranslateInsert($sqlObject, $section)
		{
			switch ($section)
			{
				case InsertSectionType::Entry:
				{
					return 'INSERT INTO';
				}
				case InsertSectionType::ColumnsEntry:
				{
					return count($sqlObject->getValues()) > 0 ? '(' : null;
				}
				case InsertSectionType::ColumnsExit:
				{
					return (count($sqlObject->getValues()) > 0) ? ')' : null;
				}
				case InsertSectionType::ValuesEntry:
				{
					return 'VALUES(';
				}
				case InsertSectionType::ValuesExit:
				{
					return ')';
				}
				case InsertSectionType::DefaultValues:
				{
					return 'DEFAULT VALUES';
				}
			}
			
			return null;
		}
		
		/**
		 * Translates delete sql object.
		 * 
		 * @param SqlDelete $sqlObject The sql delete object to translate.
		 * @param DeleteSectionType $section The DeleteSectionType section.
		 * 
		 * @return string|NULL
		 */
		public function TranslateDelete($sqlObject, $section)
		{
			switch ($section)
			{
				case DeleteSectionType::Entry:
				{
					return 'DELETE FROM';
				}
				case DeleteSectionType::Where:
				{
					return 'WHERE';
				}
			}
			
			return null;
		}
	
		/**
		 * Translates IF sql object.
		 * 
		 * @param SqlIf $sqlObject The SqlIf object to translate.
		 * @param IfSectionType $section The IfSectionType.
		 * 
		 * @return string|NULL
		 */
		public function TranslateIf($sqlObject, $section)
		{
			switch ($section)
			{
				case IfSectionType::Entry:
				{
					return 'IF';
				}
				case IfSectionType::True_:
				{
					return 'BEGIN';
				}
				case IfSectionType::False_:
				{
					return 'END BEGIN';
				}
				case IfSectionType::Exit_:
				{
					return 'EXIT';
				}
			}
			
			return null;
		}
	
		/**
		 * Translates unary expression.
		 * 
		 * @param SqlUnary $sqlObject The sql unary expressin to translate.
		 * @param SqlObjectSectionType $section The SqlObjectSectionType.
		 * 
		 * @return Ambigous <NULL, string>
		 */
		public function TranslateUnary($sqlObject, $section)
		{
			$objectType = $sqlObject->getObjectType();
			$result = null;
			
			switch ($section)
			{
				case SqlObjectSectionType::Entry:
				{
					if (!(
						$objectType == SqlObjectType::Exists || $objectType == SqlObjectType::All ||
						$objectType == SqlObjectType::Some || $objectType == SqlObjectType::Any
					))	
					{
						$result .= '(';
					}
					if ($objectType != SqlObjectType::IsNull || $objectType != SqlObjectType::IsNotNull)
					{
						$result .= $this->TranslateType($objectType);
					}
					break;
				}
				case SqlObjectSectionType::Exit_:
				{
					if ($objectType == SqlObjectType::IsNull || $objectType == SqlObjectType::IsNotNull)
					{
						$result .= $this->TranslateType($objectType);
					}
					if (!(
						$objectType == SqlObjectType::Exists || $objectType == SqlObjectType::All ||
						$objectType == SqlObjectType::Some || $objectType == SqlObjectType::Any
					))	
					{
						$result .= ')';
					}
					break;
				}
			}
			
			return $result;
		}
		
	}

?>