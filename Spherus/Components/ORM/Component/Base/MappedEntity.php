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

use Spherus\Core\Check;
use Spherus\Core\SpherusException;

/**
 * Class that represents a mapped entity for SPHERUS Framework
 * 
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.components.orm
 */
class MappedEntity extends Entity
{
    
    /* CONSTRUCTOR */
    
    /**
    * Initializes a new instance of MappedEntity class.
    * 
    * @param string $entityType The type of orm entity.
    * @param string $name The entity name
    * @param string $storeName The entity name
    * @throws SpherusException When $name parameter is not set.
    * @throws SpherusException When $storeName parameter is not set.
    */
    public function __construct($entityType, $name, $storeName)
    {
        Check::IsNullOrEmpty($name);
        Check::IsNullOrEmpty($storeName);
        
        parent::__construct($entityType);
        $this->name = $name;
        $this->storeName = $storeName;
    }
    
    
    /* FIELDS */
		
	/**
	 * Defines the mapped entity name
	 * @var string
	 */
	private $name = null;
	
	/**
	 * Defines the mapped entity name
	 * @var string
	 */
	private $storeName = null;
	

	/* PROPERTIES */

	/**
	 * @return Gets the mapped entity name.
	 * 
	 * @var string
	 */
	public function getName() 
	{
		return $this->name;
	}
	
	/**
	 * @return Gets the mapped entity store name.
	 *
	 * @var string
	 */
	public function getStoreName()
	{
	    return $this->storeName;
	}

}