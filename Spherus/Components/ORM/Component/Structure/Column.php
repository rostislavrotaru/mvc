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
 * Class that represents column entity for SPHERUS Framework
 * 
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.components.orm
 */
class Column extends MappedEntity
{
    
    /* CONSTRUCTOR */
    
    /**
    * Initializes a new instance of Column class.
    * 
    * @param string $name The column name
    * @param string $storeName The store column name
    */
    public function __construct($name, $storeName)
    {
        parent::__construct(EntityType::Table, $name, $storeName);
    }
    
    
    /* FIELDS */
    
    /**
     * Defines the column type
     * @var string 
     */
    private $columnType = null;
	
    
    /* PROPERTIES */
	
	/**
	 * Gets the column type
     * @var string
     */
    public function getColumnType()
    {
        return $this->columnType;
    }

	/**
	 * Sets the column type
     * @param string $columnType The column type to set.
     */
    public function setColumnType($columnType)
    {
        $this->columnType = $columnType;
    }

    
}