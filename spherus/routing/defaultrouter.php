<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/

	namespace Spherus\Routing
	{

		use Spherus\Interfaces\IRouter;

		/**
		* Defines a default router class. Used for standard routing.
		*
		* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		* @package spherus.routing
		*/
		class DefaultRouter implements IRouter
		{
			
		    /* PUBLIC METHODS */
		    
			/**
			 * Parses given url into route (module, controller, action and parameters).
			 * @param string $url. Given url to parse.
			 */
		    public function Parse($url)
    		{
        		
        	}

		}
	
	}

?>