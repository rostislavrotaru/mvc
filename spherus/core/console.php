<?php
namespace Spherus\Core
{

    /**
     * Represents the framework console information
     *
     * @version 3.0
     * @package Core
     * @author Rostislav Rotaru
     *        
     */
    class Console
    {
        
        /* FIELDS */
        
        /**
         * The framework version
         */
        private static $version = '3.0.0.0';

        /**
         * The framework url
         */
        private static $url = 'http://www.spherus.net';

        /**
         * The framework name
         */
        private static $name = 'SPHERUS Framework';
        
        /* FUNCTIONS */
        
        /**
         * Prints system message and stops further scripts execution.
         *
         * @param string $message
         *            The message to print.
         */
        public static function PrintInfo ($message)
        {
            echo '	<div style="font:12px sans-serif;">
						<h3>' . $message . '</h3>
						<hr />
						<font style="font-size:0.8em; font-style:italic;">' . self::$name .
                     ', version ' . self::$version . '</font>
						</div>
					 ';
            exit();
        }
    }
}

?>