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
     * Interface that represents the sql database engine compiler
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
    interface ISqlCompiler
    {
    	/* CONSTRUCTOR */
    	
    	public function __construct(ISqlCompilerContext $sqlCompilerContext, ISqlTranslator $sqlTranslator);
    	
    	
    	/* PROPERTIES */
    	
    	/**
    	 * Gets the sql compiler context
    	 * @return ISqlCompilerContext
    	 */
    	public function getSqlCompilerContext();
    	
    	/**
    	 * Gets the sql translator
    	 * @return ISqlTranslator
    	 */
    	public function getSqlTranslator();
    }