<?php

	namespace App\Themes\Standard;

	use Spherus\Interfaces\ITheme;

	class Theme implements ITheme
	{

		/* FIELDS */

		/**
		 * Defines the name of theme
		 *
		 * @var string
		 */
		private $name = 'default';

		/* PROPERTIES */

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
			return THEMES.$this->name.SEPARATOR.'css';
		}

		/*
         * (non-PHPdoc) @see \Spherus\Interfaces\ITheme::getImagesPath()
         */
		public function getImagesPath()
		{
			return THEMES.$this->name.SEPARATOR.'images';
		}

		/*
         * (non-PHPdoc) @see \Spherus\Interfaces\ITheme::getLayoutsPath()
         */
		public function getLayoutsPath()
		{
			return THEMES.$this->name.SEPARATOR.'layouts';
		}

		/*
         * (non-PHPdoc) @see \Spherus\Interfaces\ITheme::getScriptsPath()
         */
		public function getScriptsPath()
		{
			return THEMES.$this->name.SEPARATOR.'scripts';
		}
	}