<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlMode;
																																																																																																				    
	use Spherus\Components\ORM\Component\SqlModel\Statements\ORMSelect;
	use Spherus\Components\ORM\Component\SqlModel\Expressions\ORMBinary;
	use Spherus\Components\ORM\Component\SqlModel\Expressions\ORMUnary;
					
	/**
     * Class that represents the ORM compiler
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class ORMCompiler
    {		
		
		/* VISITOR METHODS*/
		
		/**
		 * Visits SELECT.
		 *
		 * @param ORMSelect $select The ORMSelect to visit
		 */
		public function VisitSelect(ORMSelect $select)
		{

		}
		
		/**
		 * Visits binary ORM expression.
		 *
		 * @param ORMBinary $entity The binary ORM expression to visit.
		 */
		public function VisitBinary(ORMBinary $entity)
		{

		}
    
		/**
		 * Visits unary expression.
		 *
		 * @param ORMUnary $entity The ORMUnary to visit.
		 */
		public function VisitUnary(ORMUnary $entity)
		{

		}
    
    }