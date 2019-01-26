<?php

/* PAGE MODULE
----------------------------------*/

if (!defined('PARENT') || !isset($_GET['pg'])) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

$PAGE = $SYS->load(array(
  'section' => (defined('LANDING_PAGE') ? 'landing' : 'new-page'),
  'id' => (int) $_GET['pg'],
  'slug' => (defined('LANDING_PAGE') ? '' : mswSlug($_GET['pg']))
));

if (!isset($PAGE->id)) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// Title..
if (!in_array($PAGE->metat, array(null,''))) {
  $sysTitle = $PAGE->metat;
  $metas['title'] = $sysTitle;
} else {
  $titlePrefix = $PAGE->name;
  $metas['title'] = $titlePrefix;
}

$metas['url'] = $MODR->url(array(
  $MODR->config['slugs']['npg'] . '/' . $PAGE->slug,
  'pg=' . $PAGE->id
));

include(PATH . 'control/system/modules/_header.php');

$tpl = mswS3();
$tpl->assign('PDATA', array(
  'info' => mswBB($PAGE->info, $SETTINGS, $BB),
  'name' => mswCD($PAGE->name)
));

// Global..
include(PATH . 'control/system/global.php');

if ($PAGE->tmp && file_exists(PATH . THEME_FOLDER . '/custom-templates/' . $PAGE->tmp)) {
  $tpl->display(THEME_FOLDER . '/custom-templates/' . $PAGE->tmp);
} else {
  $tpl->display(THEME_FOLDER . '/new-page.tpl.php');
}

include(PATH . 'control/system/modules/_footer.php');

?>