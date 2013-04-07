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
	 * Class that represents an object containing dependencies
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.ioc
	 */
	class DependencyFactory
	{

		/* FILEDS */
		
		/**
		 * Defines an array of Dependency class objects
		 * @var array
		 */
		private static $dependencies = [];
		
		/**
		 * Contains cache of resolved dependencies with instantiated objects
		 * @var array
		 */
		private static $dependencyObjectsCache;
		
		
		/* PUBLIC FUNCTIONS*/
		
		/**
		 * Get dependency by interface name.
		 *
		 * @param string $interface The interface name.
		 * @return Dependency|NULL Found Dependency object or null.
		 */
		public static function GetDependencyByInterface($interface)
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
		
		public static function Resolve(Dependency $dependency, $newInstance = false, $parameters = null)
		{
			Check::IsNullOrEmpty($dependency);
			
			if($newInstance === false)
			{
				$foundObject = self::$dependencyObjectsCache[$dependency->getInterface()];
				if(isset($foundObject))
				{
					return $foundObject;
				}
			}

			$foundObject = self::$dependencies[$dependency->getInterface()];
			if(!isset($foundObject))
			{
				throw new SpherusException(printf(EXCEPTION_DEPENDENCY_COULD_NOT_BE_RESOLVED, $dependency->getInterface()));
			}
			
			$fileName = $foundObject->getClass();
			
			return new $fileName;
		}
		
		/**
		 * Register dependency in the dependencies array.
		 * 
		 * @param Dependency $dependency The Dependency object to register.
		 * @throws SpherusException When $dependency parameter is not an instance of Dependency class.
		 */
		public static function RegisterDependency(Dependency $dependency)
		{
			self::$dependencies[$dependency->getInterface()] = $dependency;
		}
		
		/* PRIVATE FUNCTIONS */
		
		private function CreateObject(Dependency $dependency)
		{
			
		}
	}