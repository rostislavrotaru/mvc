<?php

	namespace App\Modules\Main;

	use Spherus\Interfaces\IModule;
	
	class MainModule implements IModule
	{

	    /**
	     * Permits to write custom functionality when module is loaded
	     */
	    function Run()
	    {
	    	//RouteManager::RegisterRoute(new Route('MainRoute', '/main/:param/*', 'cucu'));
	    }
	
	
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\IModule::GetControllersNamespace()
		 */
		public function GetControllersNamespace() 
		{
			return 'App\Modules\Main\Controllers\\';
		}

	}