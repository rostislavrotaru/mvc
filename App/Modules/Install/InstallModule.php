<?php

	use Spherus\Routing\Route;
	use Spherus\Routing\RouteManager;
	use Spherus\Interfaces\IModule;

	class InstallModule implements IModule
	{

		/**
		 * Permits to write custom functionality when module is loaded
		 */
		function Run()
		{
			//RouteManager::RegisterRoute(new Route('InstallRoute', '/install/home/index', 'cucu'));
			RouteManager::RegisterRoute(new Route('HomeRoute', '/install/:param/*', 'cucu'));
		}

		public function GetNamespaceName()
		{
			return 'Spherus\Modules\Install';
		}

		/**
		 * Gets module namestace name
		 *
		 * @return string
		 */
		public function GetModuleName()
		{
			return 'install';
		}

		/*
	     * (non-PHPdoc) @see \Spherus\Interfaces\IModule::GetHelpersPath()
	     */
		public function GetHelpersPath()
		{
			return __DIR__.SEPARATOR.'includes'.SEPARATOR.'helpers';
		}
	}