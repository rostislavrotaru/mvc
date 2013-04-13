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

	use Spherus\IoC\IoC;
	use Spherus\IoC\Dependency;
	use Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator;
	
				/**
	 * Class that represents the Application base configuration
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core
	 */
	abstract class SpherusConfig
	{

		/* FIELDS */

		/**
		 * Defines the default application theme.
		 * Can be overwritten in Application Configuration file.
		 *
		 * @var string
		 */
		private static $defaultTheme = 'default';

		/**
		 * Defines the default application layout.
		 * Can be overwritten in Application Configuration file.
		 *
		 * @var string
		 */
		private static $defaultLayout = 'default';

		/**
		 * Defines defaults for routing if not specified.
		 * Can be overwritten in Application Configuration file.
		 *
		 * @var array
		 */
		private static $routingDefaults = array
		(
			'module' => 'main',
			'controller' => 'home',
			'action' => 'index',
			'router' => 'Spherus\Routing\DefaultRouter',
			'default_route' => '/:controller/:action/*'
		);

		/* PROPERTIES */

		/**
		 * Gets the default application theme.
		 *
		 * @return string
		 */
		public static function getDefaultTheme()
		{
			return self::$defaultTheme;
		}

		/**
		 * Sets the default application theme name.
		 *
		 * @param string The default theme name
		 * @throws SpherusException When $defaultTheme parameter is null or
		 *         empty.
		 */
		public static function setDefaultTheme($defaultTheme)
		{
			Check::IsNullOrEmpty($defaultTheme);
			self::$defaultTheme = $defaultTheme;
		}

		/**
		 * Gets the default application layout.
		 *
		 * @return string
		 */
		public static function getDefaultLayout()
		{
			return self::$defaultLayout;
		}

		/**
		 * Sets the default application layout.
		 *
		 * @param string The default layout name
		 * @throws SpherusException When $defaultLayout parameter is null or
		 *         empty.
		 */
		public static function setDefaultLayout($defaultLayout)
		{
			self::$defaultLayout = $defaultLayout;
		}

		/**
		 * Gets routing defaults.
		 *
		 * @return array
		 */
		public static function getRoutingDefaults()
		{
			return self::$routingDefaults;
		}

		/* PUBLIC METHODS */

		/**
		 * Initializes base functionality of Application configuration.
		 * Can be overwritten in Application Configuration file.
		 */
		public static function Initialize()
		{
			self::RegisterIoCDependencies();
		}

		/**
		 * Sets default routing value for a specified key.
		 *
		 * @param string $key The routing default key.
		 * @param mixed $value The routing default value.
		 * @throws SpherusException When $key parameter is null or empty.
		 * @throws SpherusException When self::$routingDefaults is null.
		 */
		public static function SetRoutingDefaults($key, $value)
		{
			Check::IsNullOrEmpty($key);
			Check::IsNull(self::$routingDefaults);

			self::$routingDefaults[$key] = $value;
		}
	
		
		/* PUBLIC METHODS */
		
		private static function RegisterIoCDependencies()
		{
			IoC::Register(new Dependency('Spherus\Data\Engine\SqlDatabaseEngine\ISqlDatabaseEngine', 'Spherus\Data\Engine\SqlDatabaseEngine\SqlDatabaseEngine', null, true));
			IoC::Register(new Dependency('Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator', 'Spherus\Data\Engine\SqlDatabaseEngine\Compiler\MySQL\MySQLTranslator', null, true));
			IoC::Register(new Dependency('Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlCompiler', 'Spherus\Data\Engine\SqlDatabaseEngine\Compiler\MySQL\MySQLCompiler', null, true));
			IoC::Register(new Dependency('Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlCompilerContext', 'Spherus\Data\Engine\SqlDatabaseEngine\Compiler\SqlCompilerContext', null, true));
			
			/* @var $rrrr ISqlTranslator */
			$databaseEngine = IoC::Resolve('Spherus\Data\Engine\SqlDatabaseEngine\ISqlDatabaseEngine');
		}
	
	}