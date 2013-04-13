<?php

	namespace App\Modules\Main;

	use Spherus\Interfaces\IModule;
	use Spherus\IoC\IoC;
	use Spherus\IoC\Dependency;
	use Spherus\Core\Workbench;
							
	class Module implements IModule
	{

	    /**
	     * Permits to write custom functionality when module is loaded
	     */
	    public function Run()
	    {
	    	$this->RegisterDependencies();
	    }

		
		/* PRIVATE FUNCTIONS */
		
		/**
		 * Registers IoC dependencies
		 */
		private function RegisterDependencies()
		{
			IoC::Register(new Dependency('HomeController', 'App\Modules\Main\Controllers\HomeController', Workbench::GetModuleByName('Main')));
		}
	
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\IModule::GetThemesNamespace()
		 */
		public function GetThemesNamespace() 
		{
			return __NAMESPACE__.'\\Themes';
		}

		
	}