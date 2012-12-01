<?php

	namespace Spherus\Modules\Security\Themes
	{
	
		use Spherus\Interfaces\ITheme;
	
		class DefaultTheme implements ITheme
		{
	
			public function getLayoutsPath()
			{
				return __DIR__.DIRECTORY_SEPARATOR.'layouts';
			}
			
			public function getName() 
			{
				return 'default';
			}
		
			public function getCssPath() 
			{	
				return __DIR__.DIRECTORY_SEPARATOR.'css';
			}
	
			public function getImagesPath() 
			{
				return __DIR__.DIRECTORY_SEPARATOR.'images';
			}
		
			public function getScriptsPath() 
			{
				return __DIR__.DIRECTORY_SEPARATOR.'scripts';
			}
		
		}

	}

?>