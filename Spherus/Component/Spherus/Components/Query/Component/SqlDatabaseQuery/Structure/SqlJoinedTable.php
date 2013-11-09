<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Structure;
			
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Expressions\SqlJoin;
    use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\SqlCompiler;
										
	/**
     * Class that represents a sql joined table entity
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlJoinedTable extends SqlTable
    {

    /* CONSTRUCTOR */

    /**
     * Initializes a new instance of SqlJoinedTable class.
     *
     * @param SqlJoin $join The initiated SqlJoin object.
     */
    public function __construct($join)
    {
        $this->join = $join;
    }


    /* FIELDS */

    /**
     * Represents the table join object
     * @var SqlJoin
     */
    private $join = null;


    /* PROPERTIES */

    /**
     * @return the $join
     */
    public function getJoin()
    {
        return $this->join;
    }


    /* PUBLIC METHODS */

    /**
     * Accepts visitor for the current sql entity.
     *
     * @param SqlCompiler $visitor The visitor as SqlCompiler.
     */
    public function AcceptVisitor(SqlCompiler $visitor)
    {
        $visitor->VisitJoinedTable($this);
    }

}