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
    	 * @param string $providerName The database provider name that will server the sql compilation and translation.
    	 */
    	public function __construct($providerName = null)
    	{
    		$this->InitializeCompiler($providerName);
    	}
    	
    	
    	/* FIELDS */
    	
    	/**
    	 * Determine the compiler used for sql generation
    	 * @var SqlCompiler
    	 */
    	private $compiler = null;
    	
    	
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
    	
    	
    	/* PRIVATE METHODS */
    	
    	/**
    	 * Initializes compiler according to the given name.
    	 *
    	 * @param string $compilerName The name of compiler to initialize.
    	 */
    	private function InitializeCompiler($compilerName)
    	{
    		require_once(SPHQUERY_COMPILER.'sqlcompiler.php');
    			
    		$filename = SPHQUERY_COMPILER.$compilerName.SEPARATOR.'compiler.php';
    		if (file_exists($filename))
    		{
    			require_once($filename);
    		}
    		unset($filename);
    			
    		$compilerFullName = $compilerName.'Compiler';
    		$this->compiler = new $compilerFullName($compilerName);
    	}
    }