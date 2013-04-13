<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Data\Engine\SqlDatabaseEngine\Base;
	
	
	use Spherus\Data\Engine\SqlDatabaseEngine\Enums\SqlEntityType;
	use Spherus\Data\Engine\SqlDatabaseEngine\Expressions\SqlLiteral;
		
	/**
	 * Represents any object in Sql expression tree.
	 * 
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
	class SqlEntity
	{
		
		/* CONSTRUCTORS */
		
		/**
		 * Initializes a new instance of SqlObject class.
		 * 
		 * @param SqlObjectType $objectType The sql type of object
		 */
		public function __construct(SqlEntityType $sqlEntityType)
		{
			$this->sqlEntityType = $sqlEntityType;
		}
		
		
		/* FIELDS */
		
		/**
		 * Defines the sql entity type.
		 * @var SqlEntityType
		 */
		private $sqlEntityType = null;
	
		
		/* PROPERTIES */
	
		/**
		 * @return the type of object.
		 * 
		 * @var SqlEntityType
		 */
		public function getSqlEntityType() 
		{
			return $this->sqlEntityType;
		}
		
		
		/* PUBLIC FUNCTIONS */
		
		/**
		 * Checks if given expression is SqlEntity or should encapsulate in literal expression.
		 * 
		 * @param mixed $expression The expression to check.
		 * @return Ambigous <SqlExpression, SqlLiteral>
		 */
		public function CheckIsLiteral($expression)
		{
			if (!is_a($expression, SqlEntity)) 
			{
				return new SqlLiteral($expression);
			}
			else
			{
				return $expression;
			}
		}
	}

?>