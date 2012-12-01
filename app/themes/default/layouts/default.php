<?php
	echo("<link  type='text/css' rel='stylesheet' href='../../".THEMES."default/css/cssser.css'></link>");
	use Spherus\HttpContext\HttpContext;
	echo HttpContext::getPageContent(); 
?>