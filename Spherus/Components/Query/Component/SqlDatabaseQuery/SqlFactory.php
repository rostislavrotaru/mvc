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
					
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Structure\SqlColumn;
	
	/**
     * Class that represents the sql database factory
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlFactory
	{
	    /* COLUMNS */
	    
	    /**
	     * Creates a sql table column.
	     *
	     * @param string $name The sql table column name.
	     * @param SqlTable $sqlTable The parent SqlTable.
	     * @param string $alias Column alias.
	     *
	     * @return SqlColumn Instantiated SqlColumn object
	     */
	    public static function Column($name, $sqlTable = null, $alias = null)
	    {
	        return new SqlColumn($name, $sqlTable, $alias);
	    }
	}

?>