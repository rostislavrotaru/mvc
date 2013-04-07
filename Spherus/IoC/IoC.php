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
			Check::IsInstanceOf($dependency, 'Spherus\IoC\Dependency');
			
			$foundDependency = DependencyFactory::GetDependencyByInterface($dependency->getInterface());
			if(isset($foundDependency))
			{
				if($overwrite === true)
				{
					DependencyFactory::RegisterDependency($dependency);
				}
				else 
				{
					throw new SpherusException(printf(EXCEPTION_DUPLICATE_DEPENDENCY, $dependency->getInterface()));
				}
			}
			else 
			{
				DependencyFactory::RegisterDependency($dependency); 
			}
		}
		
		public static function Resolve($interface, $newInstance = false, $parameters = null)
		{
			$foundDependency = DependencyFactory::GetDependencyByInterface($interface);
			if(!isset($foundDependency))
			{
				throw new SpherusException(printf(EXCEPTION_DEPENDENCY_COULD_NOT_BE_RESOLVED, $interface));
			}

			return DependencyFactory::Resolve($foundDependency, $newInstance, $parameters);
		}
	}
