<?php

/* FOOTER MODULE
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH.'control/system/headers/403.php');
  exit;
}

define('RECENT_LOADED', 'footer');
include(LANG_FLDR . 'footer.php');

// Copyright link..
$tpl = mswS3();
$tpl->assign('TEXT', array(
  $msw_footer,
  $msw_footer2,
  $msw_footer3,
  $msw_footer4,
  $msw_footer5
));
$tpl->assign('FOOTER', mswFoot($SETTINGS->pfoot));
$tpl->assign('MODULES', $SYS->modules($loadJS, 'footer'));

$recLimit = RECENT_JOURNALS_FOOTER;

// Global..
include(PATH . 'control/system/global.php');

$tpl->display(THEME_FOLDER . '/footer.tpl.php');

?>
