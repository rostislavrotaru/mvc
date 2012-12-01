<?php
	use Spherus\Interfaces\IModule;

	class TestModule implements IModule
	{
		
		/**
		 * Permits to write custom functionality when module is loaded
		 */
		function Run()
		{
			//echo('test<br />');
		}

		/**
		 * Gets module name
		 * @return string
		 */
	 	public function GetNamespaceName() 
	 	{
			return 'Spherus\Modules\Test';
		}

		/**
		 * Gets module namestace name
		 * @return string
		 */
		public function GetModuleName()
		{
			return 'test';
		}
		
		/**
		 * Gets module theme name
		 * @return string
		 */
		public function GetModuleThemeName()
		{
			return('default');
		}
		
	}

?>