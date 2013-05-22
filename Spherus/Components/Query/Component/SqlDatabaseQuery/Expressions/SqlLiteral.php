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
     * Class that represents a sql literal expression type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
	class SqlLiteral extends SqlExpression
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of SqlLiteral class.
		 * 
		 * @param string $value The literal value.
		 */
		public function __construct($value)
		{
			parent::__construct(SqlEntityType::Literal);
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
		
		/**
		 * Accepts visitor for the current sql entiry.
		 * 
		 * @param SqlCompiler $visitor The visitor as SqlCompiler.
		 */
		public function AcceptVisitor(SqlCompiler $visitor)
		{
			$visitor->VisitLiteral($this);
		}
	
	}

?>