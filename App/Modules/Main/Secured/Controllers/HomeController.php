<?php

	namespace App\Modules\Main\Secured\Controllers;

	use Spherus\Core\Base\ControllerBase;
use App\Modules\Main\Secured\Models\DomainModel;
									
	class HomeController extends ControllerBase
	{
		public function __construct()
		{
			//$this->setLayout('default');
		}
		
		public function index()
		{
			$domainModel = new DomainModel();
		}

		public function about()
		{
			 $this->setLayout('site');
		}
	}