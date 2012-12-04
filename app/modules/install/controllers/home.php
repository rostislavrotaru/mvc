<?php

	namespace Spherus\Modules\Install
	{	
		use Spherus\HttpContext\Response;
		use Spherus\HttpContext\Session;
		use Spherus\HttpContext\HttpContext;
		use Spherus\Core\ControllerBase;

		class HomeController extends ControllerBase
		{		
				
			public function BeforeLoad()
			{
				$this->layout = 'install';
			}
			
			public function index()
			{
				
			}
		
		}
	
	}

?>