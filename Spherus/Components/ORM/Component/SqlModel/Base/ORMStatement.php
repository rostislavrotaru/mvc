<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlModel\Base;
	
	/**
	 * Represents an ORM statement
	 * 
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
	class ORMStatement extends ORMEntity
	{
		/**
		 * Initializes a new instance of ORMStatement class.
		 *
		 * @param string $entityType The type of sql entity. Uses EntityTpe.
		 */
		public function __construct($entityType)
		{
			parent::__construct($entityType);
		}
	}