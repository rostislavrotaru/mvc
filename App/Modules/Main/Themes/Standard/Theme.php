<?php

	namespace App\Modules\Main\Themes\Standard;

	use Spherus\Core\Base\ThemeBase;
	
	class Theme extends ThemeBase
	{
		
		/* FIELDS */
		
		/**
		 * Defines the child theme object
		 * @var ITheme
		 */
		private $childTheme = null;
		
		
		/* PROPERTIES */
		
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\ITheme::getChildTheme()
		*/
		public function getChildTheme()
		{
			return $this->childTheme;
		}
			
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\ITheme::setChildTheme()
		*/
		public function setChildTheme($childTheme)
		{
			$this->childTheme = $childTheme;
		}
		
		
		/* METHODS */
		
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\ITheme::GetName()
		 */
		public function GetName() 
		{
			// TODO Auto-generated method stub
		}
	
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\ITheme::GetCssPath()
		 */
		public function GetCssPath() 
		{
			// TODO Auto-generated method stub
		}
	
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\ITheme::GetImagesPath()
		 */
		public function GetImagesPath() 
		{
			// TODO Auto-generated method stub
		}
	
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\ITheme::GetLayoutsPath()
		 */
		public function GetLayoutsPath()
		{
			// TODO Auto-generated method stub
		}
	
		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\ITheme::GetScriptsPath()
		 */
		public function GetScriptsPath() 
		{
			// TODO Auto-generated method stub
		}
		
	}