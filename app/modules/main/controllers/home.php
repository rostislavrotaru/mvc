<?php

	namespace Spherus\Modules\Main
	{	
		use Spherus\HttpContext\Response;
		use Spherus\HttpContext\Session;
		use Spherus\HttpContext\HttpContext;
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
				//$this->layout = null;
			}
			
			public function about($id = null)
			{
				//$this->layout = 'site';
			}
			
			public function redirect()
			{
				Response::Redirect('index', null, null, array(3,3,3));
			}
		
			public function unsetsession()
			{
				Session::Clear();
				Response::Redirect('index');
			}
		
		}
	
	}

?>