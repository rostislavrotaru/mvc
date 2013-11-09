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
     * Class that represents a sql function
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlFunction extends SqlExpression
	{
	
	    /* CONSTRUCTOR */
	
	    /**
	     * Initializes a new instance of SqlFunction class.
	     *
	     * @param SqlFunctionType $functionType The type of sql function.
	     * @param mixed $arguments A single (or array) of function argument(s).
	     */
	    public function __construct($functionType, $arguments = null)
	    {
	        parent::__construct(SqlEntityType::FunctionCall);
	        	
	        $this->functionType = $functionType;
	        if(isset($arguments))
	        {
    	        if(is_array($arguments))
    	        {
    	            foreach ($arguments as $argument)
    	            {
    	               $this->arguments = $this->CheckIsLiteral($argument);
    	            }
    	        }
    	        else 
    	        {
    	            $this->arguments[] = $this->CheckIsLiteral($arguments);;
    	        }
	        }
	    }
	
	    /* FIELDS */
	
	    /**
	     * Determine the function type
	     * @var SqlFunctionType
	     */
	    private $functionType = null;
	
	    /**
	     * Contains list of function arguments
	     * @var array
	     */
	    private $arguments = array();
	
	    	
	    /* PROPERTIES */
	
	    /**
	     * @return the $arguments
	    */
	    public function getArguments()
	    {
	        return $this->arguments;
	    }
	
	    /**
	     * @return the $functionType
	     */
	    public function getFunctionType()
	    {
	        return $this->functionType;
	    }
	
	
	    /* PUBLIC METHODS */
	
	    /**
	     * Accepts visitor for the current sql object.
	     *
	     * @param SqlCompiler $visitor The visitor as SqlCompiler.
	     */
	    public function AcceptVisitor($visitor)
	    {
	        $visitor->VisitFunction($this);
	    }
	
	}