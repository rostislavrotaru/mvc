<?php

	namespace App\Modules\Main\Controllers;

	use Spherus\Core\Base\ControllerBase;
	
	class HomeController extends ControllerBase
	{
		public function index()
		{
			//$r = new SystemComponentBase('test');
			//DataEngineService::Test();
		}

		public function about()
		{
			 $this->setLayout('site');
		}
	}