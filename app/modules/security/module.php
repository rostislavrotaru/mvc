<?php
	use Spherus\Interfaces\IModule;

	class SecurityModule implements IModule
	{
		
		/**
		 * Permits to write custom functionality when module is loaded
		 */
		function Run()
		{
			
		}

		/**
		 * Gets module name
		 * @return string
		 */
	 	public function GetNamespaceName() 
	 	{
			return 'Spherus\Modules\Security';
		}

		/**
		 * Gets module namestace name
		 * @return string
		 */
	 	public function GetModuleName() 
	 	{
			return 'security';
		}
		
	}

?>