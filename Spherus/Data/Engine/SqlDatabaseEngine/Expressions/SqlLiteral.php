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
					
	use Spherus\Data\Engine\SqlDatabaseEngine\Enums\SqlEntityType;
	use Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlCompiler;
	
	/**
     * Class that represents a sql literal type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
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
		 * @param ISqlCompiler $visitor The visitor as ISqlCompiler.
		 */
		public function AcceptVisitor(ISqlCompiler $visitor)
		{
			$visitor->VisitLiteral($this);
		}
	
	}

?>