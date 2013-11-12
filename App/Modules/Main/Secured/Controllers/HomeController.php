<?php

	namespace App\Modules\Main\Secured\Controllers;

	use Spherus\Core\Base\ControllerBase;
		
	class HomeController extends ControllerBase
	{
		public function __construct()
		{
			//$this->setLayout('default');
		}
		
		public function index()
		{
			//return new Component();
		}

		public function about()
		{
			 $this->setLayout('site');
		}
	}