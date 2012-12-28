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
		* Class that represents functionality for various checks
		*
		* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		* @package spherus.core
		*/
		class Check
		{
			
			/* METHODS */
			
			/**
			 * Check if given value is null
			 * 
			 * @param mixed $value The value to check
			 * @throws SpherusException When the $value parameter is null
			 */
			public static function IsNull($value)
			{
				if(is_null($value))
				{
					throw new SpherusException(EXCEPTION_NULL);
				}
			}
			
			/**
			 * Check if given value is null or empty
			 *
			 * @param mixed $value The value to check
			 * @throws SpherusException When the $value parameter is null or empty
			 */
			public static function IsNullOrEmpty($value)
			{
				if(!isset($value) || empty($value))
				{
					throw new SpherusException(EXCEPTION_NULL_OR_EMPTY);
				}
			}
			
			/**
			 * Check if given value is empty
			 *
			 * @param mixed $value The value to check
			 * @throws SpherusException When the $value parameter is empty
			 */
			public static function IsEmpty($value)
			{
			    if(empty($value))
			    {
			        throw new SpherusException(EXCEPTION_EMPTY);
			    }
			}
		
			/**
			 * Check if given value is a valid integer value
			 *
			 * @param int $value The value to check
			 * @throws SpherusException When the $value parameter is not a valid integer
			 */
			public static function IsInteger($value)
			{
				self::IsNullOrEmpty($value);
				
				if(!(is_int($value)))
				{
					throw new SpherusException(EXCEPTION_INVALID_INTEGER);
				}
			}
		
			/**
			 * Check if given value is a valid array value
			 *
			 * @param array $value The value to check
			 * @throws SpherusException When the $value parameter is not a valid array
			 */
			public static function IsArray($value)
			{
				if(!(is_array($value)))
				{
					throw new SpherusException(EXCEPTION_INVALID_ARRAY);
				}
			} 
		
			/**
			 * Check if file exists
			 *
			 * @param string $fileName The path and name of file
			 * @throws SpherusException When the file does not exists
			 */
			public static function FileExists($fileName)
			{
				if(!file_exists($fileName))
				{
					throw new SpherusException(sprintf(EXCEPTION_FILE_NOT_EXISTS, $fileName));
				}
			}
			
			/**
			 * Check if file is readable
			 *
			 * @param string $fileName The path and name of file
			 * @throws SpherusException When the file is not readable
			 */
			public static function FileIsReadable($fileName)
			{
				self::FileExists($fileName);
				
				if(!is_readable($fileName))
				{
					throw new SpherusException(sprintf(EXCEPTION_FILE_NOT_READABLE, $fileName));
				}
			}
			
			/**
			 * Checks if given value is an object instance.
			 * 
			 * @param mixed $object The object to check.
			 * 
			 * @throws SpherusException When the $object parameter is null or empty.
			 * @throws SpherusException When the $object parameter is not an object.
			 */
			public static function IsObject($object)
			{
				self::IsNullOrEmpty($object);
				
				if(!(is_object($object)))
				{
					throw new SpherusException(sprintf(EXCEPTION_NOT_OBJECT, get_class($object)));
				}
			}
			
			/**
			 * Check if given object is an instantiated object of given class.
			 * 
			 * @param mixed $object The object to check.
			 * @param mixed $instance The instance of class to compare.
			 * 
			 * @throws SpherusException When $object parameter is not an object.
			 * @throws SpherusException When given object is not an instance of $instance class.
			 */
			public static function IsInstanceOf($object, $instance)
			{
				self::IsObject($object);
				
				switch(true)
				{
					case is_subclass_of($object, $instance):
					case $object instanceof $instance:
						return true;
					default:
						throw new SpherusException(sprintf(EXCEPTION_OBJECT_INVALID_INSTANCE, get_class($object), $instance));
				}
			}
		}
	}

?>