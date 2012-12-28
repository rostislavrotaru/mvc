<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/

	namespace Spherus\Core
	{

		/**
		* Class that represents the base for all exceptions
		*
		* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		* @package spherus.core
		*/
		class SpherusException extends \Exception
		{
			/**
			 * Initializes a new instance of SpherusException class
			 * 
			 * @param string $message The exception message
			 * @param strinf $code The exception code
			 * @param Exception $internalException The internal exception
			 */
			function __construct($message, $code = null, $internalException = null)
			{
				parent::__construct($message, $code, $internalException);
			}			
		}
		
		
		//Exception constants
		define('EXCEPTION_NULL', 'Null value reference');
		define('EXCEPTION_NULL_OR_EMPTY', 'Null or empty value provided');
		define('EXCEPTION_INVALID_ARRAY', 'Given value is not an array value');
		define('EXCEPTION_DEFAULT_ROUTE_NOT_FOUND', 'Default route not found');
		define('EXCEPTION_INVALID_ROUTER_CONFIG', 'Invalid configuration for router definition');
		define('EXCEPTION_EMPTY', 'Empty value provided');
		define('EXCEPTION_ACCESS_DENIED', 'Access to this resource is denied');
		define('EXCEPTION_CONTROLLER_NOT_FOUND', 'The "%s" controller not found');
		define('EXCEPTION_MODULE_NOT_FOUND', 'The "%s" module not found');
		define('EXCEPTION_LAYOUT_NOT_FOUND', 'The "%s" layout not found');
		define('EXCEPTION_HELPER_NOT_FOUND', 'The "%s" helper not found');
		define('EXCEPTION_FILE_NOT_READABLE', 'The "%s" file is not readable. Please check file system permissions');
		define('EXCEPTION_FILE_NOT_EXISTS', 'The given file does not exists: "%s"');
		define('EXCEPTION_NO_ROUTE_TO_REDIRECT', 'No Route to redirect found');
		define('EXCEPTION_DUPLICATE_ROUTE', 'The route "%s" already exists and cannot be registsred.');
		define('EXCEPTION_INVALID_INTEGER', 'Given value is not a valid integer value');
		define('EXCEPTION_DUPLICATE_MODULE', 'An module with the same name already exists');
		define('EXCEPTION_APP_CONFIG_NOT_FOUND', 'The application configuration file not found');
		define('EXCEPTION_NO_CONTROLLER_ACTION_METHOD', 'The function "%s" does not exists in controller "%s" in module "%s"');
		define('EXCEPTION_OBJECT_INVALID_INSTANCE', 'The "%s" object is not a valid instance of "%s"');
		define('EXCEPTION_NOT_OBJECT', 'The "%s" value is not an object instance');
	
	}

?>