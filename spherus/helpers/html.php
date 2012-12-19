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
			 * Javascript tags list. Stores all javascript files links till the moment that will be used.
			 * @var array
			 */
			private static $jsTagList = array();
					
			
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
			 * Gets JS include string if it was not included already
			 * 
			 * @param string $filePath path to file
			 */
			private static function JavaScriptProcess($filePath)
			{	    
			    $jsString = self::GetTag('script', array('type' => 'text/javascript', 'src' => $filePath.'.js'));
	        	if (!in_array($jsString, self::$jsTagBuffer))
				{
					self::$jsTagBuffer[] = $jsString;
					return $jsString;
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
			 * Includes CSS file by generating appropriate link tag
			 * 
			 * @param string $fileName path to the CSS file
			 */
			public static function Css($fileName)
			{			    
			    require_once(CORE.'pageprocessor.php');
			    PageProcessor::AddCssLink($fileName);
			}
			
			/**
			 * Includes JavaScript file by generating appropriate script tag
			 * 
			 * @param string|array $pathToFile path to the JavaScript file
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