<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlModel\Interfaces;
														
	/**
     * Interface that represents an ORM select
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
	interface IORMSelect
	{
	
	    /**
	     * Add a group by expression(s).
	     *
	     * @param mixed $groupBy The group by expression(s).
	     *
	     * @return IORMSelect
	     */
	    function GroupBy($groupBy);
	
	    /**
	     * Adds having expression.
	     *
	     * @param SqlExpression $having The having sql expression.
	     *
	     * @return IORMSelect
	     */
	    function Having($having);
	
	    /**
	     * Adds where sql expression.
	     *
	     * @param SqlExpression $where The where sql expression.
	     *
	     * @return IORMSelect
	     */
	    function Where($where);
	
	    /**
	     * Adds order by sql orders.
	     *
	     * @param mixed $order Array or single object of sql orders.
	     *
	     * @return IORMSelect
	     */
	    function OrderBy($order);
	
	    /**
	     * Adds skip sql expression.
	     *
	     * @param SqlExpression $skip The skip elements.
	     *
	     * @return IORMSelect
	     */
	    function Skip($skip);
	
	    /**
	     * Adds take sql expression.
	     *
	     * @param SqlExpression $take The take limit sql expression.
	     *
	     * @return IORMSelect
	     */
	    function Take($take);
	
	    /**
	     * Determine if current select is distinct or not.
	     *
	     * @return IORMSelect
	     */
	    function Distinct();
	    
	    /**
	     * Includes an ORM expression
	     * @param ORMExpression $expression The ORM expression to include
	     * 
	     * @return IORMSelect
	     */
	    public function Include_($expression);
	    
	    /**
	     * Gets first element or null if not found
	     */
	    function First();
	    
	    /**
	     * Gets a list of elements
	     */
	    function ToList();
	
	}