<?php

/* INITIALISATION FILE
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

/* DB CONNECTION
---------------------------------------*/

include(PATH . 'control/classes/class.db.php');
$DB = new db();
$DB->db_conn();

/* LOAD SETTINGS
---------------------------------------*/

$Q = $DB->db_query("SELECT * FROM `" . DB_PREFIX . "settings`", true);

if ($Q == 'err') {
  header("Location: install/index.php");
  exit;
}

$SETTINGS = $DB->db_object($Q);

/* CHECK FOR MANUAL INSTALLER
---------------------------------------*/

mswMan($SETTINGS, $DB);

/* LANGUAGE FILES
---------------------------------------*/

define('LANG_FLDR', mswLang($SETTINGS));
define('MSW_EM_LANG', LANG_FLDR . LANG_FLDR_EM . '/');
include(LANG_FLDR . 'global.php');

/* LOAD CONTROLLERS
---------------------------------------*/

include(PATH . 'control/controllers.php');

/* INITIALISE VARIABLES
---------------------------------------*/

$cmd          = 'dashboard';
$page         = (isset($_GET['next']) && $_GET['next'] > 0 ? (int) $_GET['next'] : '1');
$limit        = $page * DEF_PER_PAGE - (DEF_PER_PAGE);
$sysTitle     = str_replace('{website}', mswCD($SETTINGS->website), $msg_meta);
$count        = 0;
$recLimit     = 0;
$loadJS       = array();
$formErrors   = array();
$metas        = array();

/* TIMEZONE
---------------------------------------*/

mswTZ($SETTINGS->timezone, $timezones);

/* API
-----------------------------------------------*/

if (!isset($_GET['ajax-ops'])) {
  $apiDetect = $API->detection();
  if ($apiDetect != 'no') {
    define('MSWAPI', 1);
    include(PATH . 'control/system/api-handler.php');
    exit;
  }
}

/* ONLINE / OFFLINE
--------------------------------------*/

if ($SETTINGS->sysstatus == 'no') {
  include(PATH . 'control/system/modules/offline.php');
  exit;
}

?>