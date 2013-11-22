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
																		
	use Spherus\Components\ORM\Component\SqlModel\Base\ORMExpression;
	
	/**
     * Class that represents an ORM binary expressions
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class ORMBinary extends ORMExpression
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of SqlBinary class.
		 * 
		 * @param string $entityType The type of sql entity.
		 * @param ORMExpression $leftExpression The left expression.
		 * @param ORMExpression $rightExpression The right expression.
		 */
		public function __construct($entityType, $leftExpression,  $rightExpression)
		{
			parent::__construct($entityType);

			$this->leftExpression = $this->CheckIsLiteral($leftExpression);
			$this->rightExpression = $this->CheckIsLiteral($rightExpression);

// 			if ($rightExpression instanceof SqlStatement || $entityType === SqlEntityType::In  || $entityType === SqlEntityType::NotIn)
// 			{
// 			    $this->rightExpression = SqlFactory::SubQuery($this->rightExpression);
// 			}
		} 
		
		/* FIELDS */
		
		/**
		 * Represents the ORM binary left expression
		 * @var ORMExpression
		 */
		private $leftExpression = null;
		
		/**
		 * Represents the ORM binary right expression
		 * @var ORMExpression
		 */
		private $rightExpression = null;
	
	
		/* PROPERTIES */
		
		/**
		 * @return the $leftExpression
		 */
		public function getLeftExpression() 
		{
			return $this->leftExpression;
		}
	
		/**
		 * @return the $rightExpression
		 */
		public function getRightExpression() 
		{
			return $this->rightExpression;
		}

		
		/* PUBLIC METHODS */
		
		/**
		 * Accepts visitor for the current ORM object.
		 * 
		 * @param ORMCompiler $visitor The visitor as ORMCompiler.
		 */
		public function AcceptVisitor($visitor)
		{
			$visitor->VisitBinary($this);
		}
		
	}