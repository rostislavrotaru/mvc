<?php

/**
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright SPHERUS (http://spherus.net)
	* @license http://license.spherus.net
	* @link http://spherus.net
	* @since 3.0
	*/

/**
 * Defines paths
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus
 */

/* CONSTANTS */

// Root path
define('ROOT', '.');

// Directory separator
define('SEPARATOR', '/');

// Spherus path
define('SPHERUS', ROOT . SEPARATOR . 'spherus' . SEPARATOR);

// Core path
define('CORE', SPHERUS . 'core' . SEPARATOR);

// Core base path
define('BASE', CORE . 'base' . SEPARATOR);

// Parsers path
define('PARSERS', SPHERUS . 'parsers' . SEPARATOR);

// Routing path
define('ROUTING', SPHERUS . 'routing' . SEPARATOR);

// HttpContext path
define('HTTP_CONTEXT', SPHERUS . 'httpcontext' . SEPARATOR);

// Interfaces path
define('INTERFACES', SPHERUS . 'interfaces' . SEPARATOR);

// Helpers path
defined('HELPERS') or define('HELPERS', SPHERUS . 'helpers' . SEPARATOR);

/* APPLICATION CONSTANTS */

// Public application path
define('APP', ROOT . SEPARATOR . 'app' . SEPARATOR);

// Application common folder path
define('APP_COMMON', APP . 'common' . SEPARATOR);

// Application modules path
define('MODULES', APP . 'modules' . SEPARATOR);

// Application themes path
define('THEMES', APP . 'themes' . SEPARATOR);

// Common helpers path
define('APP_HELPERS', APP_COMMON . 'helpers' . SEPARATOR);

// Common css path
define('COMMON_CSS', APP_COMMON . 'css' . SEPARATOR);

// Common images path
define('COMMON_IMAGES', APP_COMMON . 'images' . SEPARATOR);

// Common images path
define('COMMON_SCRIPTS', APP_COMMON . 'scripts' . SEPARATOR);

?>