<?php

/* CATEGORY MODULE
----------------------------------*/

if (!defined('PARENT') || !isset($_GET['c'])) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

include(LANG_FLDR . 'category.php');
include(LANG_FLDR . 'journal.php');

$CAT = $SYS->load(array(
  'section' => 'category',
  'id' => (int) $_GET['c'],
  'slug' => mswSlug($_GET['c'])
));

if (!isset($CAT->id)) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// Is this a password protected category?
if ($CAT->user && $CAT->pass && $SSN->active('cat-' . $CAT->id) == 'no') {
  $tmpLoad = 'login';
}

// Title..
if (!in_array($CAT->metat, array(null,''))) {
  $sysTitle = $CAT->metat;
  $metas['title'] = $sysTitle;
} else {
  $titlePrefix = $CAT->title;
  $metas['title'] = $titlePrefix;
}

// For pages..
$limit = $page * JNLS_PER_PAGE - (JNLS_PER_PAGE);
$numRows = $JNLS->getjournals(array('area' => 'category', 'id' => $CAT->id, 'limit' => $limit, 'page' => $page, 'count' => 'yes'));
if ($CAT->slug) {
  $url = $MODR->url(array(
    $MODR->config['slugs']['cat'] . '/' . $CAT->slug . '/{page}',
    'next='
  ));
} else {
  $url = $SETTINGS->ifolder . '?next=';
}

$metas['url'] = str_replace('{page}', $page, $url);

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

include(PATH . 'control/system/modules/_header.php');

$tpl = mswS3();
$tpl->assign('TEXT', array($msw_category5));
$tpl->assign('LTEXT', array(
  $msw_category,
  $msw_category2,
  $msw_category3,
  $msw_category4
));
$tpl->assign('CATEGORY', (array) $CAT);
$tpl->assign('CDATA', array(
  'title' => mswCD($CAT->title)
));

if (!isset($tmpLoad)) {
  $jnldata = $JNLS->getjournals(array('area' => 'category', 'id' => $CAT->id, 'limit' => $limit, 'page' => $page, 'lang' => array($msw_category6,$msw_category7,$msw_journal5,$msw_journal7,$msw_category8,$msw_category9,$msw_category10)));
  $tpl->assign('JOURNALS', $jnldata);
  $tpl->assign('PAGES', $PGS->display());
}

// Global..
include(PATH . 'control/system/global.php');

$tpl->display(THEME_FOLDER . '/' . (isset($tmpLoad) ? $tmpLoad : 'category') . '.tpl.php');

include(PATH . 'control/system/modules/_footer.php');

?>