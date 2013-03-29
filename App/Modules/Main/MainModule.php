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

	    /**
	     * Gets module name
	     *
	     * @return string
	     */
	    public function GetNamespaceName()
	    {
	        return 'Spherus\Modules\Main';
	    }

	    /**
	     * Gets module namestace name
	     *
	     * @return string
	     */
	    public function GetModuleName ()
	    {
	        return 'main';
	    }

	    /*
	     * (non-PHPdoc) @see \Spherus\Interfaces\IModule::GetHelpersPath()
	     */
	    public function GetHelpersPath ()
	    {
	        return __DIR__ . SEPARATOR . 'includes' . SEPARATOR . 'helpers';
	    }
	}