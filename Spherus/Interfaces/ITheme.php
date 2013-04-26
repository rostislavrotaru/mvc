<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/
	namespace Spherus\Interfaces;
		
    /**
     * Defines interface for application themes
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.interfaces
     */
    interface ITheme
    {

    	/* PROPERTIES */
    	
    	/**
    	 * Gets the child theme object
    	 *
    	 * @return ITheme
    	 */
    	public function getChildTheme();
    	
    	/**
    	 * Sets the child theme object
    	 * 
    	 * @param ITheme $childTheme The child theme object to set.
    	 */
    	public function setChildTheme($childTheme);
    	
    	
    	/* METHODS */
    	
        /**
         * Gets the name of theme
         *
         * @return string
         */
        public function GetName();

        /**
         * Gets the path of CSS files
         *
         * @return string
         */
        public function GetCssPath();

        /**
         * Gets the path of image files
         *
         * @return string
         */
        public function GetImagesPath();

        /**
         * Gets the path of layout files
         *
         * @return string
         */
        public function GetLayoutsPath();

        /**
         * Gets the path of script files
         *
         * @return string
         */
        public function GetScriptsPath();
    
    }