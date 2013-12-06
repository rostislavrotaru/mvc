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

    use Spherus\Components\Data\Component\DatabaseParameter;
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
    	
    	/**
    	 * Contains an array of database parameters
    	 * @var array
    	 */
    	private $databaseParameters = []; 
    	
    	
    	/* PROPERTIES */
    	
    	/* (non-PHPdoc)
    	 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlCompilerContext::getSql()
    	*/
    	public function getSql()
    	{
    		return $this->sql;
    	}
    	
    	/**
    	 * Gets list of database parameters
    	 * 
    	 * @return array
    	 */
    	public function getDatabaseParameters()
    	{
    		return $this->databaseParameters;
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

		/**
    	 * Adds database parameter.
    	 * 
    	 * @param DatabaseParameter $databasePatameter The parameter to add.
    	 */
    	public function AddDatabaseParameter(DatabaseParameter $databasePatameter)
    	{
    		$this->databaseParameters[$databasePatameter->getName()] = $databasePatameter;
    	}
    }