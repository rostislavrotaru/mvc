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
 * Serves as the base for the booting process
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus
 */

use Spherus\Core\Workbench;
use Spherus\HttpContext\HttpContext;
use Spherus\HttpContext\Session;
use Spherus\Routing\RouteManager;
use App\Common\Config;

// Base require files
require ('Paths.php');
require ('Autoloader.php');

// Starts session
Session::Start();

// Load application configuration file
// Throws exception if not found
Config::Initialize();

// Initialize route handler
RouteManager::Initialize();

// Initialize http context
HttpContext::Initialize();

// Initialize context
Workbench::Initialize();