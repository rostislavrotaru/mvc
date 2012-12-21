<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/
	
	/**
	* Serves as the base for the booting process
	* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	* @package spherus
	*/

	use Spherus\Core\Context;
	use Spherus\HttpContext\HttpContext;
	use Spherus\HttpContext\Session;
	use Spherus\Routing\RouteHandler;

	//Base require files
	require('requires.php');
	
	//Starts session
	Session::Start();
	
	//Load application configuration file
	//Throws exception if not found
	Context::LoadApplicationConfig();
	
	//Initialize route handler
	RouteHandler::Initialize();
	
	//Initialize http context
	HttpContext::Initialize();
	
	//Initialize context
	Context::Initialize();

?>