<?php

	namespace Spherus\Interfaces
	{
		/**
		 * Defines interface for application themes
		 *
		 * @author Rostislav Rotaru
		 * @package spherus.interfaces
		 * @version 3.0
		 *
		 */
		interface ITheme
		{
			
			//Should be implemeted in theme.php file for each module
			
			/**
			 * Gets the name of theme
			 * @return string 
			 */
			public function getName();
		
			/**
			 * Gets the path of CSS files
			 * @return string 
			 */
			public function getCssPath();
			
			/**
			 * Gets the path of image files
			 * @return string
			 */
			public function getImagesPath();

			/**
			 * Gets the path of layout files
			 * @return string
			 */
			public function getLayoutsPath();
			
			/**
			 * Gets the path of script files
			 * @return string
			 */
			public function getScriptsPath();
			
		}
	}

?>