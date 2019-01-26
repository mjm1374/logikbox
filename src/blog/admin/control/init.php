<?php

/* INIT
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/modules/header/403.php');
}

include(PATH . 'control/functions.php');
include(PATH . 'control/userdef.php');
include(REL_PATH . 'control/functions.php');
include(REL_PATH . 'control/userdef.php');
include(PATH . 'control/access.php');

/* DB CONNECTION
---------------------------------------*/

include(REL_PATH . 'control/connect.php');
include(REL_PATH . 'control/classes/class.db.php');
$DB = new db();
$DB->db_conn();

/* LOAD SETTINGS
---------------------------------------*/

$Q = $DB->db_query("SELECT * FROM `" . DB_PREFIX . "settings`", true);

if ($Q == 'err') {
  header("Location: ../install/index.php");
  exit;
}

$SETTINGS = $DB->db_object($Q);

/* LANGUAGE FILES
---------------------------------------*/

define('THEME_FOLDER', 'content/' . (is_dir(REL_PATH . 'content/' . $SETTINGS->theme) ? $SETTINGS->theme : '_theme_default'));
define('MSW_ADM_LANG', LANG_BASE_PATH . $SETTINGS->language . '/' . LANG_FLDR_ADM . '/');
define('MSW_LANG', LANG_BASE_PATH . $SETTINGS->language . '/');
define('MSW_EM_LANG', LANG_BASE_PATH . $SETTINGS->language . '/' . LANG_FLDR_EM . '/');

include(MSW_LANG . 'global.php');
include(MSW_ADM_LANG . 'header.php');
include(MSW_ADM_LANG . 'nav-menu.php');

/* GLOBAL FILES
---------------------------------------*/

include(PATH . 'control/arrays.php');
include(REL_PATH . 'control/timezones.php');
include(REL_PATH . 'control/system/constants.php');

/* INCLUDE FILES
---------------------------------------*/

mswFLCTR();
include(REL_PATH . 'control/classes/class.session.php');
include(REL_PATH . 'control/system/core/sys-controller.php');
include(REL_PATH . 'control/classes/class.rewrite.php');
include(REL_PATH . 'control/classes/class.cache.php');
include(REL_PATH . 'control/classes/class.datetime.php');
include(REL_PATH . 'control/classes/class.mobile-detection.php');
include(REL_PATH . 'control/classes/class.page.php');
include(REL_PATH . 'control/classes/class.parser.php');
include(REL_PATH . 'control/classes/mailer/class.send.php');
include(REL_PATH . 'control/classes/class.json.php');
include(PATH . 'control/classes/class.system.php');
include(REL_PATH . 'control/classes/class.social.php');

/*
  INITIALISE CLASSES
---------------------------------------*/

$JSON             = new json();
$SYS              = new mswsys();
$PDTC             = new Mobile_Detect();
$CACHE            = new cache($SETTINGS);
$PRSR             = new parser();
$MAILR            = new mailr();
$SOCIAL           = new social();
$DT               = new dt();
$MODR             = new modrw();
$SSN              = new sessHandlr();
$SOCIAL->json     = $JSON;
$SOCIAL->settings = $SETTINGS;
$SOCIAL->cache    = $CACHE;
$MAILR->parser    = $PRSR;
$DT->settings     = $SETTINGS;
$SYS->dt          = $DT;
$SYS->cache       = $CACHE;
$SYS->settings    = $SETTINGS;
$MODR->settings   = $SETTINGS;

/* LOGGED IN USER
---------------------------------------*/

$mswUser = mswUsr($SETTINGS, $DB, $SSN);

/* TIMEZONE
---------------------------------------*/

mswTZ($SETTINGS->timezone, $timezones);

/* INITIALISE VARIABLES
---------------------------------------*/

$cmd        = (isset($_GET['p']) ? $_GET['p'] : 'dashboard');
$pageTitle  = $msw_adm_header;
$pagePrefix = '';
$count      = 0;
$page       = (isset($_GET['next']) && $_GET['next'] > 0 ? (int) $_GET['next'] : '1');
$limit      = $page * DEF_PER_PAGE - (DEF_PER_PAGE);
$eString    = array();
$footer     = mswFoot($SETTINGS->afoot, 'admin');
$fjs        = array();

/* PLATFORM DETECTION
---------------------------------------*/

define('MSW_PFDTCT', ($PDTC->isMobile() ? ($PDTC->isTablet() ? 'tablet' : 'mobile') : 'pc'));

?>