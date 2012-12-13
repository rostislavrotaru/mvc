<?php

	/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/

	namespace Spherus\Helpers
	{
	
		use Spherus\Core\SpherusException;

		use Spherus\Core\Check;

		/**
		 * HTML helper class. Used for xHTML/HTML5 compatible tags generation
		 * 
		 * @author Anton Perkin (anton.perkin@gmail.com)
		 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		 * @package spherus.helpers
		 */ 
		class HtmlHelper
		{
		    
		    /* VARIABLES */
		    
			/**
			 * CSS tag buffer
			 * @var array
			 */
			private static $cssTagBuffer = array();
			
			/**
			 * JS tag buffer
			 * @var array
			 */
			private static $jsTagBuffer = array();
					
			
			/* COMMON PRIVATE METHODS */
	
			/**
			 * Gets attribute string 
			 * 
			 * @param string $name attribute name
			 * @param string $value attribute value
			 * 
			 * @throws SpherusException When the $name attribute is null or empty
			 * @throws SpherusException When the $value attribute is null or empty
			 * 
			 * @return string
			 */
			protected static function GetAttributeString($name, $value)
			{
			    Check::IsNullOrEmpty($name);
			    Check::IsNullOrEmpty($value);
			    
				return ' '.$name.'="'.$value.'"';
			}    	
	    	
			/**
			 * Gets attributes string 
			 * 
			 * @param string|array $attributes tag attributes in string or $name=>$value format
			 * @return string
			 */
			protected static function GetAttributesString($attributes)
			{
				//checks whether the array was passed
				if (is_array($attributes)) 
				{
					$attributesString = null;
					foreach ($attributes as $name => $value)
					{
						$attributesString .= self::GetAttributeString($name, $value);
					}
					
					return $attributesString;
				}
				else
				{
					return $attributes;
				}
			}
			
			/**
			 * Generates HTML tag without attributes parsing
			 * 
			 * @param string $tag tag name
			 * @param string $attributes tag attributes
			 * @param $value tag value
			 */
			private static function TagRaw($tag, $attributes, $value = '')
			{
				echo "<$tag $attributes>$value</$tag>";
			}
	
			/**
			 * Gets HTML tag without attributes parsing
			 * 
			 * @param string $tag tag name
			 * @param string $attributes tag attributes
			 * @param string $value tag value
			 * 
			 * @return string
			 */
			protected static function GetTagRaw($tag, $attributes, $value = '')
			{
				return "<$tag $attributes>$value</$tag>";
			}
			
			/**
			 * Gets CSS include string if it was not included already
			 * 
			 * @param string $filePath path to file
			 */
			private static function CssProcess($filePath)
			{
			    $cssString = self::GetLink(array('type' => 'text/css', 'rel' => 'stylesheet', 'href' => $filePath.'.css'));
	        	if (!in_array($cssString, self::$cssTagBuffer))
				{
					self::$cssTagBuffer[] = $cssString;
					return $cssString;
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
			 * Generates HTML tag
			 * 
			 * @param string $tag tag name
			 * @param string|array $attributes tag attributes
			 * @param mixed $value tag value
			 */
			public static function Tag($tag, $attributes, $value = '')
			{
				$attributes = self::GetAttributesString($attributes);
				
				self::TagRaw($tag, $attributes, $value);
			}
			
			/**
			 * Gets HTML tag
			 * 
			 * @param string $tag tag name
			 * @param string|array $attributes tag attributes
			 * @param mixed $value tag value
			 * 
			 * @return string
			 */
			public static function GetTag($tag, $attributes, $value = '')
			{
				$attributes = self::GetAttributesString($attributes);
				
				return self::GetTagRaw($tag, $attributes, $value);
			}
			
			
			/* META TAGS */
			
			/**
			 * Generates 'meta' tag
			 * 
			 * @param string $name parameter name ('name' or 'http-equiv')
			 * @param string $value parameter value
			 * @param string $content the content of the meta information
			 * @param string|array $attributes tag attributes
			 */
			public static function Meta($name, $value, $content, $attributes = '')
			{
				$attributes = self::GetAttributeString('content', $content).self::GetAttributeString($name, $value).self::GetAttributesString($attributes);
				
				self::TagRaw('meta', $attributes);
			}
			
			/**
			 * Generates 'title' tag
			 * 
			 * @param string $value text to be displayed
			 * @param string|array $attributes tag attributes
			 */
			public static function Title($value, $attributes = '')
			{
				self::Tag('title', $attributes, $value);	
			}
			
			/**
			 * Generates 'link' tag
			 * 
			 * @param string|array $attributes tag attributes
			 */
			public static function Link($attributes)
			{
				echo self::GetLink($attributes);
			}
			
			/**
			 * Gets 'link' tag
			 * 
			 * @param string|array $attributes tag attributes
			 */
			private static function GetLink($attributes)
			{
				return self::GetTag('link', $attributes);
			}
	
			/**
			 * Generates favicon
			 * 
			 * @param string $pathToFile path to the favicon image
			 */
			public static function Favicon($pathToFile)
			{
			    self::Link(array('rel' => 'shortcut icon', 'href' => $pathToFile, 'type' => 'image/png'));
			}
			
			/**
			 * Generates 'style' tag
			 * 
			 * @param string|array $attributes tag attributes
			 */
			public static function Style($value, $attributes = '')
			{
				self::Tag('style', $attributes, $value);
			}
			
			/**
			 * Includes CSS file by generating appropriate link tag
			 * 
			 * @param string|array $pathToFile path to the CSS file
			 */
			public static function Css($pathToFile)
			{
			    if (is_array($pathToFile))
			    {
			        foreach ($pathToFile as $filePath)
			        {
			            echo self::CssProcess($filePath);
			        }
			    }
			    else
			    {
	    			echo self::CssProcess($pathToFile);
			    }
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
	
			
			/* EXTERNAL FILES (BUFFER) */
				
			/**
			 * Adds CSS file(-s) into buffer
			 * 
			 * @param string|array $pathToFile path to the CSS file
			*/
			public static function CssToBuffer($pathToFile)
			{
			    if (is_array($pathToFile))
			    {
			        foreach ($pathToFile as $filePath)
			        {
	                    self::CssProcess($filePath);		        
			        }
			    }
			    else
			    {
	                self::CssProcess($pathToFile);			        
			    }
			}
			
			/**
			 * Includes CSS files from $cssTagBuffer array
			 */
			public static function IncludeCssBufferFiles()
			{
				foreach (self::$cssTagBuffer as $value)
				{
					echo $value;
				}
			}
			
			/**
			 * Adds JS file(-s) into buffer
			 * 
			 * @param string|array $pathToFile path to the js file
			*/
			public static function JavaScriptToBuffer($pathToFile)
			{
			    if (is_array($pathToFile))
			    {
			        foreach ($pathToFile as $filePath)
			        {
	                    self::JavaScriptProcess($filePath);			        
			        }
			    }
			    else
			    {
	                self::JavaScriptProcess($pathToFile);
			    }
			}
			
			/**
			 * Includes JS files from $jsTagBuffer array
			 */
			public static function IncludeJavaScriptBufferFiles()
			{
				foreach (self::$jsTagBuffer as $value)
				{
					echo $value;
				}
			}
			
			
			/* GENERAL TAGS */
			
			/**
			 * Generates 'img' tag
			 * 
			 * @param string $src path to image (src HTML arrtibute value)
			 * @param string $alt alternative text
			 * @param string|array $attributes tag attributes
			 */
			public static function Img($src, $alt = '', $attributes = '')
			{
				$attributes = self::GetAttributeString('src', $src).self::GetAttributeString('alt', $alt).self::GetAttributesString($attributes);
				self::TagRaw('img', $attributes);
			}
			
			/**
			 * Generates 'a' tag
			 * 
			 * @param string|boolean $url url (href attribute) or false in no href tag needed
			 * @param string $content text or other content to be displayed
			 * @param string|array $attributes tag attributes
			 */
			public static function Anchor($url = '', $content = '', $attributes = '')
			{
				$attributes = ($url === false) ? self::GetAttributesString($attributes) : self::GetAttributeString('href', $url).self::GetAttributesString($attributes);
				self::TagRaw('a', $attributes, $content);
			}
			
			/**
			 * Generates 'div' tag 
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param string|array $attributes tag attributes
			 */
			public static function Div($content = '', $class = '', $attributes = '') 
			{
				self::Tag('div', self::GetAttributeString('class', $class).self::GetAttributesString($attributes), $content);
			}
			
			
			/* FORM TAGS */
			
		    /**
			 * Generates a open form tag
			 *
			 * @param string $action form action 
			 * @param string $method data transmission method (GET/POST)
			 * @param string $attributes tag attributes
			 * @param boolean $isStartTag defines whether to generate only the start form tag
			 */		
			public static function Form($action, $method = 'POST', $attributes = '', $isStartTag = true)
			{
				$attributes = self::GetAttributeString('action', $action).self::GetAttributeString('method', $method).self::GetAttributesString($attributes);
				
				//defines whether to generate only start form tag
				if ($isStartTag)
				{
					echo "<form $attributes>";
				}
				else
				{
					self::Tag('form', $attributes);
				}
			}
			
			/**
			 * Generates 'input' tag
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param string $type input field type
			 * @param string|array $attributes tag attributes
			 */
			public static function Input($name, $value = '', $type = 'text', $attributes = '')
			{
				$attributes = self::GetAttributeString('name', $name).self::GetAttributeString('value', $value).self::GetAttributeString('type', $type).self::GetAttributesString($attributes);
	
				self::TagRaw('input', $attributes);
			}
			
			/**
			 * Generates 'input' tag with the 'text' type
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param string|array $attributes tag attributes
			 */
			public static function InputText($name = '', $value = '', $attributes = '') 
			{
				self::Input($name, $value, 'text', $attributes);
			}
			
			/**
			 * Generates 'input' tag with the 'hidden' type
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param string|array $attributes tag attributes
			 */
			public static function InputHidden($name = '', $value = '', $attributes = '') 
			{
				self::Input($name, $value, 'hidden', $attributes);
			}
			
			/**
			 * Generates 'input' tag with the 'password' type
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param string|array $attributes tag attributes
			 */
			public static function InputPassword($name = '', $value = '', $attributes = '') 
			{
				self::Input($name, $value, 'password', $attributes);
			}
			
			/**
			 * Generates 'input' tag with the 'radio' type
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param boolean|integer $isChecked defines whether the radio button is checked
			 * @param string|array $attributes tag attributes
			 */
			public static function InputRadio($name = '', $value = '', $isChecked = false, $attributes = '') 
			{
				$attributes = ($isChecked) ? self::GetAttributeString('checked', 'checked').self::GetAttributesString($attributes) : $attributes;
	
				self::Input($name, $value, 'radio', $attributes);
			}
					
			/**
			 * Generates 'input' tag with the 'checkbox' type
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param boolean|integer $isChecked defines whether the checkbox is checked
			 * @param string|array $attributes tag attributes
			 */
			public static function InputCheckbox($name = '', $value = '', $isChecked = false, $attributes = '') 
			{
				$attributes = ($isChecked) ? self::GetAttributeString('checked', 'checked').self::GetAttributesString($attributes) : $attributes;
	
				self::InputHidden($name, '0');
				self::Input($name, $value, 'checkbox', $attributes);
			}
					
			/**
			 * Generates 'input' tag with the 'button' type
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param string|array $attributes tag attributes
			 */
			public static function InputButton($name = '', $value = '', $attributes = '') 
			{
				self::Input($name, $value, 'button', $attributes);
			}
	
			/**
			 * Generates 'input' tag with the 'submit' type
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param string|array $attributes tag attributes
			 */
			public static function InputSubmit($name = '', $value = '', $attributes = '') 
			{
				self::Input($name, $value, 'submit', $attributes);
			}
			
			/**
			 * Generates 'input' tag with the 'reset' type
			 * 
			 * @param string $name input field name
			 * @param mixed $value input field value
			 * @param string|array $attributes tag attributes
			 */
			public static function InputReset($name = '', $value = '', $attributes = '') 
			{
				self::Input($name, $value, 'reset', $attributes);
			}
			
			/**
			 * TODO
			 */
			public static function InputFile()
			{
			    
			}
			
			/**
			 * Generates 'input' tag with the 'image' type
			 *
			 * @param string $src image source
			 * @param string $alt alternative text
			 * @param string|array $attributes HTML attributes
			 */
			public static function InputImage($src, $alt = '', $attributes = '')
			{
			    $attributes = self::GetAttributesString(array('src' => $src, 'alt' => $alt)).self::GetAttributesString($attributes);
				self::Input(null, null, 'image', $attributes);
			}
			
			/**
			 * Generates 'select' tag with options
			 * 
			 * @param string $name select name
			 * @param array $options options array in the following format: array('0' => array('some_id' => 'value1', 'name'=>'text1', 'some_attributes'=>"disabled = 'disabled'"), '1' => array('some_id' => 'value2', 'some_name'=>'text2'))
			 * @param string $selectedValue selected value
			 * @param string|boolean $emptyOptionValue empty option value or false if not needed
			 * @param string $emptyOptionText empty option text
			 * @param string|array $attributes tag attributes
			 */
			public static function Select($name, array $options = array(), $selectedValue = '', $emptyOptionValue = '', $emptyOptionText = '-', $attributes = '') 
			{
				$attributes = self::GetAttributeString('name', $name).self::GetAttributesString($attributes);			
				
				//empty option
				$optionsString = ($emptyOptionValue === false) ? '' : '<option value="'.$emptyOptionValue.'">'.$emptyOptionText.'</option>';
				
				//loops through options
				foreach ($options as $option)
				{
				    //gets option value, text, html attributes
					$value = array_shift($option);
					$text = array_shift($option);
					$optionAttributes = array_shift($option);
					
					//defines if the option is selected
					$selected = ($value == $selectedValue) ? self::GetAttributeString('selected', 'selected') : "";
					
					//all options string
					$optionsString .= '<option value="'.$value.'"'.$selected.' '.$optionAttributes.'>'.$text.'</option>';
				}
				
				self::TagRaw('select', $attributes, $optionsString);
				
				echo '</select>';
			}
					
			/**
			 * Generates 'textarea' tag
			 * 
			 * @param string $name textarea name
			 * @param mixed $value textarea value
			 * @param string|array $attributes tag attributes
			 */
			public static function Textarea($name, $value = '', $attributes = '')
			{
				$attributes = self::GetAttributeString('name', $name).self::GetAttributesString($attributes);
	
				self::TagRaw('textarea', $attributes, $value);
			}
	
			/**
			 * Generates 'label' tag
			 * 
			 * @param mixed $elementId value of the 'id' attribute
			 * @param string $content label
			 * @param string|array $attributes tag attributes
			 * 
			 * @return string
			 */
			public static function Label($elementId, $content, $attributes = '')
			{
				echo self::GetLabel($elementId, $content, $attributes);
			}
	
			
			/* JAVASCRIPT */
			
			/**
			 * Generates 'script' tag
			 * 
			 * @param string $type script type
			 * @param string $value script to be executed
			 * @param string|array $attributes tag attributes
			 */
			public static function Script($type = 'text/javascript', $value, $attributes = '')
			{
				$attributes = "type = '$type' ".self::GetAttributesString($attributes);
				
				self::TagRaw('script', $attributes, $value);
			}
	
			
			/* SPHERUS DEPENDANT TAGS */
			
			/**
			 * Generates 'img' tag with predefined path base (see $imageBasePath)
			 * 
			 * @param string $src path to image (src HTML arrtibute value)
			 * @param string $alt alternative text
			 * @param string|array $attributes tag attributes
			 */
			public static function Image($src, $alt = '', $attributes = '')
			{
				self::Img(self::$imageBasePath.$src, $alt, $attributes);
			}	
	
			/**
			 * Generates 'img' tag with language dependent predefined path base (see $imageLocalizedBasePath)
			 * 
			 * @param string $src path to image (src HTML arrtibute value)
			 * @param string $alt alternative text
			 * @param string|array $attributes tag attributes
			 */
			public static function ImageLocalized($src, $alt = '', $attributes = '')
			{
				self::Img(self::$imageLocalizedBasePath.$src, $alt, $attributes);
			}		
	
		}
	
	}
?>