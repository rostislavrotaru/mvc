<?php

	namespace App\Modules\Main\Controllers;

	use Spherus\Core\Base\ControllerBase;

	class HomeController extends ControllerBase
	{
		public function BeforeLoad()
		{
			$this->noViewControllers = array('redirect');
			$this->helpers = array('html');
		}

		public function index()
		{
			// $this->layout = null;
		}

		public function about($id = null)
		{
			 $this->layout = 'site';
		}
	}