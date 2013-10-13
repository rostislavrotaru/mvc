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

	use Spherus\Core\Check;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlSelect;
    use Spherus\Core\SpherusException;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlQueryExpression;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlDelete;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Statements\SqlIf;
																													
	/**
     * Class that represents the sql database engine
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlQuery
    {
    	
    	/* CONSTRUCT0R */
    	
    	/**
    	 * Initialize a new instance of SqlDatabaseEngine class.
    	 *
    	 * @param SqlCompiler $sqlCompiler The database compiler that will server the sql compilation and translation.
    	 */
    	public function __construct(SqlCompiler $sqlCompiler)
    	{
    		$this->setCompiler($sqlCompiler);
    	}
    	
    	
    	/* FIELDS */
    	
    	/**
    	 * Determine the compiler used for sql generation
    	 * @var SqlCompiler
    	 */
    	private $compiler = null;
    	
    	
    	/* PROPERTIES */
    	
    	/* (non-PHPdoc)
		 * @see ISqlCompiler::getCompiler()
		*/
    	public function getCompiler()
    	{
    		return $this->compiler;
    	}
    	
    	/* (non-PHPdoc)
		 * @see ISqlCompiler::setCompiler()
		*/
    	public function setCompiler(SqlCompiler $sqlCompiler)
    	{
    		Check::IsNullOrEmpty($sqlCompiler);
    		$this->compiler = $sqlCompiler;
    	}
    	
    	
    	/* PUBLIC METHODS */
    	
    	/* (non-PHPdoc)
		 * @see ISqlCompiler::GenerateSql()
		*/
    	public function GenerateSql($sqlStatement)
    	{
    		if ($sqlStatement instanceof SqlSelect)
    		{
    			return $this->compiler->VisitSelect($sqlStatement);
    		}
    		elseif ($sqlStatement instanceof SqlQueryExpression)
    		{
    			return $this->compiler->VisitSqlQueryExpression($sqlStatement);
    		}
    		elseif ($sqlStatement instanceof SqlDelete)
    		{
    			return $this->compiler->VisitDelete($sqlStatement);
    		}
    		elseif ($sqlStatement instanceof SqlIf)
    		{
    		    return $this->compiler->VisitIf($sqlStatement);
    		}
//     		elseif ($sqlStatement instanceof SqlUpdate)
//     		{
//     			return $this->compiler->VisitUpdate($sqlStatement);
//     		}
//     		elseif ($sqlStatement instanceof SqlInsert)
//     		{
//     			return $this->compiler->VisitInsert($sqlStatement);
//     		}
//     		
    			
     		throw new SpherusException(EXCEPTION_INVALID_STATEMENT);
    	}    	
    }