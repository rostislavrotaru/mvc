<?php

	namespace App\Modules\Main;

	use Spherus\Interfaces\IModule;
	use Spherus\IoC\IoC;
	use Spherus\IoC\Dependency;
			
	class MainModule implements IModule
	{

	    /**
	     * Permits to write custom functionality when module is loaded
	     */
	    public function Run()
	    {
	    	$this->RegisterDependencies();
	    }
	
	    
	
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\IModule::GetControllersNamespace()
		 */
		public function GetControllersNamespace() 
		{
			return 'App\Modules\Main\Controllers\\';
		}

		
		/* PRIVATE FUNCTIONS */
		
		/**
		 * Registers IoC dependencies
		 */
		private function RegisterDependencies()
		{
			IoC::Register(new Dependency('IHomeController', 'App\Modules\Main\Controllers\HomeController'));
		}
		
	}