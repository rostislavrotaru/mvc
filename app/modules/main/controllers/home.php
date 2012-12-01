<?php

	namespace Spherus\Modules\Main
	{	
		use Spherus\HttpContext\Response;
		use Spherus\HttpContext\Session;
		use Spherus\HttpContext\HttpContext;
		use Spherus\Core\ControllerBase;

		class HomeController extends ControllerBase
		{		
				
			public function BeforeLoad()
			{
				$this->noViewControllers = array('redirect');
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
				Response::Redirect('index', null, 'test', array(3,3,3));
			}
		
			public function UnsetSession()
			{
				Session::Clear();
				Response::Redirect('index');
			}
		
		}
	
	}

?>