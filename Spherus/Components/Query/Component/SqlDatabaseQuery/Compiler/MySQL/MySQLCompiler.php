<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\MySQL;
	
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompilerContext;
	    
	/**
     * Class that represents the mysql database engine compiler
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class MySQLCompiler extends SqlCompiler
	{
		public function __construct()
		{
			parent::__construct(new SqlCompilerContext(), new MySQLTranslator());
		}
	}