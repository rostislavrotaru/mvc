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
     * Class that represents a column expression
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlColumnExpression extends SqlExpression
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of SqlColumnExpression class.
	     *
	     * @param SqlExpression $expression The sql expression.
	     * @param string $alias The column sql expression alias.
	     */
	    public function __construct($expression, $alias = null)
	    {
	        parent::__construct(SqlEntityType::Column);
	        	
	        $this->expression = $this->CheckIsLiteral($expression);
	        $this->alias = $alias;
	    }
	
	
	    /* FIELDS */
	
	    /**
	     * Constains column expression.
	     * @var SqlExpression
	     */
	    private $expression = null;
	
	    /**
	     * The expression alias.
	     * @var string
	     */
	    private $alias = null;
	
	
	    /* PROPERTIES */
	
	    /**
	     * @return the $expression
	     */
	    public function getExpression()
	    {
	        return $this->expression;
	    }
	
	    /**
	     * @return The expression alias.
	     */
	    public function getAlias()
	    {
	        return $this->alias;
	    }
	
	
	}

?>