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

	use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlEntity;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
	
	/**
	 * Represents a sql statement
	 * 
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlStatement extends SqlEntity
	{
		/**
		 * Initializes a new instance of SqlStatement class.
		 *
		 * @param SqlEntityType $sqlEntityType The type of sql entity
		 */
		public function __construct(SqlEntityType $sqlEntityType)
		{
			parent::__construct($sqlEntityType);
		}
	}