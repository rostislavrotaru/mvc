<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Core\Base;
	
	/**
	 * Class that represents the base for all application themes
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	class ThemeBase
	{
		
		/* FIELDS */
		
		/**
		 * Defines the name of theme
		 *
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Defines the child theme object
		 * @var ThemeBase
		 */
		private $childTheme = null;
		
		
		/* PROPERTIES */
		
		/**
         * Gets child theme
         *
         * @return ThemeBase
         */
		public function getChildTheme()
		{
			return $this->childTheme;
		}
			
		/**
         * Sets child theme
         *
         * @param ThemeBase $childTheme The child theme object to set. 
         * @return ThemeBase
         */
		public function setChildTheme($childTheme)
		{
			$this->childTheme = $childTheme;
		}
		
		/**
         * Gets the name of theme
         *
         * @return string
         */
		public function GetName()
		{
			return $this->name;
		}
		
		/**
         * Gets the path of CSS files
         *
         * @return string
         */
		public function GetCssPath()
		{
			return '/App/Themes/'.$this->name.'/Css';
		}
		
		/**
         * Gets the path of image files
         *
         * @return string
         */
		public function GetImagesPath()
		{
			return '/App/Themes/'.$this->name.'/Css';
		}
		
		/**
         * Gets the path of layout files
         *
         * @return string
         */
		public function GetLayoutsPath()
		{
			return __DIR__.'/Layouts';
		}
		
		/**
         * Gets the path of script files
         *
         * @return string
         */
		public function GetScriptsPath() 
		{
			return '/App/Themes/'.$this->name.'/Scripts';
		}
	}