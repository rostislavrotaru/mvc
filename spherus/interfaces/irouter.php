<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/

	namespace Spherus\Interfaces
	{
	    
		/**
		* Defines interface that all routers should implement
		*
		* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		* @package spherus.interfaces
		*/
		interface IRouter
		{
			/**
			 * Parses given url into route (module, controller, action and parameters).
			 * 
			 * @param string $url. Given url to parse.
			 */
			function Parse($url);			
		}
	}

?>