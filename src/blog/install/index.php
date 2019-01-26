<?php

/* INSTALLER
------------------------------------------------*/

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('Content-type: text/html; charset=utf-8');

@ini_set('session.cookie_httponly', 1);

if (function_exists('date_default_timezone_get') && @date_default_timezone_get()) {
  date_default_timezone_set(@date_default_timezone_get());
}

if (!function_exists('mysqli_connect')) {
  die('!!! <b>The mysqli functions are not enabled on your server. Your must enable these functions before you can continue.</b><br><br>
  <a href="http://php.net/manual/en/book.mysqli.php">http://php.net/manual/en/book.mysqli.php</a>');
}

define('PARENT', 1);
define('PATH', dirname(__file__) . '/');
define('REL_PATH', substr(PATH, 0, strpos(PATH, 'install') - 1) . '/');

include(PATH . 'control/config.php');
include(REL_PATH . 'control/timezones.php');
include(REL_PATH . 'control/userdef.php');
include(REL_PATH . 'control/connect.php');
include(REL_PATH . 'control/functions.php');
include(PATH . 'control/functions.php');
include(REL_PATH . 'control/system/constants.php');
include(REL_PATH . 'control/classes/class.db.php');
include(REL_PATH . 'control/classes/class.json.php');

//---------------------------------------------------
// Error reporting
//---------------------------------------------------

include(REL_PATH . 'control/classes/class.errors.php');
if (ERR_HANDLER_ENABLED) {
  register_shutdown_function('msFatalErr');
  set_error_handler('msErrorhandler');
}

$DB = new db();
$JSON = new json();
$DB->db_conn();

include(PATH . 'control/arrays.php');

$cmd     = (isset($_GET['s']) ? $_GET['s'] : '1');
$title   = SCRIPT_NAME . ': Installation';
$count   = 0;
$defChar = 'utf8_general_ci';
$sqlVer  = $DB->db_version();

if (isset($_GET['ajax-ops'])) {
  include(PATH . 'control/ajax.php');
  exit;
}

include(PATH . 'content/header.php');
include(PATH . 'content/install.php');
include(PATH . 'content/footer.php');

?>