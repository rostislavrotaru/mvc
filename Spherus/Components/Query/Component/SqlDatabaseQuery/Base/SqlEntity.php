<?php

/**
* Redistributions of files must retain the above copyright notice.
*
* @copyright SPHERUS (http://spherus.net)
* @license http://license.spherus.net
* @link http://spherus.net
* @since 3.0
*/
    namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Base;

    use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlLiteral;
    use Spherus\Core\SpherusException;

/**
* Represents any object in Sql expression tree.
* 
* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
* @package spherus.components.query
*/
class SqlEntity
{
    
    /* CONSTRUCTORS */
    
    /**
    * Initializes a new instance of SqlObject class.
    * 
    * @param string $sqlEntityType The sql type of entity
    */
    public function __construct($sqlEntityType)
    {
        $this->sqlEntityType = $sqlEntityType;
    }
    
    /* FIELDS */
    
    /**
    * Defines the sql entity type.
    * @var SqlEntityType
    */
    private $sqlEntityType = null;
    
    /* PROPERTIES */
    
    /**
    * @return the type of object.
    * 
    * @var SqlEntityType
    */
    public function getSqlEntityType()
    {
        return $this->sqlEntityType;
    }
    
    
    /* PUBLIC FUNCTIONS */
    
    /**
    * Checks if given expression is SqlEntity or should encapsulate in literal expression.
    * 
    * @param mixed $expression The expression to check.
    * @return Ambigous <SqlExpression, SqlLiteral>
    */
    public function CheckIsLiteral($expression)
    {
        if(is_array($expression))
        {
        	throw new SpherusException(EXCEPTION_INVALID_ARGUMENT);
        }
        
        if(!is_a($expression, 'Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlEntity'))
        {
            return new SqlLiteral($expression);
        }
        else
        {
            return $expression;
        }
    }
}