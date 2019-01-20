<?php

/* DASHBOARD MODULE
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// Is there a new landing page?
$LPGE = $SYS->load(array(
  'section' => 'landing'
));

if (isset($LPGE->id)) {
  define('LANDING_PAGE', 1);
  $_GET['pg'] = $LPGE->id;
  include(PATH . 'control/system/modules/pages.php');
  exit;
}

include(LANG_FLDR . 'category.php');
include(LANG_FLDR . 'journal.php');

include(PATH . 'control/system/modules/_header.php');

$tpl = mswS3();
$tpl->assign('TEXT', array($msw_category5));
$tpl->assign('LTEXT', array(
  $msw_category,
  $msw_category2,
  $msw_category3,
  $msw_category4
));

$tpl->assign('JOURNALS', $JNLS->getjournals(array('area' => 'dashboard', 'lang' => array($msw_category6,$msw_category7,$msw_journal5,$msw_journal7,$msw_category8,$msw_category9,$msw_category10))));

// Global..
include(PATH . 'control/system/global.php');

$tpl->display(THEME_FOLDER . '/dashboard.tpl.php');

include(PATH . 'control/system/modules/_footer.php');

?>