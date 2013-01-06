<?php

/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/
namespace Spherus\Core\Base
{
    use Spherus\Core\SpherusException;
    use Spherus\Core\Workbench;

    /**
     * Class that represents the base for all application controllers
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.core.base
     */
    abstract class ControllerBase
    {
        
        /* FIELDS */
        
        /**
         * Determine the list of controller functions that has no views
         *
         * @var array
         */
        public $noViewControllers = array();

        /**
         * Defines the controller layout
         *
         * @var string
         */
        public $layout = null;

        /**
         * Defines the list of controller helpers
         *
         * @var array
         */
        public $helpers = array();
        
        /* EVENT TEMPLATES */
        
        /**
         * Is raised before any controller and performs common for all
         * controllers actions,
         * can be replaced or completed in application controller or definite
         * controller
         */
        public function BeforeLoad ()
        {}

        /**
         * Is raised after controller loads and before action loads,
         * can be replaced or completed in application controller or definite
         * controller
         */
        public function AfterLoad ()
        {}

        /**
         * Is raised before controller action,
         * can be replaced or completed in application controller or definite
         * controller
         */
        public function BeforeAction ()
        {}

        /**
         * Is raised after controller action,
         * can be replaced or completed in application controller or definite
         * controller
         */
        public function AfterAction ()
        {}
        
        /* PUBLIC METHODS */
        
        /**
         * Include current controller helpers
         */
        public function IncludeHelpers ()
        {
            foreach ($this->helpers as $filename) {
                // Load helper in following search order: system path, app
                // helpers path, modules helpers path
                // Framework helpers path
                if (file_exists(strtolower(HELPERS . $filename . '.php'))) {
                    require_once (strtolower(HELPERS . $filename . '.php'));
                    return;
                }                 // App helpers path
                elseif (file_exists(
                        strtolower(APP_HELPERS . $filename . '.php'))) {
                    require_once (strtolower(APP_HELPERS . $filename . '.php'));
                    return;
                }                 // Module helpers path
                else {
                    $filePath = Workbench::getCurrentModule()->GetHelpersPath() .
                             SEPARATOR . $filename . '.php';
                    if (file_exists($filePath)) {
                        require_once ($filePath);
                        return;
                    }
                }
                
                throw new SpherusException(
                        sprintf(EXCEPTION_HELPER_NOT_FOUND, $filename));
            }
        }
    }
}
?>