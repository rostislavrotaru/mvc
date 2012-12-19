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

		use Spherus\Helpers\HtmlHelper;
		use Spherus\HttpContext\HttpContext;

		/**
		* Class that responds to page processor
		*
		* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		* @package spherus.core
		*/
		class PageProcessor
		{
		    
		    /* FIELDS */

	    
			/**
			 * CSS tags buffer. Stores all css files links till the moment that will be used.
			 * @var array
			 */
			private static $cssTagBuffer = array();
		    
		    
		    /* PROPERTIES */
		    
			/**
			 * Set if page processor should process css.
			 * 
		     * @param boolean $processCss
		     * @throws SpherusException When $fileName parameter is null or empty.
		     */
		    public static function AddCssLink($fileName)
		    {
		        Check::IsNullOrEmpty($fileName);
		        
		    	if (!in_array($fileName, self::$cssTagBuffer))
			    {
			        self::$cssTagBuffer[] = $fileName;
			    }
		    }
		    

			/* PUBLIC METHODS*/
		    
		    /**
		     * Responds to page processing.
		     * 
		     * @param styring $pageContent Contains the content of file.
		     * @throws SpherusException When $pageContent is null or empty.
		     */
		    public static function ProcessPage()
		    {
		    	self::ProcessCss();
		    	
		    	echo HttpContext::getPageContent();
		    }
		    
		    
		    /* PRIVATE METHODS*/
		    
		    /**
			 * Processes css files by generating html tags
			 *
			 */
			private static function ProcessCss()
			{
			    if(count(self::$cssTagBuffer) > 0)
			    {
				    $css = null;
					foreach (self::$cssTagBuffer as $fileName)
					{
						$css .= HtmlHelper::Link(array('type' => 'text/css', 'rel' => 'stylesheet', 'href' => $fileName));
					}
					
					$pageContent = HttpContext::getPageContent();
					$pageContent = str_replace('{css}', $css, $pageContent);
					HttpContext::setPageContent($pageContent);
					unset($pageContent);
			    }
			}
		}
	}
	
?>