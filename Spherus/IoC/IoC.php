<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	
	namespace Spherus\IoC;

	use Spherus\Core\Check;
	
	/**
	 * Class that represents functionality for inversion of control
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.ioc
	 */
	class IoC
	{
		
		/* FIELDS */
		
		/**
		 * Defines an array of dependencies objects
		 * @var array
		 */
		private $dependencies = [];

		/* PUBLIC FUNCTIONS */
		
		public static function Register($interface, $class)
		{
			Check::IsNullOrEmpty($interface);
			Check::IsNullOrEmpty($class);
		}
	}
