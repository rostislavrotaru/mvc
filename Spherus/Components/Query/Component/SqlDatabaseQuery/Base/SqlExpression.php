<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Base;
					
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
	
	/**
     * Class that represents the base class for all sql expressions
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlExpression extends SqlEntity
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of SqlExpression class.
		 * 
		 * @param SqlEntityType $sqlEntityType The type of sql entity.
		 */
		public function __construct($sqlEntityType)
		{
			parent::__construct($sqlEntityType);
		}
		
	}

?>