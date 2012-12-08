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
		 * Defines interface that all modules should implement
		 *
		 * @author Rostislav Rotaru
		 * @package spherus.interfaces
		 * @version 3.0
		 *
		 */
		interface IModule
		{
			
			//Methods that should be implemeted in module.php file for each module
			
			/**
			 * Permits to write custom functionality when module is loaded 
			 */
			function Run();
			
			/**
			 * Gets module name
			 * @return string 
			 */
			function GetModuleName();
			
			/**
			 * Gets module namestace name
			 * @return string
			 */
			function GetNamespaceName();
		}
	}

?>