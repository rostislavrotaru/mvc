<?php

	namespace Spherus\Modules\Install\Themes;

	use Spherus\Interfaces\ITheme;

	class DefaultTheme implements ITheme
	{

		public function getLayoutsPath()
		{
			return __DIR__.SEPARATOR.'layouts';
		}

		public function getName()
		{
			return 'default';
		}

		public function getCssPath()
		{
			return __DIR__.SEPARATOR.'css';
		}

		public function getImagesPath()
		{
			return __DIR__.SEPARATOR.'images';
		}

		public function getScriptsPath()
		{
			return __DIR__.SEPARATOR.'scripts';
		}
	}