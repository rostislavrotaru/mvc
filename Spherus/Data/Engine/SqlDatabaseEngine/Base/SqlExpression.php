<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Data\Engine\SqlDatabaseEngine\Expressions;
					
	use Spherus\Data\Engine\SqlDatabaseEngine\Base\SqlEntity;
	use Spherus\Data\Engine\SqlDatabaseEngine\Enums\SqlEntityType;
		
	/**
     * Class that represents the base class for all sql expression
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
	class SqlExpression extends SqlEntity
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of SqlExpression class.
		 * 
		 * @param SqlEntityType $sqlEntityType The type of sql entity.
		 */
		public function __construct(SqlEntityType $sqlEntityType)
		{
			parent::__construct($sqlEntityType);
		}
		
	}

?>