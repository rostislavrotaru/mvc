<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Data\Engine\SqlDatabaseEngine;

    use Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlCompiler;
	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
					
								/**
     * Class that represents the sql database engine
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
    class SqlDatabaseEngine
    {
    	
    	/* CONSTRUCT0R */
    	
    	/**
    	 * Initialize a new instance of SqlDatabaseEngine class.
    	 *
    	 * @param SqlCompiler $sqlCompiler The database compiler that will server the sql compilation and translation.
    	 */
    	public function __construct(ISqlCompiler $sqlCompiler)
    	{
    		$this->setCompiler($sqlCompiler);
    	}
    	
    	
    	/* FIELDS */
    	
    	/**
    	 * Determine the compiler used for sql generation
    	 * @var ISqlCompiler
    	 */
    	private $compiler = null;
    	
    	
    	/* PROPERTIES */
    	
    	/**
    	 * Returns the sql compiler.
    	 * 
    	 * @return ISqlCompiler
    	 */
    	public function getCompiler()
    	{
    		return $this->compiler;
    	}
    	
    	/**
    	 * Sets the sql compiler
    	 * 
    	 * @param SqlCompiler $sqlCompiler The sql compiler to set.
    	 * @throws SpherusException When $sqlCompiler parameter is null or empty.
    	 */
    	public function setCompiler(ISqlCompiler $sqlCompiler)
    	{
    		Check::IsNullOrEmpty($sqlCompiler);
    		$this->compiler = $sqlCompiler;
    	}
    	
    	
    	/* PUBLIC METHODS */
    	
    	/**
    	 * Generates sql according to the given sql statement.
    	 *
    	 * @param SqlStatement $sqlStatement The Sql statement object.
    	 *
    	 * @return string Generated sql
    	 */
    	public function GenerateSql($sqlStatement)
    	{
//     		if ($sqlStatement instanceof SqlBatch)
//     		{
//     			return $this->compiler->VisitBatch($sqlStatement);
//     		}
//     		elseif ($sqlStatement instanceof SqlSelect)
//     		{
//     			return $this->compiler->VisitSelect($sqlStatement);
//     		}
//     		elseif ($sqlStatement instanceof SqlUpdate)
//     		{
//     			return $this->compiler->VisitUpdate($sqlStatement);
//     		}
//     		elseif ($sqlStatement instanceof SqlInsert)
//     		{
//     			return $this->compiler->VisitInsert($sqlStatement);
//     		}
//     		elseif ($sqlStatement instanceof SqlDelete)
//     		{
//     			return $this->compiler->VisitDelete($sqlStatement);
//     		}
    			
//     		throw new Exception('Invalid SqlStatement given for compilation!');
    	}    	
    }