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

use Spherus\Core\Base\SystemComponentBase;
use Spherus\Core\Check;
use Spherus\Core\SpherusException;

/**
 * Class that represents base orm entity for SPHERUS Framework
 * 
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.components.orm
 */
class Entity extends SystemComponentBase
{
    
    /* CONSTRUCTOR */
    
    /**
    * Initializes a new instance of Entity class.
    * 
    * @param string $entityType The type of orm entity.
    * @throws SpherusException When $entity type parameter is not set.
    */
    public function __construct($entityType)
    {
        Check::IsNullOrEmpty($entityType);
        $this->entityType = $entityType;
    }
    
    
    /* FIELDS */
		
	/**
	 * Defines the orm entity type.
	 * @var string
	 */
	private $entityType = null;

	
	/* PROPERTIES */

	/**
	 * @return Gets the orm entity type.
	 * 
	 * @var string
	 */
	public function getEntityType() 
	{
		return $this->entityType;
	}
     
}