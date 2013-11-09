<?php

	namespace App\Modules\Main\Secured\Controllers;

	use Spherus\Core\Base\ControllerBase;
	use Spherus\Components\Query\Component;
		
	class HomeController extends ControllerBase
	{
		public function index()
		{
			$this->ViewData['query'] = new Component();
		}

		public function about()
		{
			 $this->setLayout('site');
		}
	}