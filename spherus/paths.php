<?php

	/**
	 * Defines framework paths
	 * 
	 * @author Rostislav.Rotaru
	 * @package spherus
	 * @version 3.0
	 * 
	*/

	/* FRAMEWORK CONSTANTS */

	//Root path
	define('ROOT', '.');
	
	//Spherus path
	define('SPHERUS', ROOT.DIRECTORY_SEPARATOR.'spherus'.DIRECTORY_SEPARATOR);
	
	//Core path
	define('CORE', SPHERUS.'core'.DIRECTORY_SEPARATOR);
	
	//Parsers path
	define('PARSERS', SPHERUS.'parsers'.DIRECTORY_SEPARATOR);
	
	//Routing path
	define('ROUTING', SPHERUS.'routing'.DIRECTORY_SEPARATOR);
	
	//HttpContext path
	define('HTTP_CONTEXT', SPHERUS.'httpcontext'.DIRECTORY_SEPARATOR);
	
	//Interfaces path
	define('INTERFACES', SPHERUS.'interfaces'.DIRECTORY_SEPARATOR);
	
	
	/* APPLICATION CONSTANTS */
	
	//Public application path
	define('APP', ROOT.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR);
	
	//Application common folder path
	define('APP_COMMON', APP.'common'.DIRECTORY_SEPARATOR);
	
	//Application modules path
	define('MODULES', APP.'modules'.DIRECTORY_SEPARATOR);
	
	//Application themes path
	define('THEMES', APP.'themes'.DIRECTORY_SEPARATOR);

?>