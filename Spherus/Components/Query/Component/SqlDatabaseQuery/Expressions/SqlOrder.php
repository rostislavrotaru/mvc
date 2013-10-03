<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions;
					
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Base\SqlExpression;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlEntityType;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
	use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlOrderType;
		
		/**
     * Class that represents a sql literal expression type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlOrder extends SqlExpression
	{
		
		/*CONSTRUCTOR*/
		
		/**
		 * Initializes a new instance of SqlOrder class.
		 * 
		 * @param SqlExpression $sqlExpression The ordered sql expression.
		 * @param SqlOrderType $sqlOrderType The the sql order type.
		 */
		public function __construct($sqlExpression, $sqlOrderType = SqlOrderType::Ascending)
		{
			parent::__construct(SqlEntityType::Order);
			
			$this->sqlExpression = $this->CheckIsLiteral($sqlExpression);
			$this->sqlOrderType = $sqlOrderType;
		}
		
		
		/* FIELDS */
		
		/**
		 * Contains order sql expression.
		 * @var SqlExpression
		 */
		private $sqlExpression = null;
		
		/**
		 * Determine the sql order type
		 * @var SqlOrderType
		 */
		private $sqlOrderType = SqlOrderType::Ascending;
		
		
		/* PROPERTIES */
		
		/**
		 * @return the $sqlExpression
		 */
		public function getSqlExpression() 
		{
			return $this->sqlExpression;
		}

		/**
		 * @return the $sqlOrderType
		 */
		public function getSqlOrderType() 
		{
			return $this->sqlOrderType;
		}
		
		/* PUBLIC METHODS */
		
		/**
		 * Accepts visitor for the current sql object.
		 * 
		 * @param SqlCompiler $visitor The visitor as SqlCompiler.
		 */
		public function AcceptVisitor($visitor)
		{
			$visitor->VisitOrderBy($this);
		}

		
	}

?>