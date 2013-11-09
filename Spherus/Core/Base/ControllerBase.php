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

	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	
		/**
	 * Class that represents the base for all application controllers
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	abstract class ControllerBase
	{

		/* FIELDS */

		/**
		 * Defines whether the controller has no view. Default is False.
		 *
		 * @var boolean
		 */
		private $noView = false;

		/**
		 * Defines the controller layout
		 *
		 * @var string
		 */
		private $layout = null;

		/**
		 * Defines whether the Workbench should use IoC for loading controller view. 
		 *
		 * @var boolean
		 */
		private $useIoCForView = false;
		
		/**
		 * Defines the controller page title
		 * @var string
		 */
		private $pageTitle = null; 

		
		
		/* PROPERTIES */
		
		
		/**
		 * Defines the controller view data
		 * @var array
		 */
		public $ViewData = [];
		
		
		/**
		 * Gets whether the controller has no view.
		 *
		 * @var boolean
		 */
		public function getNoView()
		{
			return $this->noView;
		}
		
		/**
		 * Sets whether the controller has no view.
		 * 
		 * @param boolean $noView The boolean value
		 */
		public function setNoView($noView)
		{
			$this->noView = (boolean)$noView;
		}
		
		/**
		 * Gets the controller layout
		 *
		 * @var string
		 */
		public function getLayout()
		{
			return $this->layout;
		}
		
		/**
		 * Sets the controller layout
		 * 
		 * @param string $layout The layout to set
		 * @throws SpherusException When $layout parameter is null or empty
		 */
		public function setLayout($layout)
		{
			Check::IsNullOrEmpty($layout);
			$this->layout = $layout;
		}
		
		/**
		 * Gets whether the Workbench should use IoC for loading controller view. 
		 *
		 * @var boolean
		 */
		public function getUseIoCForView()
		{
			return $this->useIoCForView;
		}
		
		/**
		 * Sets whether the Workbench should use IoC for loading controller view.
		 * 
		 * @param boolean $useIoCForView The Boolean value
		 */
		public function setUseIoCForView($useIoCForView)
		{
			$this->useIoCForView = (boolean)$useIoCForView;
		}
		
		/**
		 * Gets the page title
		 *
		 * @var string
		 */
		public function getPageTitle()
		{
			return $this->pageTitle;
		}
		
		/**
		 * Sets the page title
		 *
		 * @param string $pageTitle The page title to set
		 */
		public function setPageTitle($pageTitle)
		{
			$this->pageTitle = $pageTitle;
		}
		
		
		/* EVENT TEMPLATES */

		/**
		 * Is raised before any controller and performs common for all
		 * controllers actions,
		 * can be replaced or completed in application common controller or specific
		 * controller
		 */
		public function BeforeLoad()
		{
		}

		/**
		 * Is raised after controller loads and before action loads,
		 * can be replaced or completed in application controller or definite
		 * controller
		 */
		public function AfterLoad()
		{
		}

		/**
		 * Is raised before controller action,
		 * can be replaced or completed in application controller or definite
		 * controller
		 */
		public function BeforeAction()
		{
		}

		/**
		 * Is raised after controller action,
		 * can be replaced or completed in application controller or definite
		 * controller
		 */
		public function AfterAction()
		{
		}
	
	}