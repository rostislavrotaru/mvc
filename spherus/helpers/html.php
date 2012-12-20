<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	* 
	*/

	namespace Spherus\Helpers
	{
	
		use Spherus\Core\PageProcessor;
		use Spherus\Core\SpherusException;
		use Spherus\Core\Context;
		use Spherus\Core\Check;

		/**
		 * HTML helper class. Used for HTML tags generation
		 * 
		 * @author Anton Perkin (anton.perkin@gmail.com)
		 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		 * @package spherus.helpers
		 */ 
		class HtmlHelper
		{
		    
		    /* VARIABLES */
			
			/**
			 * Javascript files list. Stores all javascript files links till the moment that will be used.
			 * @var array
			 */
			private static $jsFilesList = array();
			
			/**
			 * CSS files list. Stores all css files links till the moment that will be used.
			 * @var array
			 */
			private static $cssFilesList = array();
			
			
			/* COMMON PRIVATE METHODS */
	
			/**
			 * Converts html tag attribute to string 
			 * 
			 * @param string $name The html tag attribute name.
			 * @param string $value The html tag attribute value.
			 * 
			 * @throws SpherusException When the $name parameter is null or empty.
			 * @throws SpherusException When the $value parameter is null or empty.
			 * 
			 * @return string
			 */
			private static function HtmlTagAttributeToString($name, $value)
			{
				Check::IsNullOrEmpty($name);
			    Check::IsNullOrEmpty($value);
			    
				return ' '.$name.'="'.$value.'"';
			}    	
	    	
			/**
			 * Converts array of html attributes to string.
			 * 
			 * @param string|array $attributes tag attributes in string or $name=>$value format.
			 * @return string
			 */
			private static function HtmlTagAttributesToString($attributes)
			{
				if (is_array($attributes)) 
				{
					$attributesString = null;
					foreach ($attributes as $name=>$value)
					{
						$attributesString .= self::HtmlTagAttributeToString($name, $value);
					}
					
					return $attributesString;
				}
				else
				{
					return $attributes;
				}
			}

			/**
			 * Includes CSS file by generating appropriate link tag
			 *
			 * @param string $fileName path to the CSS file
			 * @throws SpherusException When $fileName is null or empty.
			 */
			private static function CssProcess($fileName)
			{
			    Check::IsNullOrEmpty($fileName);
			    if (!in_array($fileName, self::$cssFilesList))
			    {
			        self::$cssFilesList[] = $fileName;
			        return self::Link(array('type' => 'text/css', 'rel' => 'stylesheet', 'href' => $fileName));
			    }
			}
			
			/* COMMON PUBLIC METHODS */
			
			/**
			 * Returns a HTML tag with attributes(if any)
			 * 
			 * @param string $tag tag name
			 * @param string|array $attributes tag attributes
			 * @param string $value tag value
			 * 
			 * @throws SpherusException When $tag parameter is null or empty.
			 * @return string
			 */
			public static function HtmlTag($tag, $attributes = null, $value = null)
			{
			    Check::IsNullOrEmpty($tag);
			    return '<'.$tag.self::HtmlTagAttributesToString($attributes).'>'.$value.'</'.$tag.'>';
			}
			
			/**
			 * Generates 'link' tag
			 *
			 * @param string|array $attributes tag attributes
			 */
			public static function Link($attributes)
			{
			    return self::HtmlTag('link', $attributes);
			}
			
			/**
			 * Includes a single CSS file or an array of CSS files.
			 *
			 * @param string|array $fileName Path to a single CSS file or an array of CSS files.
			 * 
			 * @example 
			 * HtmlHelper::Css(file_path_and_name);
			 * HtmlHelper::Css(array(file_path_and_name_1, file_path_and_name_2));
			 */
			public static function Css($fileName)
			{
			    if (is_array($fileName))
			    {
			        foreach ($fileName as $file)
			        {
			            echo self::CssProcess($file);
			        }
			    }
			    else
			    {
			        echo self::CssProcess($fileName);
			    }
			}
			
			/**
			 * Includes JavaScript file by generating appropriate script tag
			 * 
			 * @param string $pathToFile path to the JavaScript file
			 */
			public static function JavaScript($pathToFile)
			{
			    if (is_array($pathToFile))
			    {
			        foreach ($pathToFile as $filePath)
			        {
			            self::Script('text/javascript', '', array('src' => $filePath.'.js'));
			        }
			    }
			    else
			    {
	    			self::Script('text/javascript', '', array('src' => $pathToFile.'.js'));
			    }		    
			}
			
		}
	
	}
?>