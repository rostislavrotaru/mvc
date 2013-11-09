<?php

	namespace App\Themes\Standard;

	use Spherus\Core\Base\ThemeBase;
	use Spherus\Interfaces\ITheme;
		
	class Theme extends ThemeBase
	{

		/* FIELDS */

		/**
		 * Defines the name of theme
		 *
		 * @var string
		 */
		private $name = 'standard';
		
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

		/* (non-PHPdoc)
		 * @see \Spherus\Interfaces\ITheme::getName()
		 */
		public function getName()
		{
			return $this->name;
		}

		/*
         * (non-PHPdoc) @see \Spherus\Interfaces\ITheme::getCssPath()
         */
		public function getCssPath()
		{
			return '/themes/'.$this->name.'/css';
		}

		/*
         * (non-PHPdoc) @see \Spherus\Interfaces\ITheme::getImagesPath()
         */
		public function getImagesPath()
		{
			return '/App/Themes/'.$this->name.'/Css';
		}

		/*
         * (non-PHPdoc) @see \Spherus\Interfaces\ITheme::getLayoutsPath()
         */
		public function getLayoutsPath()
		{
			return __DIR__.'/Layouts';
		}

		/*
         * (non-PHPdoc) @see \Spherus\Interfaces\ITheme::getScriptsPath()
         */
		public function getScriptsPath()
		{
			return '/App/Themes/'.$this->name.'/scripts';
		}
	}