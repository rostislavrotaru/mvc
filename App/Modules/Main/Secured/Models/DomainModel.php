<?php
	
	namespace App\Modules\Main\Secured\Models;
	
	use App\Common\Config;
	use Spherus\Components\ORM\Component\SqlModel\ModelEntities;
	use Spherus\Components\DATA\Component\Enums\DatabaseProviderType;
	use Spherus\Components\Data\Component\DatabaseConfig;
								
	class DomainModel extends ModelEntities
	{
		public function __construct()
		{
			parent::__construct('DomainModel', 
					DatabaseProviderType::MySql, 
					new DatabaseConfig(
							Config::$domainModelConfig['host'], 
							Config::$domainModelConfig['port'], 
							Config::$domainModelConfig['database'], 
							Config::$domainModelConfig['user'],
							Config::$domainModelConfig['password']));

			$this->InitializeModel();

		}
		
		private function InitializeModel()
		{
			$this->AddModel(new User('User'));
		}
	}