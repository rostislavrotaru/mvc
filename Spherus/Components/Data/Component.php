<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Data;

	use Spherus\Core\Base\SystemComponentBase;
	
	/**
	 * Class that represents data engine component for SPHERUS Framework
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.data
	 */
	class Component extends SystemComponentBase
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of Component class.
		 */
		public function __construct()
		{
			$this->SetComponentAttributes();
			
		}
		
		
		/* PRIVATE FUNCTIONS */
		
		/**
		 * Sets component Author, Description, Name and other attributes.
		 */
		private function SetComponentAttributes()
		{
			$this->setAuthor('SPHERUS');
			$this->setDescription('Data engine component for framework');
			$this->setName('Data');
			$this->setVersion('1.0.0.0');
		}
	}