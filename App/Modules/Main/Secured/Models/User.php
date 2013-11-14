<?php
	
	namespace App\Modules\Main\Secured\Models;
	
	use Spherus\Components\ORM\Component\SqlModel\Model;
	use Spherus\Components\ORM\Component\SqlModel\Property;
	use Spherus\Components\ORM\Component\Enums\PropertyType;
			
	class User extends Model
	{
		public function __construct()
		{
			parent::__construct('User');
			$this->InitializeModel();
		}
		
		private function InitializeModel()
		{
			$idProperty = new Property('Id', 'user_id');
			$idProperty
			->setType(PropertyType::Integer)
			->setIsEntityKey(true);
				
			$nameProperty = new Property('Name', 'user_name');
				
			
			$this->AddProperty($idProperty);
			$this->AddProperty($nameProperty);
		}
	}