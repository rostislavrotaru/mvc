<?php

	namespace Spherus\Core
	{

		class SpherusException extends \Exception
		{
			function __construct($message, $code = null, $internalException = null)
			{
				parent::__construct($message, $code, $internalException);
			}			
		}
		
		define('EXCEPTION_NULL', 'Null value reference');
		define('EXCEPTION_NULL_OR_EMPTY', 'Null or empty value provided');
		define('EXCEPTION_INVALID_ARRAY', 'Given value is not an array value');
		define('EXCEPTION_DEFAULT_ROUTE_NOT_FOUND', 'Default route not found');
		define('EXCEPTION_ACCESS_DENIED', 'Access to this functionality is denied');
		define('EXCEPTION_CONTROLLER_NOT_FOUND', 'The "%s" controller not found');
		define('EXCEPTION_MODULE_NOT_FOUND', 'The "%s" module not found');
		define('EXCEPTION_LAYOUT_NOT_FOUND', 'The "%s" layout not found');
		define('EXCEPTION_FILE_NOT_READABLE', 'The "%s" file is not readable. Please check file system permissions');
		define('EXCEPTION_FILE_NOT_EXISTS', 'The given file does not exists: "%s"');
		define('EXCEPTION_NO_ROUTE_TO_REDIRECT', 'No Route to redirect found');
		define('EXCEPTION_INVALID_INTEGER', 'Given value is not a valid integer value');
		define('EXCEPTION_MODULE_WITH_THE_SAME_NAME_FOUND', 'An module with the same name already exists');
		define('EXCEPTION_APP_CONFIG_NOT_FOUND', 'The application configuration file not found');
		define('EXCEPTION_NO_CONTROLLER_ACTION_METHOD', 'The function "%s" does not exists in controller "%s" in module "%s"');
		define('EXCEPTION_OBJECT_INVALID_INSTANCE', 'The "%s" object is not a valid instance of "%s"');
		define('EXCEPTION_NOT_OBJECT', 'The "%s" value is not an object instance');
	
	}

?>