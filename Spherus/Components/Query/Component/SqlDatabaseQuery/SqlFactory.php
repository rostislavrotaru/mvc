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

?>