<?php

	namespace Spherus\Modules\Install
	{	
		use Spherus\HttpContext\Response;
		use Spherus\HttpContext\Session;
		use Spherus\HttpContext\HttpContext;
		use Spherus\Core\Base\ControllerBase;

		class HomeController extends ControllerBase
		{		
				
			public function BeforeLoad()
			{
			    $this->helpers = array('html');
			}
			
			public function index()
			{
				
			}
		
		}
	
	}

?>