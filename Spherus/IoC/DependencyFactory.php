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
	use Spherus\Core\Autoloader;
			
	/**
	 * Class that represents a dependencies factory
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
		private static $dependencyObjectsCache = [];
		
		
		/* PUBLIC FUNCTIONS*/
		
		/**
		 * Get dependency by interface name.
		 *
		 * @param string $interface The interface name.
		 * @return Dependency|NULL Found Dependency object or null.
		 */
		public static function GetDependencyByInterface($interface, $module = null, $useCache = false)
		{
			$source = $useCache === false ? self::$dependencies : self::$dependencyObjectsCache;
			foreach($source as $dependency)
			{
				$dependencyModule = $dependency->getModule();
				if(isset($module) and ($dependency->getInterface() === $interface) and isset($dependencyModule) and $dependencyModule->getName() === $module)
				{
					return $dependency;
				}
				elseif(!isset($module) and ($dependency->getInterface() === $interface))
				{
					return $dependency;
				}
			}
			return null;
		}
		
		/**
		 * Resolves an IoC dependency and returns an instance of resolved class.
		 *
		 * @param string $interface The IoC interface to resolve.
		 * @param string $module The module for which interface should be resolved. Optional. Default is null.
		 * @param bool $newInstance Determine whether IoC shoul create a new instance even it is found in the dependencies cache.
		 * @throws SpherusException When $interface parameter cannot be resolved.
		 * 
		 * @return mixed Found instantiated class
		 */
		public static function Resolve($interface, $module = null, $newInstance = false)
		{
			Check::IsNullOrEmpty($interface);
			
			$foundDependency = self::GetDependencyByInterface($interface, $module);
			if(!isset($foundDependency))
			{
				throw new SpherusException(printf(EXCEPTION_DEPENDENCY_COULD_NOT_BE_RESOLVED, $interface));
			}
			
			if($newInstance === false)
			{
				$foundObject = self::GetDependencyByInterface($interface, $module, true);
				if(isset($foundObject))
				{
					return $foundObject;
				}
			}
			
			$fileObject = self::CreateObject($foundDependency->getClass());
			
			if(self::GetDependencyByInterface($interface, $module, true) === null)
			{
				self::$dependencyObjectsCache[] = $fileObject;
			}
			
			return $fileObject;
		}
		
		/**
		 * Register dependency in the dependencies array.
		 * 
		 * @param Dependency $dependency The Dependency object to register.
		 * @throws SpherusException When $dependency parameter is not an instance of Dependency class.
		 */
		public static function RegisterDependency(Dependency $dependency)
		{
			$filePath = $dependency->getFilePath();
			if(isset($filePath))
			{
				Autoloader::AddPath($filePath);
			}
			
			self::$dependencies[] = $dependency;
		}
		
		/* PRIVATE FUNCTIONS */
		
		/**
		 * Creates an instance of object with all subobjects in constructor.
		 * 
		 * @param string $fileClass The file class name.
		 * 
		 * @throws SpherusException When the dependency could not be resolved.
		 * 
		 * @return object Resolved object.
		 */
		private static function CreateObject($fileClass)
		{
			$reflectionClass = new \ReflectionClass($fileClass);
			if(isset($reflectionClass))
			{
				$parameterObjects = [];
				$constructor = $reflectionClass->getConstructor();
				if(isset($constructor))
				{
					$params = $constructor->getParameters();
					foreach ($params as $parameter)
					{
						$constructorParameter = $parameter->getClass();
						if(isset($constructorParameter))
						{
							$parameterObjects[] = self::CreateObject($constructorParameter->getName());
						}
						else 
						{
							$parameterObjects[] = self::Resolve($parameter->getName());
						}
					}
				}
				
				return $reflectionClass->newInstanceArgs($parameterObjects);
			}
			
			throw new SpherusException(printf(EXCEPTION_DEPENDENCY_COULD_NOT_BE_RESOLVED, $fileClass));
		}
	}