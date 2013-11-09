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
	 * Class that represents the base for all controls
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	abstract class ControlBase extends ComponentBase
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of ControlBase class
		 *
		 * @param string $name The name of control
		 */
		public abstract function __construct($name);
	}