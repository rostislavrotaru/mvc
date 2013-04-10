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
     * Class that represents the sql database engine compiler
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
    class SqlCompiler implements ISqlCompiler
    {
	
    	/* CONSTRUCTOR */
	
		/**
    	 * Initializes a new instance of SqlCompiler class
    	 * 
    	 * @param ISqlCompilerContext SqlCompilerContext The sql compiler context.
    	 * @param ISqlTranslator $sqlTranslator The sql translator.
    	 */
		public function __construct(ISqlCompilerContext $sqlCompilerContext, ISqlTranslator $sqlTranslator) 
		{
			$this->sqlCompilerContext = $sqlCompilerContext;
			$this->sqlTranslator = $sqlTranslator;
		}

		/* FILEDS */
		
		/**
		 * Defines the sql compiler context
		 * @var ISqlCompilerContext
		 */
		private $sqlCompilerContext = null;
		
		/**
		 * Defines the sql translator
		 * @var ISqlTranslator
		 */
		private $sqlTranslator = null;
	
		
		/* PROPERTIES */
	
		/**
		 * @return the $sqlCompilerContext
		 */
		public function getSqlCompilerContext() 
		{
			return $this->sqlCompilerContext;
		}
	
		/**
		 * @return the $sqlTranslator
		 */
		public function getSqlTranslator() 
		{
			return $this->sqlTranslator;
		}

    	
    }