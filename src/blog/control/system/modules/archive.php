<?php

/* ARCHIVE
----------------------------------*/

if (!defined('PARENT') || !isset($_GET['a'])) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

include(LANG_FLDR . 'archive.php');
include(LANG_FLDR . 'category.php');
include(LANG_FLDR . 'journal.php');

$chop = array_map('trim', explode('-', $_GET['a']));
if (!isset($chop[0],$chop[1])) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

$month = (int) $chop[0];
$year = (int) $chop[1];
$month_nm = (isset($msw_calendar[($month - 1)]) ? $msw_calendar[($month - 1)] : date('F', strtotime($year . '-' . $month . '-01')));

if (checkdate($month, 01, $year) == false || $year > date('Y')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// For pages..
$limit = $page * JNLS_PER_PAGE - (JNLS_PER_PAGE);
$numRows = $JNLS->getjournals(array('area' => 'archive', 'dates' => array($month, $year), 'limit' => $limit, 'page' => $page, 'count' => 'yes'));
$url = $MODR->url(array(
  $MODR->config['slugs']['arc'] . '/' . ($month < 10 ? '0' . $month : $month) . '/' . $year . '/{page}',
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

$titlePrefix = str_replace(array('{month}', '{year}'), array($month_nm, $year), $msw_archive);
$metas['title'] = $titlePrefix;
$metas['url'] = str_replace('{page}', $page, $url);

include(PATH . 'control/system/modules/_header.php');

$tpl = mswS3();
$tpl->assign('TEXT', array($titlePrefix, $msw_archive3));
$jnldata = $JNLS->getjournals(array('area' => 'archive', 'dates' => array($month, $year), 'limit' => $limit, 'page' => $page, 'lang' => array($msw_category6,$msw_category7,$msw_journal5,$msw_journal7,$msw_category8,$msw_category9,$msw_category10)));
$tpl->assign('JOURNALS', $jnldata);
$tpl->assign('PAGES', $PGS->display());

// Global..
include(PATH . 'control/system/global.php');

$tpl->display(THEME_FOLDER . '/archive.tpl.php');

include(PATH . 'control/system/modules/_footer.php');

?>