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
	 * Class that represents the base for all UI controls
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	abstract class UIControlBase extends ComponentBase
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of UIControlBase class
		 *
		 * @param string $name The name of UI control
		 */
		public abstract function __construct($name);
	}