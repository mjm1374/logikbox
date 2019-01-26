<?php

/* HEADER MODULE
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

include(LANG_FLDR . 'header.php');

// Build structured meta data..
include(PATH . 'control/system/meta-data.php');

$tpl = mswS3();
$tpl->assign('TEXT', array(
  $msw_header,
  $msw_header2
));
$tpl->assign('TITLE', mswSH($sysTitle));
$tpl->assign('STRUCTURED_DATA', (isset($mswMetaData) ? $mswMetaData : ''));
$tpl->assign('MODULES', $SYS->modules($loadJS));

// Global..
include(PATH . 'control/system/global.php');

$tpl->display(THEME_FOLDER . '/header.tpl.php');

?>