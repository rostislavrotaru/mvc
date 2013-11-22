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
     * Class that represents the base class for all ORM expressions
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
	class ORMExpression extends ORMEntity
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of ORMExpression class.
		 * 
		 * @param string $entityType The type of orm entity. Uses EntityType enum.
		 */
		public function __construct($entityType)
		{
			parent::__construct($entityType);
		}
		
	}