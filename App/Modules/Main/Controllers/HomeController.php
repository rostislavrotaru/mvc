<?php

	namespace App\Modules\Main\Controllers;

	use Spherus\Core\Base\ControllerBase;
	use Spherus\Core\Base\SystemComponentBase;
	
	class HomeController extends ControllerBase
	{
		public function index()
		{
			$r = new SystemComponentBase('test');
			//DataEngineService::Test();
		}

		public function about()
		{
			 $this->setLayout('site');
		}
	}