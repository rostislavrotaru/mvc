<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlModel\Expressions;
					
	use Spherus\Components\ORM\Component\SqlModel\Enums\OrderType;
	use Spherus\Components\ORM\Component\SqlModel\Base\ORMExpression;
	use Spherus\Components\ORM\Component\SqlModel\Enums\EntityType;
										
	/**
     * Class that represents a ORMOrder expression type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class ORMOrder extends ORMExpression
	{
		
		/*CONSTRUCTOR*/
		
		/**
		 * Initializes a new instance of ORMOrder class.
		 * 
		 * @param ORMExpression $expression The ordered ORM expression.
		 * @param OrderType $orderType The ORM order type.
		 */
		public function __construct($expression, $orderType = OrderType::Ascending)
		{
			parent::__construct(EntityType::Order);
			
			$this->expression = $this->CheckIsLiteral($expression);
			$this->orderType = $orderType;
		}
		
		
		/* FIELDS */
		
		/**
		 * Contains order ORM expression.
		 * @var ORMExpression
		 */
		private $expression = null;
		
		/**
		 * Determine the ORM order type
		 * @var OrderType
		 */
		private $orderType = OrderType::Ascending;
		
		
		/* PROPERTIES */
		
		/**
		 * @return the $sqlExpression
		 */
		public function getExpression() 
		{
			return $this->expression;
		}

		/**
		 * @return the $orderType
		 */
		public function getOrderType() 
		{
			return $this->orderType;
		}
		
		/* PUBLIC METHODS */
		
		/**
		 * Accepts visitor for the current ORM object.
		 * 
		 * @param ORMCompiler $visitor The visitor as ORMCompiler.
		 */
		public function AcceptVisitor($visitor)
		{
			$visitor->VisitOrderBy($this);
		}

		
	}