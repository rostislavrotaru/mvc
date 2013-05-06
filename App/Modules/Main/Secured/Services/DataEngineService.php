<?php

	namespace App\Modules\Main\Secured\Services;

	use Spherus\IoC\IoC;
	use Spherus\IoC\Dependency;
	use Spherus\Data\Engine\SqlDatabaseEngine\ISqlDatabaseEngine;
use Spherus\Common\Zip;
			
	class DataEngineService
	{
		public static function Test()
		{
			Zip::Unzip(__DIR__.'/Archive.zip');
			IoC::Register(new Dependency('Spherus\Data\Engine\SqlDatabaseEngine\ISqlDatabaseEngine', 'Spherus\Data\Engine\SqlDatabaseEngine\SqlDatabaseEngine', null, true));
			IoC::Register(new Dependency('Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator', 'Spherus\Data\Engine\SqlDatabaseEngine\Compiler\MySQL\MySQLTranslator', null, true));
			IoC::Register(new Dependency('Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlCompiler', 'Spherus\Data\Engine\SqlDatabaseEngine\Compiler\MySQL\MySQLCompiler', null, true));
			IoC::Register(new Dependency('Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlCompilerContext', 'Spherus\Data\Engine\SqlDatabaseEngine\Compiler\SqlCompilerContext', null, true));
			
			/* @var $databaseEngine ISqlDatabaseEngine */
			$databaseEngine = IoC::Resolve('Spherus\Data\Engine\SqlDatabaseEngine\ISqlDatabaseEngine');
			
		}	
	}