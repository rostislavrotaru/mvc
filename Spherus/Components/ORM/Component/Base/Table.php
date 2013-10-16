<?php

/**
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright SPHERUS (http://spherus.net)
 * @license http://license.spherus.net
 * @link http://spherus.net
 * @since 3.0
 */
namespace Spherus\Components\ORM\Base;

use Spherus\Components\ORM\Component\Enums\EntityType;
use Spherus\Core\Check;
use Spherus\Core\SpherusException;

/**
 * Class that represents base orm entity for SPHERUS Framework
 * 
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.components.orm
 */
class Table extends Entity
{
    
    /* CONSTRUCTOR */
    
    /**
    * Initializes a new instance of Table class.
    * 
    * @param string $name The table name
    * @throws SpherusException When $name parameter is not set.
    */
    public function __construct($name)
    {
        Check::IsNullOrEmpty($name);
        
        parent::__construct(EntityType::Table);
        $this->name = $name;
    }
    
    
    /* FIELDS */
		
	/**
	 * Defines the table name
	 * @var string
	 */
	private $name = null;

	
	/* PROPERTIES */

	/**
	 * @return Gets the table name.
	 * 
	 * @var string
	 */
	public function getName() 
	{
		return $this->name;
	}
    
    
}