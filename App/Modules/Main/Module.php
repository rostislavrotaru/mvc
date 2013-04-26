<?php

	namespace App\Modules\Main;

	use Spherus\IoC\IoC;
	use Spherus\IoC\Dependency;
	use Spherus\Core\Workbench;
	use Spherus\Core\Base\ModuleBase;
								
	class Module extends ModuleBase
	{

	    /* (non-PHPdoc)
	 	* @see \Spherus\Core\Base\ModuleBase::Run()
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
					
	}