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
	use Spherus\Core\SpherusException;
					
	/**
     * Interface that represents the sql database engine
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
    interface ISqlDatabaseEngine
    {
    	
    	/* CONSTRUCT0R */
    	
    	/**
    	 * Initialize a new instance of SqlDatabaseEngine class.
    	 *
    	 * @param SqlCompiler $sqlCompiler The database compiler that will server the sql compilation and translation.
    	 */
    	public function __construct(ISqlCompiler $sqlCompiler);
    	
    	
    	/* PROPERTIES */
    	
    	/**
    	 * Returns the sql compiler.
    	 * 
    	 * @var ISqlCompiler
    	 */
    	public function getCompiler();
    	
    	/**
    	 * Sets the sql compiler
    	 * 
    	 * @param SqlCompiler $sqlCompiler The sql compiler to set.
    	 * @throws SpherusException When $sqlCompiler parameter is null or empty.
    	 */
    	public function setCompiler(ISqlCompiler $sqlCompiler);
    	
    	
    	/* PUBLIC METHODS */
    	
    	/**
    	 * Generates sql according to the given sql statement.
    	 *
    	 * @param SqlStatement $sqlStatement The Sql statement object.
    	 *
    	 * @return string Generated sql
    	 */
    	public function GenerateSql($sqlStatement);   	
    }