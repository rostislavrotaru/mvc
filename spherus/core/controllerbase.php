<?php

	namespace Spherus\Core
	{
		/**
		 * Class that represents the base for all application controllers
		 *
		 * @author Rostislav Rotaru
		 * @package spherus.core
		 * @version 3.0
		 * 
		 */
		abstract class ControllerBase
		{
			/* FIELDS */
			
			/**
			 * Determine the list of controller functions that has no views
			 * @var array
			 */
			public $noViewControllers = array();
			
			/**
			 * Defines the controller layout
			 * @var string
			 */
			public $layout = null; 
		 

			/* EVENT TEMPLATES */

			/**
			* Is raised before any controller and performs common for all controllers actions,
			* can be replaced or completed in application controller or definite controller
			*/
			public function BeforeLoad()
			{
	
			}
			
			/**
			 * Is raised after controller loads and before action loads,
			 * can be replaced or completed in application controller or definite controller
			 */
			public function AfterLoad()
			{
			
			}
	
			/**
			* Is raised before controller action,
			* can be replaced or completed in application controller or definite controller
			*/
			public function BeforeAction()
			{
	
			}
	
			/**
			* Is raised after controller action,
			* can be replaced or completed in application controller or definite controller
			*/
			public function AfterAction()
			{
	
			}

			
			public function GetName()
			{
				return get_class($this);
			}
			
		}
	}
?>