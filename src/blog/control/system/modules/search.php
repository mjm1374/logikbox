<?php

/* SEARCH MODULE
----------------------------------*/

if (!defined('PARENT') || !isset($_GET['q'])) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// Blank search? Do nothing..
if ($_GET['q'] == '') {
  header("Location: " . $SETTINGS->ifolder);
  exit;
}

include(LANG_FLDR . 'search.php');
include(LANG_FLDR . 'category.php');
include(LANG_FLDR . 'journal.php');

// For pages..
$limit = $page * JNLS_PER_PAGE - (JNLS_PER_PAGE);
$numRows = $JNLS->getjournals(array('area' => 'search', 'limit' => $limit, 'page' => $page, 'count' => 'yes'));
$url = $MODR->url(array(
  $MODR->config['slugs']['sch'] . '/' . urlencode($_GET['q']) . '/{page}',
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

$titlePrefix = str_replace('{count}', mswNFM($numRows), $msw_search);
$metas['title'] = $titlePrefix;
$metas['url'] = str_replace('{page}', $page, $url);

include(PATH . 'control/system/modules/_header.php');

$tpl = mswS3();
$tpl->assign('TEXT', array($titlePrefix,$msw_search2));
$jnldata = $JNLS->getjournals(array('area' => 'search', 'limit' => $limit, 'page' => $page, 'lang' => array($msw_category6,$msw_category7,$msw_journal5,$msw_journal7,$msw_category8,$msw_category9,$msw_category10)));
$tpl->assign('JOURNALS', $jnldata);
$tpl->assign('PAGES', $PGS->display());

// Global..
include(PATH . 'control/system/global.php');

$tpl->display(THEME_FOLDER . '/search.tpl.php');

include(PATH . 'control/system/modules/_footer.php');

?>