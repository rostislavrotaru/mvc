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
		
		use Spherus\HttpContext\HttpContext;
		use Spherus\Core\SpherusException;

		/**
		* Class that represents the base for all application controllers
		*
		* @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
		* @package spherus.core
		*/
		abstract class ControllerBase
		{
			
			/* FIELDS */
			
			/**
			 * Determine the list of controller functions that has no views
			 * @var array
			 */
			public $noViewControllers = array();
			
			/**
			 * Defines the controller layout
			 * @var string
			 */
			public $layout = null; 
			
			/**
			 * Defines the list of controller helpers
			 * @var array
			 */
			protected $helpers = array(); 
		 

			/* EVENT TEMPLATES */

			/**
			* Is raised before any controller and performs common for all controllers actions,
			* can be replaced or completed in application controller or definite controller
			*/
			public function BeforeLoad()
			{
	
			}
			
			/**
			 * Is raised after controller loads and before action loads,
			 * can be replaced or completed in application controller or definite controller
			 */
			public function AfterLoad()
			{
			
			}
	
			/**
			* Is raised before controller action,
			* can be replaced or completed in application controller or definite controller
			*/
			public function BeforeAction()
			{
	
			}
	
			/**
			* Is raised after controller action,
			* can be replaced or completed in application controller or definite controller
			*/
			public function AfterAction()
			{
	
			}
			
			
			/* PUBLIC METHODS */
			
			/**
			 * Include current controller helpers
			 */
			public function IncludeHelpers()
			{
			    $controllerHelpers = $this->helpers;
			
			    foreach ($controllerHelpers as $value)
			    {	
			        $filename = $this->GetIncludeFilename($value);
			        
			        if($filename)
			        {
			            //Include global helper file just once
			            require_once(CORE.'helperbase.php');
			
			            //Load helper in following search order: system path, app helpers path, modules helpers path
			            //Framework helpers path
			            if (file_exists(strtolower(HELPERS.$filename.'.php')))
			            {
			                require_once(strtolower(HELPERS.$filename.'.php'));
							return;
			            }
			            //App helpers path
			            elseif (file_exists(strtolower(APP_HELPERS.$filename.'.php')))
			            {
			                require_once(strtolower(APP_HELPERS.$filename.'.php'));
			                return;
			            }
			            //Module helpers path
			            else
			            {
			                $filePath = Context::getCurrentModule()->GetHelpersPath().DIRECTORY_SEPARATOR.$filename.'.php';
			                if (file_exists($filePath))
			                {
			                    require_once($filePath);
			                    return;
			                }
			            }
			            throw new SpherusException(sprintf(EXCEPTION_HELPER_NOT_FOUND, $filename));
			        }
			    }
			}
					
			/**
			 * Returns filename to include or false if it should not be included in this page
			 *
			 * @param string $fileString filename with optional modifiers
			 * @return string|boolean
			 */
			public function GetIncludeFilename($fileString)
			{
			    //divides the rule string into file name and use limitations
			    $explodedArray = explode('|', $fileString);
			    $fileName = $explodedArray[0];
			    	
			    if (empty($explodedArray[1]))
			    {
			        //if no use limitations found
			        return $fileName;
			    }
			    else
			    {
			        //gets use limitations (actions where it should or should not be used)
			        $actions = explode(',', $explodedArray[1]);
			
			        if (substr($explodedArray[1], 0, 1) != '^')
			        {
			            //if it is the list with allowed actions
			            return (in_array(HttpContext::getParsedUrl()->getActionName(), $actions)) ? $fileName : false;
			        }
			        else
			        {
			            //if it is the list with NOT allowed actions
			            return (in_array(HttpContext::getParsedUrl()->getActionName(), $actions)) ? false : $fileName;
			        }
			    }
			}
			
		}
	}
?>