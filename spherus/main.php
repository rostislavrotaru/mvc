<?php

	/**
	 * Serves as the base for the framework booting process
	 *
	 * @author Rostislav Rotaru
	 * @package spherus
	 * @version 3.0
	 * 
	 */	

	use Spherus\HttpContext\HttpContext;
	use Spherus\Core\Bootstrapper;
	use Spherus\Routing\RouteHandler;
	use Spherus\Core\Context;
	use Spherus\HttpContext\Session;

	//Base require files
	require('requires.php');
	
	Session::Start();
	
	//Load application configuration file
	//Throws exception if not found
	Context::LoadApplicationConfig();
	
	//Initialize route handler
	RouteHandler::Initialize();
	
	//Initialize http context
	HttpContext::Initialize();
	
	//Initialize bootstrapper
	Context::Initialize();

?>