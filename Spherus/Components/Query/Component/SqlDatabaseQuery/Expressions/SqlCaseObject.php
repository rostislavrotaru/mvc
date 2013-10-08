<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions;
					
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlExpression;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
			
	/**
     * Class that represents a sql case object
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlCaseObject extends SqlExpression
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initialize a new instance of SqlCaseObject.
	     *
	     * @param SqlExpression $when
	     * @param SqlExpression $then
	     */
	    public function __construct($when, $then)
	    {
	        parent::__construct(SqlEntityType::Case_);
	        	
	        $this->when = $this->CheckIsLiteral($when);
	        $this->then = $this->CheckIsLiteral($then);
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * Contains the WHEN expression
	     * @var SqlExpression
	     */
	    private $when = null;
	
	    /**
	     * Contains the THEN expression
	     * @var SqlExpression
	     */
	    private $then = null;
	
	
	    /* PROPERTIES */
	
	    /**
	     * @return the $when expression.
	     */
	    public function getWhen()
	    {
	        return $this->when;
	    }
	
	    /**
	     * @return the $then expression.
	     */
	    public function getThen()
	    {
	        return $this->then;
	    }
	
	}