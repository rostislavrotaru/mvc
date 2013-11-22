<?php
	
	namespace App\Modules\Main\Secured\Models\DomainModel;
	
	use App\Common\Config;
	use Spherus\Components\DATA\Component\Enums\DatabaseProviderType;
	use Spherus\Components\Data\Component\DatabaseConfig;
	use Spherus\Components\ORM\Component\SqlModel\Enums\PropertyType;
	use Spherus\Components\ORM\Component\SqlModel\Enums\MultiplicityType;
	use Spherus\Components\ORM\Component\SqlModel\Enums\IndexType;
	use Spherus\Components\ORM\Component\SqlModel\Enums\OnActionType;
	use Spherus\Components\ORM\Component\SqlModel\DomainModel\ModelEntities;
											
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
						Config::$domainModelConfig['password']),
						isset(Config::$domainModelConfig['options']) ? Config::$domainModelConfig['options'] : null);

		}
		
		/**
		 * Defines the DomainModel schema
		 * @var array
		 */
		public $schema = array
		(
			'Models'=>array
			(
				'User'=>array
				(
					'EntitySetName'=>'Users',
					'TableName'=>'users',
					'Properties'=>array
					(
						'Id'=>array
						(
							'ColumnName'=>'user_id',
							'Type'=>PropertyType::BigInteger,
							'DefaultValue'=>null,
							'Required'=>true,
							'Length'=>0,
							'Autoincrement'=>true	
						),
						'Name'=>array
						(
							'ColumnName'=>'user_name',
							'Type'=>PropertyType::Varchar,
							'DefaultValue'=>null,
							'Required'=>true,
							'Length'=>0,
							'Autoincrement'=>false
						)
					),
					'NavigationProperties'=>array
					(
						'UserRoles'=>array
						(
							'Name'=>'FK_User_Roles_Users',
							'Model'=>'UserRole',
							'Multiplicity'=>MultiplicityType::Many,
							'OnDelete'=> OnActionType::Restrict,
							'OnUpdate'=> OnActionType::Restrict
						)
					),
				),
				'Role'=>array
				(
					'EntitySetName'=>'Roles',
					'TableName'=>'roles',
					'Properties'=>array
					(
						'Id'=>array
						(
							'ColumnName'=>'role_id',
							'Type'=>PropertyType::BigInteger,
							'DefaultValue'=>null,
							'Required'=>true,
							'Length'=>0,
							'Autoincrement'=>true
						),
						'Name'=>array
						(
							'ColumnName'=>'role_name',
							'Type'=>PropertyType::Varchar,
							'DefaultValue'=>null,
							'Required'=>true,
							'Length'=>0,
							'Autoincrement'=>false
						)
					),
					'NavigationProperties'=>array
					(
						'UserRoles'=>array
						(
							'Name'=>'FK_User_Roles_Roles',
							'Model'=>'UserRole',
							'Multiplicity'=>MultiplicityType::Many,
							'OnDelete'=> OnActionType::Restrict,
							'OnUpdate'=> OnActionType::Restrict
						)
					)
				),
				'UserRole'=>array
				(
					'EntitySetName'=>'UserRoles',
					'TableName'=>'user_roles',
					'Properties'=>array
					(
						'Id'=>array
						(
							'ColumnName'=>'user_role_id',
							'Type'=>PropertyType::BigInteger,
							'DefaultValue'=>null,
							'Required'=>true,
							'Length'=>0,
							'Autoincrement'=>true
						),
						'UserId'=>array
						(
							'ColumnName'=>'user_id',
							'Type'=>PropertyType::BigInteger,
							'DefaultValue'=>null,
							'Required'=>true,
							'Length'=>0,
							'Autoincrement'=>false
						),
						'RoleId'=>array
						(
							'ColumnName'=>'role_id',
							'Type'=>PropertyType::BigInteger,
							'DefaultValue'=>null,
							'Required'=>true,
							'Length'=>0,
							'Autoincrement'=>false
						)
					),
					'NavigationProperties'=>array
					(
						'User'=>array
						(
							'Name'=>'FK_User_Roles_Users',
							'Model'=>'User',
							'Multiplicity'=>MultiplicityType::One,
							'OnDelete'=> OnActionType::Restrict,
							'OnUpdate'=> OnActionType::Restrict
						),
						'Role'=>array
						(
							'Name'=>'FK_User_Roles_Roles',
							'Model'=>'Role',
							'Multiplicity'=>MultiplicityType::One,
							'OnDelete'=> OnActionType::Restrict,
							'OnUpdate'=> OnActionType::Restrict
						)
					)
				)
			),
			'Indexes'=>array
			(
				'PK_Users'=>array
				(
					'Type'=>IndexType::Primary,
					'Model'=>'User',
					'Properties'=> array('Id')
				),
				'PK_Users'=>array
				(
					'Type'=>IndexType::Primary,
					'Model'=>'Role',
					'Properties'=> array('Id')
				),
				'PK_User_Roles'=>array
				(
					'Type'=>IndexType::Primary,
					'Model'=>'UserRole',
					'Properties'=> array('Id')
				),
				'IX_User_Roles'=>array
				(
					'Type'=>IndexType::UniqueIndex,
					'Model'=>'UserRole',
					'Properties'=> array('UserId', 'RoleId')
				)
			)
		);
	}