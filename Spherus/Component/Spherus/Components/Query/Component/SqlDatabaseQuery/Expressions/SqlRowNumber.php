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
						
	/**
     * Class that represents a sql row number expression
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlRowNumber extends SqlExpression
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of SqlRowNumber class.
		 * 
		 * @param mixed $orderBy The orderBy expression(s).
		 */
		public function __construct($orderBy = null)
		{
			parent::__construct(SqlEntityType::Order);
			
			$this->setOrderBy($orderBy);
		}
		
		
		/* FIELDS */
		
		/**
		 * Conatins the order by expressions collection
		 * @var array
		 */
		private $orderBy = array();
	

		/* PROPERTIES */
		
		/**
		 * @return the $orderBy Order expressions collection.
		 */
		public function getOrderBy() 
		{
			return $this->orderBy;
		}		
	
		/**
		 * Sets order by expression(s)
		 * 
		 * @param mixed $orderBy The order by expression(s)
		 */
		public function setOrderBy($orderBy)
		{
		    if(isset($orderBy))
		    {
    			if (is_array($orderBy))
    			{
    				foreach ($orderBy as $item)
    				{
    					$this->orderBy[] = $item;
    				}
    			}
    			else 
    			{
    				$this->orderBy[] = $orderBy;
    			}
		    }
		}
		
		
		/* PUBLIC METHODS */
		
		/**
		 * Accepts visitor for the current sql object.
		 * 
		 * @param SqlCompiler $visitor The visitor as SqlCompiler.
		 */
		public function AcceptVisitor($visitor)
		{
			$visitor->VisitRowNumber($this);
		}
		
	}