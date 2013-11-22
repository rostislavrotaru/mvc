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
	use Spherus\Components\ORM\Component\SqlModel\Enums\EntityType;
		
		/**
     * Class that represents a ORM literal expression type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
	class ORMLiteral extends ORMExpression
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of ORMLiteral class.
		 * 
		 * @param string $value The literal value.
		 */
		public function __construct($value)
		{
			parent::__construct(EntityType::Literal);
			$this->value = $value;
		}
		
		
		/* FIELDS */
		
		/**
		 * Constains the Literal expression value.
		 * 
		 * @var string
		 */
		private $value = null;
		
		
		/* PROPERTIES */
	
		/**
		 * @return the Literal expression value.
		 */
		public function getValue() 
		{
			return $this->value;
		}
		
		
		/* PUBLIC METHODS */
		
// 		/**
// 		 * Accepts visitor for the current sql entiry.
// 		 * 
// 		 * @param SqlCompiler $visitor The visitor as SqlCompiler.
// 		 */
// 		public function AcceptVisitor(SqlCompiler $visitor)
// 		{
// 			$visitor->VisitLiteral($this);
// 		}
	
	}