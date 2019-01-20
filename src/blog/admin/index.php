<?php

//------------------------------------------------------------------------------
// SCRIPT LOADER
// DO NOT change this file
//------------------------------------------------------------------------------

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('Content-type: text/html; charset=utf-8');

@ini_set('session.cookie_httponly', 1);
@session_start();

// Default data load.
date_default_timezone_set('UTC');

define('ADMIN_PANEL', 1);
define('PARENT', 1);
define('PATH', dirname(__file__) . '/');

include(PATH . 'control/init.php');

include(REL_PATH . 'control/classes/class.errors.php');
if (ERR_HANDLER_ENABLED) {
  register_shutdown_function('msFatalErr');
  set_error_handler('msErrorhandler');
}

include(PATH . 'control/system-load.php');

?>