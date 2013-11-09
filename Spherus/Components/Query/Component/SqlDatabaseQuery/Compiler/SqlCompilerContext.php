<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler;

    /**
     * Class that represents the sql database engine compiler context
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlCompilerContext
    {
    	
    	/* FIELDS */
    	
    	/**
    	 * Contains compilation result sql
    	 * @var string
    	 */
    	private $sql = null;
    	
    	
    	/* PROPERTIES */
    	
    	/* (non-PHPdoc)
    	 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlCompilerContext::getSql()
    	*/
    	public function getSql()
    	{
    		return $this->sql;
    	}
    	
    	/* PUBLIC METHODS */
    	
    	/**
    	 * Appends text to the compilation result sql
    	 * @param string $text
    	 */
    	public function AppendText($text)
    	{
    		$this->sql .= isset($text) ? ' '.$text : null;
    	}
    }