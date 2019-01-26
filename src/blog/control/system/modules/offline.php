<?php

/* DASHBOARD MODULE
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

include(LANG_FLDR . 'offline.php');

// Is auto enable enabled?
if ($SETTINGS->autoenable > 0) {
  $SYS->enable();
}

$titlePrefix = $msw_offline;

$tpl = mswS3();
$tpl->assign('TEXT', array($titlePrefix));
$tpl->assign('REASON', mswBB($SETTINGS->reason, $SETTINGS, $BB));

// Global..
include(PATH . 'control/system/global.php');

$tpl->display(THEME_FOLDER . '/offline.tpl.php');

?>