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
	     * @return SqlTable
	     */
	    public static function Join($table, $foreignTable, $column, $foreignColumn, $joinType)
	    {
	        $table->setJoin(new SqlJoin($table, $foreignTable, $column, $foreignColumn, $joinType));
	        return $table;
	    }
	
	    
	    /* STATEMENTS */
	    
	    /**
	     * Creates Select statement.
	     *
	     * @param SqlTable $table The from table.
	     *
	     * @return SqlSelect
	     */
	    public static function Select($table = null)
	    {
	        return new SqlSelect($table);
	    }
	    
	    
	    /* BINARY */
	    
	    /**
	     * Creates a sql binary expression.
	     *
	     * @param string $objectType The type of sql object.
	     * @param SqlExpression $leftExpression The left expression.
	     * @param SqlExpression $rightExpression The right expression.
	     *
	     * @return SqlBinary
	     */
	    public static function Binary($entityType, $leftExpression, $rightExpression)
	    {
	        return new SqlBinary($entityType, $leftExpression, $rightExpression);
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
	}

?>