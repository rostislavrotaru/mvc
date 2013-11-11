<?php

	namespace App\Modules\Main\Secured\Controllers;

	use Spherus\Core\Base\ControllerBase;
	use Spherus\Components\Query\Component;
		
	class HomeController extends ControllerBase
	{
		public function __construct()
		{
			//$this->setLayout('default');
		}
		
		public function index()
		{
			$this->ViewData['query'] = new Component();
			return new Component();
		}

		public function about()
		{
			 $this->setLayout('site');
		}
	}