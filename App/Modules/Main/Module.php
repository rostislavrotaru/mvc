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
			
			$homeIndexView = new Dependency('MainHomeIndexView', null, Workbench::GetModuleByName('Main'));
			$homeIndexView->setFilePath(APP.SEPARATOR.'Modules/Main/Views/Home/Index.php');
			IoC::Register($homeIndexView);
			
			$homeAboutView = new Dependency('MainHomeAboutView', null, Workbench::GetModuleByName('Main'));
			$homeAboutView->setFilePath(APP.SEPARATOR.'Modules/Main/Views/Home/About.php');
			IoC::Register($homeAboutView);
		}
	
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\IModule::GetThemesNamespace()
		 */
		public function GetThemesNamespace() 
		{
			return __NAMESPACE__.'\\Themes';
		}

		
	}