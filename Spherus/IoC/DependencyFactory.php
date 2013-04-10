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
		 * @param ModuleBase $module the module to check if not null.
		 * @return Dependency|NULL Found Dependency object or null.
		 */
		public static function GetDependencyByInterface($interface, $module = null)
		{
			foreach(self::$dependencies as $dependency)
			{
				if($dependency->getInterface() !== $interface)
				{ 
					continue;
				}
				
				if(!isset($module))
				{
					return $dependency;
				}
				
				$dependencyModule = $dependency->getModule();
				if(isset($dependencyModule) and $dependencyModule->getName() === $module)
				{
					return $dependency;
				}
				
			}
			
			return null;
		}
		
		/**
		 * Get dependency by interface name from cache.
		 *
		 * @param string $interface The interface name.
		 * @param ModuleBase $module the module to check if not null.
		 * @return Dependency|NULL Found Dependency object or null.
		 */
		public static function GetDependencyByInterfaceFromCache($interface, $module = null)
		{
			foreach(self::$dependencyObjectsCache as $dependency)
			{
				if($dependency['interface'] !== $interface)
				{
					continue;
				}
		
				if(!isset($module))
				{
					return $dependency['object'];
				}
		
				if(isset($dependency['module']) and $dependency['module'] === $module)
				{
					return $dependency['object'];
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
		 * @ignore 
		 * 
		 * @return object Found instantiated class
		 */
		public static function Resolve($interface, $module = null, $newInstance = false)
		{
			Check::IsNullOrEmpty($interface);
			
			if(!$foundDependency = self::GetDependencyByInterface($interface, $module))
			{
				throw new SpherusException(printf(EXCEPTION_DEPENDENCY_COULD_NOT_BE_RESOLVED, $interface));
			}
			
			if($newInstance === false)
			{
				if(@$foundObject = self::GetDependencyByInterfaceFromCache($interface, $module))
				{
					return $foundObject;
				}
			}
			
			$fileObject = self::CreateObject($foundDependency->getClass());
			
			if(self::GetDependencyByInterfaceFromCache($interface, $module) === null)
			{
				self::$dependencyObjectsCache[] = array('interface'=>$interface, 'module'=>$module, 'object'=>$fileObject);
			}
			
			return $fileObject;
		}
		
		/**
		 * Register dependency in the dependencies array.
		 * 
		 * @param Dependency $dependency The Dependency object to register.
		 * @throws SpherusException When $dependency parameter is not an instance of Dependency class.
		 */
		public static function Register(Dependency $dependency)
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
			if(!$reflectionClass = new \ReflectionClass($fileClass))
			{
				throw new SpherusException(printf(EXCEPTION_DEPENDENCY_COULD_NOT_BE_RESOLVED, $fileClass));
			}
		
			if (!$constructor = $reflectionClass->getConstructor())
			{
				return $reflectionClass->newInstanceArgs(array());
			}
		
			$parameterObjects = [];
			foreach ($constructor->getParameters() as $parameter)
			{
				if(@$constructorParameter = $parameter->getClass())
				{
					$parameterObjects[] = self::CreateObject($constructorParameter->getName());
				}
				else
				{
					$parameterObjects[] = self::Resolve($parameter->getName());
				}
			}
			return $reflectionClass->newInstanceArgs($parameterObjects);
		}
	}