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

	use Spherus\Core\SpherusException;
		
	/**
	 * Class that represents functionality for inversion of control
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.ioc
	 */
	class IoC
	{
		
		/* PUBLIC FUNCTIONS */
		
		/**
		 * Register an IoC dependency
		 * 
		 * @param Dependency $dependency The initialized dependency class object.
		 * @param bool $overwrite Determine if an existing dependency will be overrited if found. Optional. Default is false.
		 * 
		 * @throws SpherusException When $dependency object is not an instance of Dependency class.
		 */
		public static function Register(Dependency $dependency, $overwrite = false)
		{
			$foundDependency = DependencyFactory::GetDependencyByInterface($dependency->getInterface());
			if(!isset($foundDependency) or $overwrite === true)
			{
				return DependencyFactory::Register($dependency);
			}
			
			throw new SpherusException(printf(EXCEPTION_DUPLICATE_DEPENDENCY, $dependency->getInterface()));
		}
		
		/**
		 * Resolves an IoC dependency and returns an instance of resolved class.
		 *
		 * @param string $interface The IoC interface to resolve.
		 * @param string $module The module for which interface should be resolved. Optional. Default is null.
		 * @param bool $newInstance Determine whether IoC shoul create a new instance even it is found in the dependencies cache.
		 * @param array $parameters An array of parameters that will be transmitted to the constructor (as last parameters).
		 * 
		 * @return mixed Found instantiated class
		 */
		public static function Resolve($interface, $module = null, $newInstance = false, $parameters = null)
		{
			return DependencyFactory::Resolve($interface, $module, $newInstance, $parameters);
		}
	}
