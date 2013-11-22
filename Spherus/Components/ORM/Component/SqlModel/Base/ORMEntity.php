<?php
	
	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/
	namespace Spherus\Components\ORM\Component\SqlModel\Base;

	use Spherus\Core\SpherusException;
	use Spherus\Components\ORM\Component\SqlModel\Expressions\ORMLiteral;
		
	/**
	* Represents any object in Sql expression tree.
	* 
	* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	* @package spherus.components.query
	*/
	class ORMEntity
	{
	    
	    /* CONSTRUCTORS */
	    
	    /**
	    * Initializes a new instance of ORMEntity class.
	    * 
	    * @param string $entityType The entity type
	    */
	    public function __construct($entityType)
	    {
	        $this->$entityType = $entityType;
	    }
	    
	    /* FIELDS */
	    
	    /**
	    * Defines the entity type.
	    * @var string Uses EntityType.
	    */
	    private $entityType = null;
	    
	    
	    /* PROPERTIES */
	    
	    /**
	    * @return the type of entity.
	    * 
	    * @var string
	    */
	    public function getEntityType()
	    {
	        return $this->entityType;
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
	        
	        if(!is_a($expression, 'Spherus\Components\ORM\Component\SqlModel\Base\ORMEntity'))
	        {
	            return new ORMLiteral($expression);
	        }
	        else
	        {
	            return $expression;
	        }
	    }
	}