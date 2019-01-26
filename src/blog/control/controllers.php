<?php

/* CONTROLLER FILE
----------------------------------*/

if (!defined('PARENT') || !isset($SETTINGS->id)) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

/* LOAD INCLUDE FILES
---------------------------------------*/

mswFLCTR();
include(PATH . 'control/system/core/sys-controller.php');
include(PATH . 'control/timezones.php');
include(PATH . 'control/classes/class.cache.php');
include(PATH . 'control/classes/class.mobile-detection.php');
include(PATH . 'control/classes/class.page.php');
include(PATH . 'control/classes/class.datetime.php');
include(PATH . 'control/classes/class.bb.php');
include(PATH . 'control/classes/class.rewrite.php');
include(PATH . 'control/classes/class.parser.php');
include(PATH . 'control/classes/mailer/class.send.php');
include(PATH . 'control/classes/class.json.php');
include(PATH . 'control/classes/class.system.php');
include(PATH . 'control/classes/class.api.php');
include(PATH . 'control/classes/class.html.php');
include(PATH . 'control/classes/class.social.php');
include(PATH . 'control/classes/class.journals.php');

/* INITIALISE CLASSES - PRE THEME
---------------------------------------*/

$MODR            = new modrw();
$DT              = new dt();
$SYS             = new mswsys();
$SCL             = new social();
$SYS->settings   = $SETTINGS;
$SYS->rwr        = $MODR;
$SYS->dt         = $DT;
$SYS->social     = $SCL;
$SCL->settings   = $SETTINGS;
$SCL->rwr        = $MODR;
$MODR->settings  = $SETTINGS;
$MODR->errs      = $msw_err_headers;
$DT->settings    = $SETTINGS;

/* THEME SWITCHER
---------------------------------------*/

include(PATH . 'control/theme-switcher.php');

/* INITIALISE CLASSES
---------------------------------------*/

$CACHE           = new cache($SETTINGS);
$JSON            = new json();
$BB              = new bbcode();
$PDTC            = new Mobile_Detect();
$PRSR            = new parser();
$MAILR           = new mailr();
$API             = new api();
$HTML            = new html();
$JNLS            = new journals();
$HTML->cache     = $CACHE;
$HTML->bb        = $BB;
$HTML->settings  = $SETTINGS;
$HTML->rwr       = $MODR;
$HTML->dt        = $DT;
$HTML->sys       = $SYS;
$HTML->ssn       = $SSN;
$HTML->journals  = $JNLS;
$JNLS->cache     = $CACHE;
$JNLS->bb        = $BB;
$JNLS->settings  = $SETTINGS;
$JNLS->rwr       = $MODR;
$JNLS->dt        = $DT;
$JNLS->sys       = $SYS;
$JNLS->ssn       = $SSN;
$MAILR->parser   = $PRSR;
$BB->settings    = $SETTINGS;
$API->dt         = $DT;
$API->settings   = $SETTINGS;
$API->cache      = $CACHE;
$SCL->cache      = $CACHE;
$SYS->cache      = $CACHE;

/* REWRITE RULES
---------------------------------------*/

if ($SETTINGS->modr == 'yes') {
  $MODR->parser();
}

/* PLATFORM DETECTION
---------------------------------------*/

define('MSW_PLATFORM_DETECTION', ($PDTC->isMobile() ? ($PDTC->isTablet() ? 'tablet' : 'mobile') : 'pc'));

?>