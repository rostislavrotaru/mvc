<?php
	use Spherus\Interfaces\IModule;

	class InstallModule implements IModule
	{
		
		/**
		 * Permits to write custom functionality when module is loaded
		 */
		function Run()
		{
			
		}

	 	public function GetNamespaceName()
	 	{
			return 'Spherus\Modules\Install';
		}

		/**
		 * Gets module namestace name
		 * @return string
		 */
	 	public function GetModuleName() 
	 	{
			return 'install';
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\IModule::GetHelpersPath()
		 */
		public function GetHelpersPath()
		{
		    return __DIR__.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'helpers';
		}
	
	}

?>