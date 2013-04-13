<?php

	namespace App\Modules\Main\Themes\Standard;

	use Spherus\Interfaces\ITheme;

	class Theme implements ITheme
	{

		public function getLayoutsPath()
		{
			return __DIR__.SEPARATOR.'layouts';
		}

		public function getName()
		{
		}

		public function getCssPath()
		{
		}

		public function getImagesPath()
		{
		}

		public function getScriptsPath()
		{
		}
	}