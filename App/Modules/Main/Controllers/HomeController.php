<?php

	namespace App\Modules\Main\Controllers;

	use Spherus\Core\Base\ControllerBase;
	use App\Modules\Main\Services\DataEngineService;
	
	class HomeController extends ControllerBase
	{
		public function index()
		{
			DataEngineService::Test();
		}

		public function about()
		{
			 $this->layout = 'site';
		}
	}