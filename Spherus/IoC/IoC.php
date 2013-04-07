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
	use Spherus\Core\SpherusException;
		
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
		 * Defines an array of Dependency class objects
		 * @var array
		 */
		private static $dependencies = [];

		
		/* PUBLIC FUNCTIONS */
		
		public static function Register(Dependency $dependency, $overwrite = false)
		{
			Check::IsNullOrEmpty($dependency);
			$foundDependency = self::GetDependencyByInterface($dependency->getInterface());
			if(isset($foundDependency))
			{
				if($overwrite === true)
				{
					self::$dependencies[$dependency->getInterface()] = $dependency;
				}
				else 
				{
					throw new SpherusException(printf(EXCEPTION_DUPLICATE_DEPENDENCY, $dependency->getInterface()));
				}
			}
			else 
			{
				self::$dependencies[$dependency->getInterface()] = $dependency; 
			}
		}
		
		
		/* PRIVATE FUNCTIONS */
		
		/**
		 * Get dependency by interface name.
		 * 
		 * @param string $interface The interface name.
		 * @return Dependency|NULL Found Dependency object or null.
		 */
		private static function GetDependencyByInterface($interface)
		{
			foreach(self::$dependencies as $dependencyInterface=>$dependencyObject)
			{
				if($dependencyInterface === $interface)
				{
					return $dependencyObject;
				}
			}
			
			return null;
		}
	}
