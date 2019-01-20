<?php

/* CALENDAR ARCHIVE MODULE
----------------------------------*/

if (!defined('PARENT') || !isset($_GET['cl'])) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

include(LANG_FLDR . 'archive.php');
include(LANG_FLDR . 'category.php');
include(LANG_FLDR . 'journal.php');

$chop = array_map('trim', explode('-', $_GET['cl']));
if (!isset($chop[0],$chop[1],$chop[2])) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// Parameters based on preference..
switch($DT->config['calendar_link_format']) {
  case 'us':
    $day = (int) $chop[1];
    $month = (int) $chop[0];
    $year = (int) $chop[2];
    break;
  default:
    $day = (int) $chop[0];
    $month = (int) $chop[1];
    $year = (int) $chop[2];
    break;
}
$month_nm = (isset($msw_calendar[($month - 1)]) ? $msw_calendar[($month - 1)] : date('F', strtotime($year . '-' . $month . '-' . $day)));

if (checkdate($month, $day, $year) == false || $year > date('Y')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// For pages..
$limit = $page * JNLS_PER_PAGE - (JNLS_PER_PAGE);
$numRows = $JNLS->getjournals(array('area' => 'archive-cal', 'dates' => array($day, $month, $year), 'limit' => $limit, 'page' => $page, 'count' => 'yes'));
$url = $MODR->url(array(
  $MODR->config['slugs']['cal'] . '/' . ($day < 10 ? '0' . $day : $day) . '/' . ($month < 10 ? '0' . $month : $month) . '/' . $year . '/{page}',
  'next='
));

$PGS = new pages(array(
  'count' => $numRows,
  'text' => $msw_pages,
  'page' => $page,
  'admin' => 'no',
  'flag' => '',
  'limit' => JNLS_PER_PAGE,
  'url' => $url,
  's' => $SETTINGS
));

$titlePrefix = str_replace(array('{date}'), array(date($SETTINGS->dateformat, strtotime($year . '-' . ($month < 10 ? '0' . $month : $month) . '-' . ($day < 10 ? '0' . $day : $day)))), $msw_archive2);
$metas['title'] = $titlePrefix;
$metas['url'] = str_replace('{page}', $page, $url);

include(PATH . 'control/system/modules/_header.php');

$tpl = mswS3();
$tpl->assign('TEXT', array($titlePrefix, $msw_archive4));
$jnldata = $JNLS->getjournals(array('area' => 'archive-cal', 'dates' => array($day, $month, $year), 'limit' => $limit, 'page' => $page, 'lang' => array($msw_category6,$msw_category7,$msw_journal5,$msw_journal7,$msw_category8,$msw_category9,$msw_category10)));
$tpl->assign('JOURNALS', $jnldata);
$tpl->assign('PAGES', $PGS->display());

// Global..
include(PATH . 'control/system/global.php');

$tpl->display(THEME_FOLDER . '/archive.tpl.php');

include(PATH . 'control/system/modules/_footer.php');

?>