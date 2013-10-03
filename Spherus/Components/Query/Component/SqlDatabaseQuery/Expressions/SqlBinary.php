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
		
	/**
     * Class that represents a sql binary expressions
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlBinary extends SqlExpression
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of SqlBinary class.
		 * 
		 * @param SqlEntityType $sqlEntityType The type of sql entity.
		 * @param SqlExpression $leftExpression The left expression.
		 * @param unknown_type $rightExpression The right expression.
		 */
		public function __construct(SqlEntityType $entityType, SqlExpression $leftExpression, SqlExpression $rightExpression)
		{
			parent::__construct($entityType->__toString());
			
			$this->leftExpression = $this->CheckIsLiteral($leftExpression);
			$this->rightExpression = $this->CheckIsLiteral($rightExpression);
		} 
		
		/* FIELDS */
		
		/**
		 * Represents the sql binary left expression
		 * @var SqlExpression
		 */
		private $leftExpression = null;
		
		/**
		 * Represents the sql binary right expression
		 * @var SqlExpression
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
		 * Accepts visitor for the current sql object.
		 * 
		 * @param SqlCompiler $visitor The visitor as SqlCompiler.
		 */
		public function AcceptVisitor($visitor)
		{
			$visitor->VisitBinary($this);
		}
		
	}

?>