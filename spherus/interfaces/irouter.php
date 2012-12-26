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
			 * Parses url from Request::getCurrentUrl() into route (module, controller, action and parameters).
			 */
			function Parse();	

			/**
			 * This function is called after router object is created.
			 */
			function Initialize();
		
		}
	}

?>