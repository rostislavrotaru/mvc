<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Data\Engine\SqlDatabaseEngine\Compiler;

    /**
     * Interface that represents the sql database engine compiler context
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
    interface ISqlCompilerContext
    {
    	
    	/* PROPERTIES */
    	
    	/**
    	 * Gest the compilation result sql
    	 * @var string
    	 */
    	public function getSql();
    	
    	
    	/* PUBLIC METHODS */
    	
    	/**
    	 * Appends text to the compilation result sql
    	 * @param string $text The text to append
    	 */
    	public function AppendText($text);
    
    }