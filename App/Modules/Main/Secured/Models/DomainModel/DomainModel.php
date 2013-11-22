<?php
	
	namespace App\Modules\Main\Secured\Models;
	
	use App\Common\Config;
	use Spherus\Components\ORM\Component\SqlModel\ModelEntities;
	use Spherus\Components\DATA\Component\Enums\DatabaseProviderType;
	use Spherus\Components\Data\Component\DatabaseConfig;
	use Spherus\Components\ORM\Component\Enums\PropertyType;
								
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

		}
		
		public $schema = array
		(
			'Models'=>array
			(
				'User'=>array
				(
					'Name'=>'User',
					'EntitySetName'=>'Users',
					'TableName'=>'users',
					'Properties'=>array
					(
						'Id'=>array
						(
							'ColumnName'=>'user_id',
							'Type'=>PropertyType::Integer,
							'DefaultValue'=>null,
							'Required'=>true,
							'Length'=>0		
						),
						'Name'=>array
						(
							'ColumnName'=>'user_name',
							'Type'=>PropertyType::Varchar,
							'DefaultValue'=>null,
							'Required'=>true,
							'Length'=>0
						)
					),
					'NavigationProperties'=>array
					(
						'UserRoles'=>array
						(
							'table_name'=>'user_roles',
						)	
					)
				)
			)
		);
	}