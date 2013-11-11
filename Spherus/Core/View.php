<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Core;
	
	/**
	 * Class that represents the application view
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	abstract class View
	{
		/**
		 * Represents a view data elements
		 *
		 * @var array
		 */
		public static $viewData = [];
		
		/**
		 * Represents a controller return value
		 *
		 * @var object
		 */
		public static $actionResult = null;
	}
