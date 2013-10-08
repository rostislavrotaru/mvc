<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery;
					
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlColumn;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlTable;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlJoin;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlSelect;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlBinary;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlExpression;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlOrder;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlOrderType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlUnary;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlBetween;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlAggregate;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlJoinedTable;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlSubQuery;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlStatement;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlCase;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlEntity;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlFunctionType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlLiteral;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlFunction;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlRowNumber;
																				
	/**
     * Class that represents the sql database factory
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlFactory
	{
	    
	    /* STRUCTURE */
	    
	    /**
	     * Creates a sql table column.
	     *
	     * @param string $name The sql table column name.
	     * @param SqlTable $sqlTable The parent SqlTable.
	     * @param string $alias Column alias.
	     *
	     * @return SqlColumn Instantiated SqlColumn object
	     */
	    public static function Column($name, $sqlTable = null, $alias = null)
	    {
	        return new SqlColumn($name, $sqlTable, $alias);
	    }
	
	    /**
	     * Creates a SqlTable.
	     *
	     * @param string $name The table name.
	     * @param string $alias The table alias.
	     * @param array $columns Array of table column objects.
	     * @return SqlTable
	     */
	    public static function Table($name, $alias = null, array $columns = null)
	    {
	        return new SqlTable($name, $alias, $columns);
	    }
	    
	    /**
	     * Creates a case expression.
	     *
	     * @param SqlEntity $input The input Sql expression.
	     *
	     * @return SqlCase
	     */
	    public static function Case_(SqlEntity $input = null)
	    {
	        return new SqlCase($input);
	    }
	    
	    /* JOIN */
	    
	    /**
	     * Creates a join between two tables.
	     *
	     * @param SqlTable $table The join table.
	     * @param SqlTable $foreignTable The foreign join table.
	     * @param SqlColumn $column The join column.
	     * @param SqlColumn $foreignColumn The join foreign column.
	     * @param SqlJoinType $joinType The type of sql join.
	     *
	     * @return SqlJoinedTable
	     */
	    public static function Join(SqlTable $table, SqlTable $foreignTable, SqlColumn $column, SqlColumn $foreignColumn, $joinType)
	    {
	        return new SqlJoinedTable(new SqlJoin($table, $foreignTable, $column, $foreignColumn, $joinType));
	    }
	
	    
	    /* STATEMENTS */
	    
	    /**
	     * Creates Select statement.
	     *
	     * @param array of $table The from table.
	     * @param mixed SqlColumn|Array A single or an array of SqlColumn objects.
	     *
	     * @return SqlSelect
	     */
	    public static function Select($table = null, $columns = null)
	    {
	        $sqlSelect = new SqlSelect($table);
	        
	        if(!isset($columns))
	        {
	        	return $sqlSelect;
	        }
	       
	        if (is_array($columns))
	        {
	            foreach ($columns as $column)
	            {
	                $sqlSelect->AddColumn($column);
	            }
	        }
	        else
	        {
	            $sqlSelect->AddColumn($columns);
	        }
	        
	        return $sqlSelect;
	    }
	    
	    
	    /* AGGREGATES */
	    
	    /**
	     * Creates a Count Expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     *
	     * @return SqlAggregate
	     */
	    public static function Count($expression)
	    {
	        return self::CountDistinct($expression, false);
	    }
	    
	    /**
	     * Creates a distinct Count expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     * @param boolean $distinct Determine if expression is dictinct or not.
	     *
	     * @return SqlAggregate
	     */
	    public static function CountDistinct($expression, $distinct)
	    {
	        return self::Aggregate(SqlEntityType::Count, $expression, $distinct);
	    }
	    
	    /**
	     * Creates a Avg Expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     *
	     * @return SqlAggregate
	     */
	    public static function Avg($expression)
	    {
	        return self::AvgDistinct($expression, false);
	    }
	    
	    /**
	     * Creates a distinct Avg expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     * @param boolean $distinct Determine if expression is dictinct or not.
	     *
	     * @return SqlAggregate
	     */
	    public static function AvgDistinct($expression, $distinct)
	    {
	        return self::Aggregate(SqlEntityType::Avg, $expression, $distinct);
	    }
	    
	    /**
	     * Creates a Sum Expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     *
	     * @return SqlAggregate
	     */
	    public static function Sum($expression)
	    {
	        return self::SumDistinct($expression, false);
	    }
	    
	    /**
	     * Creates a distinct Sum expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     * @param boolean $distinct Determine if expression is dictinct or not.
	     *
	     * @return SqlAggregate
	     */
	    public static function SumDistinct($expression, $distinct)
	    {
	        return self::Aggregate(SqlEntityType::Sum, $expression, $distinct);
	    }
	    
	    /**
	     * Creates a Min Expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     *
	     * @return SqlAggregate
	     */
	    public static function Min($expression)
	    {
	        return self::MinDistinct($expression, false);
	    }
	    
	    /**
	     * Creates a distinct Min expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     * @param boolean $distinct Determine if expression is dictinct or not.
	     *
	     * @return SqlAggregate
	     */
	    public static function MinDistinct($expression, $distinct)
	    {
	        return self::Aggregate(SqlEntityType::Min, $expression, $distinct);
	    }
	    
	    /**
	     * Creates a Max Expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     *
	     * @return SqlAggregate
	     */
	    public static function Max($expression)
	    {
	        return self::MaxDistinct($expression, false);
	    }
	    
	    /**
	     * Creates a distinct Max expression.
	     *
	     * @param SqlExpression $expression The aggregate expression.
	     * @param boolean $distinct Determine if expression is dictinct or not.
	     *
	     * @return SqlAggregate
	     */
	    public static function MaxDistinct($expression, $distinct)
	    {
	        return self::Aggregate(SqlEntityType::Max, $expression, $distinct);
	    }
	    
	    
	    /* BINARY */
	    
	    /**
	     * Creates And expression
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function And_($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::And_, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates Or expression
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function Or_($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::Or_, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates in query.
	     *
	     * @param SqlExpression $leftExpression The left sql expression.
	     * @param array $rightExpression The right expresssion.
	     * @return SqlBinary
	     */
	    public static function In($leftExpression, $rightExpression)
	    {
	        if ($rightExpression instanceof SqlStatement)
	        {
	            return self::Binary(SqlEntityType::In, $leftExpression, self::SubQuery($rightExpression));
	        }
	        
	        return self::Binary(SqlEntityType::In, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates not in query.
	     *
	     * @param SqlExpression $leftExpression The left sql expression.
	     * @param array $rightExpression The right expresssion.
	     * @return SqlBinary
	     */
	    public static function NotIn($leftExpression, $rightExpression)
	    {
	        if ($rightExpression instanceof SqlStatement)
	        {
	            return self::Binary(SqlEntityType::NotIn, $leftExpression, self::SubQuery($rightExpression));
	        }
	        
	        return self::Binary(SqlEntityType::NotIn, $leftExpression, $rightExpression);
	    }
	
	    
	    /* ARITHMETIC */
	    
	    /**
	     * Creates Add expression
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function Add($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::Add, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates Substract expression
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function Substract($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::Subtract, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates Multiply expression
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function Multiply($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::Multiply, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates Divide expression
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function Divide($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::Divide, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates Mod expression
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function Mod($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::Mod, $leftExpression, $rightExpression);
	    }
	    
	    /* COMPARISON */
	    
	    /**
	     * Creates a Equal expression.
	     *
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function Equal($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::Equal, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates a NotEqual expression.
	     *
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function NotEqual($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::NotEqual, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates a GreatherThan expression.
	     *
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function GreatherThan($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::GreaterThan, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates a LessThan expression.
	     *
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function LessThan($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::LessThan, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates a GreatherThan or equal expression.
	     *
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function GreatherThanOrEqual($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::GreaterThanOrEqual, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates a LessThan or equal expression.
	     *
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function LessThanOrEqual($leftExpression, $rightExpression)
	    {
	        return self::Binary(SqlEntityType::LessThanOrEqual, $leftExpression, $rightExpression);
	    }
	    
	    
	    /* SQL ORDER */
	    
	    /**
	     * Creates an ordered expression.
	     *
	     * @param SqlExpression $expression The expression partipating in order.
	     * @param SqlOrderType $sqlOrderType The sql order type. Optional. Default is ascending.
	     *
	     * @return SqlOrder
	     */
	    public static function Order($expression, $sqlOrderType = SqlOrderType::Ascending)
	    {
	        return new SqlOrder($expression, $sqlOrderType);
	    }
	
	    
	    /* DATETIME FUNCTIONS */
	    
	    /**
	     * Creates a current date function.
	     *
	     * @return SqlFunction
	     */
	    public static function CurrentDate()
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::CurrentDate);
	    }
	    
	    /**
	     * Creates a current timestamp function.
	     *
	     * @return SqlFunction
	     */
	    public static function CurrentTimeStamp()
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::CurrentTimeStamp);
	    }
	    
	    
	    /* MISC FUNCTIONS */
	    
	    /**
	     * Creates a session user function.
	     *
	     * @return SqlFunction
	     */
	    public static function SessionUser()
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::SessionUser);
	    }
	    
	    /**
	     * Creates a current user function.
	     *
	     * @return SqlFunction
	     */
	    public static function CurrentUser()
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::CurrentUser);
	    }
	    
	    /**
	     * Creates a system user function.
	     *
	     * @return SqlFunction
	     */
	    public static function SystemUser()
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::SystemUser);
	    }
	    
	    /**
	     * Creates a user function.
	     *
	     * @return SqlFunction
	     */
	    public static function User()
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::User);
	    }
	    
	    /**
	     * Creates a row number expression.
	     *
	     * @param mixed $orderBy Array or a single SqlOrder object expression(s)
	     */
	    public static function RowNumber($orderBy = null)
	    {
	        return new SqlRowNumber($orderBy);
	    }
	    
	    /* STRING FUNCTIONS */
	    
	    /**
	     * Creates a substring function.
	     *
	     * @param SqlExpression $operand The operand sql expression.
	     * @param mixed $start The start argument, Sqlexpression or literal
	     * @param mixed $length The length argument, SqlExpression or literal, optional.
	     *
	     * @return SqlFunction
	     */
	    public static function Substring($operand, $start, $length = null)
	    {
	        $arguments = array();
	        $arguments[] = $operand;
	        	
	        if (!$start instanceof SqlExpression)
	        {
	            require_once(SPHQUERY_EXPRESSIONS.'sqlliteral.php');
	            $arguments[] = new SqlLiteral($start);
	            if (isset($length))
	            {
	                $arguments[] = new SqlLiteral($length);
	            }
	        }
	        else
	        {
	            $arguments[] = $start;
	            if (isset($length))
	            {
	                $arguments[] = $length;
	            }
	        }
	        	
	        return self::SqlFunctionInternal(SqlFunctionType::Substring, $arguments);
	        	
	    }
	    
	    /**
	     * Creates replace function.
	     *
	     * @param SqlExpression $text The text sql expression.
	     * @param SqlExpression $from The from sql expression.
	     * @param SqlExpressin $to The to sql expression.
	     *
	     * @return SqlFunction
	     */
	    public static function Replace($text, $from, $to)
	    {
	        $arguments = array();
	        	
	        $arguments[] = $text;
	        $arguments[] = $from;
	        $arguments[] = $to;
	        	
	        return self::SqlFunctionInternal(SqlFunctionType::Replace, $arguments);
	    }
	    
	    
	    /* MATH FUNCTIONS */
	    
	    /**
	     * Creates ABS function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Abs($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Abs, $argument);
	    }
	    
	    /**
	     * Creates ACOS function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function ACos($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Acos, $argument);
	    }
	    
	    /**
	     * Creates ASIN function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function ASin($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::ASin, $argument);
	    }
	    
	    /**
	     * Creates ATAN function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function ATan($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::ATan, $argument);
	    }
	    
	    /**
	     * Creates ATAN2 function
	     * @param SqlExpression $argument1 The argument1 sql expression.
	     * @param SqlExpression $argument2 The argument2 sql expression.
	     */
	    public static function ATan2($argument1, $argument2)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::ATan2, array($argument1, $argument2));
	    }
	    
	    /**
	     * Creates CEILING function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Ceiling($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Ceiling, $argument);
	    }
	    
	    /**
	     * Creates COS function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Cos($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Cos, $argument);
	    }
	    
	    /**
	     * Creates COT function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Cot($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Cot, $argument);
	    }
	    
	    /**
	     * Creates DEGREES function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Degrees($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Degrees, $argument);
	    }
	    
	    /**
	     * Creates EXP function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Exp($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Exp, $argument);
	    }
	    
	    /**
	     * Creates Floor function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Floor($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Floor, $argument);
	    }
	    
	    /**
	     * Creates LOG function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Log($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Log, $argument);
	    }
	    
	    /**
	     * Creates LOG10 function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Log10($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Log10, $argument);
	    }
	    
	    /**
	     * Creates PI function
	     */
	    public static function Pi()
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Pi);
	    }
	    
	    /**
	     * Creates POWER function
	     * @param SqlExpression $argument The argument sql expression.
	     * @param SqlExpressioin $power The power sql expression
	     */
	    public static function Power($argument, $power)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Power, array($argument, $power));
	    }
	    
	    /**
	     * Creates RADIANS function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Radians($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Radians, $argument);
	    }
	    
	    /**
	     * Creates RAND function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Rand($argument = null)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Rand, $argument);
	    }
	    
	    /**
	     * Creates ROUND function
	     * @param SqlExpression $argument The argument sql expression.
	     * @param SqlExpression $length The length sql expression
	     */
	    public static function Round($argument, $length)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Ceiling, array($argument, $length));
	    }
	    
	    /**
	     * Creates TRUNCATE function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Truncate($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Truncate, $argument);
	    }
	    
	    /**
	     * Creates SIGN function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Sign($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Sign, $argument);
	    }
	    
	    /**
	     * Creates SIN function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Sin($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Sin, $argument);
	    }
	    
	    /**
	     * Creates SQRT function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Sqrt($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Sqrt, $argument);
	    }
	    
	    /**
	     * Creates SQUARE function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Square($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Square, $argument);
	    }
	    
	    /**
	     * Creates TAN function
	     * @param SqlExpression $argument The argument sql expression.
	     */
	    public static function Tan($argument)
	    {
	        return self::SqlFunctionInternal(SqlFunctionType::Tan, $argument);
	    }
	    
	    
	    /* PRIVATE METHODS */
	    
	    /**
	     * Creates a sql function.
	     *
	     * @param SqlFunctionType $functionType The type of sql function.
	     * @param mixed $arguments a single object or array of function arguments.
	     * @return SqlFunction
	     */
	    private static function SqlFunctionInternal($functionType, $arguments = null)
	    {
	        return new SqlFunction($functionType, $arguments);
	        	
	    }
	
	    /* PRIVATE METHODS */
	    
	    /**
		 * Creates a aggregate query expression.
		 * 
		 * @param SqlEntityType $entityType The aggregate sql object type
		 * @param SqlExpression $expression The aggregate sql expression.
		 * @param boolean $distinct Determine wheter aggregate is distinct or not.
		 * 
		 * @return SqlAggregate Created aggregate expression.
		 */
		private static function Aggregate($entityType, $expression, $distinct)
		{
			return new SqlAggregate($entityType, $expression, $distinct);
		}
	    
	    /**
	     * Creates a between expression.
	     *
	     * @param SqlEntityType $objectType The sql object type.
	     * @param SqlExpression $sqlExpression The between sql expression.
	     * @param SqlExpression $leftBoundary The left sql expression.
	     * @param SqlExpression $rightBoundary The right sql expression.
	     *
	     * @return SqlBetween Created SqlBetween expression.
	     */
	    private static function BetweenInternal($entityType, $sqlExpression, $leftBoundary, $rightBoundary)
	    {
	        return new SqlBetween($entityType, $sqlExpression, $leftBoundary, $rightBoundary);
	    }
	    
	    /**
	     * Creates a unary sql expression.
	     *
	     * @param SqlEntityType $entityType The sql object type.
	     * @param SqlExpression $operand The sql expression operand.
	     *
	     * @return SqlUnary
	     */
	    private static function UnaryInternal($entityType, $operand)
	    {
	        return new SqlUnary($entityType, $operand);
	    }
	
	    /**
	     * Creates a sql binary expression.
	     *
	     * @param string $entityType The type of sql object.
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    private static function Binary($entityType, $leftExpression, $rightExpression)
	    {
	        return new SqlBinary($entityType, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates a new subquery object.
	     *
	     * @param SqlStatement $sqlStatement The containing sql expression.
	     * @return SqlSubQuery
	     */
	    public static function SubQuery(SqlStatement $sqlExpression)
	    {
	        return new SqlSubQuery($sqlExpression);
	    }
	    
	}