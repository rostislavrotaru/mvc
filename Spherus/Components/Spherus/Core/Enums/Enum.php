<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */

	namespace Spherus\Core\Enums;

	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	
	/**
	 * Interface that represents the RequestType enum implementation
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core
	 */
	abstract class Enum
	{
	    
	    /* CONSTRUCTOR */
	    
	    /**
	     * Initializes a new instance of Enum class.
	     * 
	     * @param string $value The value to initialize the class.
	     * @throws SpherusException When $value parameter is null or empty.
	     */
	    final public function __construct($value)
	    {
	    	Check::IsNullOrEmpty($value);
	    	$this->value = $value;
	    }
	 
	    
	    /* FIELDS */
	    
	    /**
	     * The class value.
	     * 
	     * @var string
	     */
	    private $value = null;
	    
	    
	    /* FUNCTIONS */
	    
	    /**
	     * Override of __toString function
	     * 
	     * @return string
	     */
	    final public function __toString()
	    {
	        return $this->value;
	    }
	}
	
?>