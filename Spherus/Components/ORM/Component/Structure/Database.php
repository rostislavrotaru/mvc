<?php

/**
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright SPHERUS (http://spherus.net)
 * @license http://license.spherus.net
 * @link http://spherus.net
 * @since 3.0
 */
namespace Spherus\Components\ORM\Structure;

use Spherus\Components\ORM\Component\Enums\EntityType;
use Spherus\Components\ORM\Base\MappedEntity;

/**
 * Class that represents database entity for SPHERUS Framework
 * 
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.components.orm
 */
class Database extends MappedEntity
{
    
    /* CONSTRUCTOR */
    
    /**
    * Initializes a new instance of Table class.
    * 
    * @param string $name The table name
    * @param string $storeName The store table name
    */
    public function __construct($name, $storeName)
    {
        parent::__construct(EntityType::Database, $name, $storeName);
    }
  
}