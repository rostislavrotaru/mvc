<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlModel;
																																																																																																				    
	
	use Spherus\Components\ORM\Component\SqlModel\Enums\EntityType;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlBinary;
	use Spherus\Components\ORM\Component\SqlModel\Enums\OrderType;
use Spherus\Components\ORM\Component\SqlModel\Expressions\ORMOrder;
																					
	/**
     * Class that represents the ORM factory
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class ORMFactory
    {		
		
    	/* STATEMENTS */
    	 
    	/**
	     * Creates And expression
	     * @param ORMExpression $leftExpression The left expression.
	     * @param ORMExpression $rightExpression The right expression.
	     *
	     * @return ORMBinary
	     */
	    public static function And_($leftExpression, $rightExpression)
	    {
	        return self::Binary(EntityType::And_, $leftExpression, $rightExpression);
	    }
	    
	    /**
	     * Creates Or expression
	     * @param ORMExpression $leftExpression The left expression.
	     * @param ORMExpression $rightExpression The right expression.
	     *
	     * @return ORMBinary
	     */
	    public static function Or_($leftExpression, $rightExpression)
	    {
	    	return self::Binary(EntityType::Or_, $leftExpression, $rightExpression);
	    }
	     
	    /**
	     * Creates in query.
	     *
	     * @param ORMExpression $leftExpression The left ORM expression.
	     * @param array $rightExpression The right expresssion.
	     * @return ORMBinary
	     */
	    public static function In($leftExpression, $rightExpression)
	    {
	    	return self::Binary(EntityType::In, $leftExpression, $rightExpression);
	    }
	     
	    /**
	     * Creates not in query.
	     *
	     * @param ORMExpression $leftExpression The left ORM expression.
	     * @param array $rightExpression The right expresssion.
	     * @return ORMBinary
	     */
	    public static function NotIn($leftExpression, $rightExpression)
	    {
	    	return self::Binary(EntityType::NotIn, $leftExpression, $rightExpression);
	    }
	    
	    /* COMPARISON */
	     
	    /**
	     * Creates a Equal expression.
	     *
	     * @param ORMExpression $leftExpression The left expression.
	     * @param ORMExpression $rightExpression The right expression.
	     *
	     * @return ORMBinary
	     */
	    public static function Equal($leftExpression, $rightExpression)
	    {
	    	return self::Binary(EntityType::Equal, $leftExpression, $rightExpression);
	    }
	     
	    /**
	     * Creates a NotEqual expression.
	     *
	     * @param ORMExpression $leftExpression The left expression.
	     * @param ORMExpression $rightExpression The right expression.
	     *
	     * @return ORMBinary
	     */
	    public static function NotEqual($leftExpression, $rightExpression)
	    {
	    	return self::Binary(EntityType::NotEqual, $leftExpression, $rightExpression);
	    }
	     
	    /**
	     * Creates a GreatherThan expression.
	     *
	     * @param ORMExpression $leftExpression The left expression.
	     * @param ORMExpression $rightExpression The right expression.
	     *
	     * @return ORMBinary
	     */
	    public static function GreatherThan($leftExpression, $rightExpression)
	    {
	    	return self::Binary(EntityType::GreaterThan, $leftExpression, $rightExpression);
	    }
	     
	    /**
	     * Creates a LessThan expression.
	     *
	     * @param ORMExpression $leftExpression The left expression.
	     * @param ORMExpression $rightExpression The right expression.
	     *
	     * @return ORMBinary
	     */
	    public static function LessThan($leftExpression, $rightExpression)
	    {
	    	return self::Binary(EntityType::LessThan, $leftExpression, $rightExpression);
	    }
	     
	    /**
	     * Creates a GreatherThan or equal expression.
	     *
	     * @param ORMExpression $leftExpression The left expression.
	     * @param ORMExpression $rightExpression The right expression.
	     *
	     * @return ORMBinary
	     */
	    public static function GreatherThanOrEqual($leftExpression, $rightExpression)
	    {
	    	return self::Binary(EntityType::GreaterThanOrEqual, $leftExpression, $rightExpression);
	    }
	     
	    /**
	     * Creates a LessThan or equal expression.
	     *
	     * @param ORMExpression $leftExpression The left expression.
	     * @param ORMExpression $rightExpression The right expression.
	     *
	     * @return ORMBinary
	     */
	    public static function LessThanOrEqual($leftExpression, $rightExpression)
	    {
	    	return self::Binary(EntityType::LessThanOrEqual, $leftExpression, $rightExpression);
	    }
	    
	    
	    /* ORDER */
	     
	    /**
	     * Creates an ordered expression.
	     *
	     * @param ORMExpression $expression The expression partipating in order.
	     * @param OrderType $orderType The ORM order type. Optional. Default is ascending.
	     *
	     * @return ORMOrder
	     */
	    public static function Order($expression, $orderType = OrderType::Ascending)
	    {
	    	return new ORMOrder($expression, $orderType);
	    }
	    
	    
	    /* PROVATE METHODS */
	    
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
    
    }