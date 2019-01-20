<?php

/* JOURNAL MODULE
----------------------------------*/

if (!defined('PARENT') || !isset($_GET['j'])) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

include(LANG_FLDR . 'journal.php');

$JOURNAL = $SYS->load(array(
  'section' => 'journal',
  'id' => (int) $_GET['j'],
  'slug' => mswSlug($_GET['j'])
));

if (!isset($JOURNAL->id)) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// Check data published..
if ($JOURNAL->pubts > $DT->ts()) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// Is this a password protected journal?
if ($JOURNAL->user && $JOURNAL->pass && $SSN->active('journal-' . $JOURNAL->id) == 'no') {
  $tmpLoad = 'login';
} else {
  // Is this a password protected journal via protected category?
  if ($JNLS->privcats($JOURNAL->id) == 'yes') {
    if ($SSN->active('journal-' . $JOURNAL->id) == 'no'){
      $tmpLoad = 'login';
      $privCat = 'yes';
    }
  } else {
    $loadJS[] = 'addthis';
  }
}

// Title..
if (!in_array($JOURNAL->metat, array(null,''))) {
  $sysTitle = $JOURNAL->metat;
  $metas['title'] = $sysTitle;
} else {
  $titlePrefix = $JOURNAL->title;
  $metas['title'] = $titlePrefix;
}

// Meta..
if ($JOURNAL->slug) {
  $metas['url'] = $MODR->url(array(
    $MODR->config['slugs']['jnl'] . '/' . $JOURNAL->slug,
    'j=' . $JOURNAL->id
  ));
} else {
  $metas['url'] = $SETTINGS->ifolder . '?j=' . $JOURNAL->id;
}

include(PATH . 'control/system/modules/_header.php');

$tpl = mswS3();
$tpl->assign('TEXT', array(
  $msw_journal6,
  $msw_journal8
));
$tpl->assign('LTEXT', array(
  (isset($privCat) ? $msw_journal11 : $msw_journal),
  $msw_journal2,
  $msw_journal3,
  $msw_journal4,
  $msw_journal7
));
$tpl->assign('JDATA', array(
  'journal' => mswBB($JOURNAL->comms, $SETTINGS, $BB),
  'title' => mswCD($JOURNAL->title),
  'tags' => $JNLS->tags(array('tags' => $JOURNAL->tags, 'id' => $JOURNAL->id)),
  'private' => ($JOURNAL->user && $JOURNAL->pass ? 'yes' : 'no'),
  'staff' => $JNLS->staff(array('id' => $JOURNAL->id, 'staff' => $JOURNAL->staff, 'lang' => array($msw_journal5))),
  'pubdate' => date($SETTINGS->dateformat, $JOURNAL->pubts),
  'pubtime' => date($SETTINGS->timeformat, $JOURNAL->pubts),
  'disqus' => $SCL->disqus(array('id' => $JOURNAL->id, 'slug' => $JOURNAL->slug))
));
$tpl->assign('JOURNAL', (array) $JOURNAL);
$tpl->assign('CATEGORIES', $JNLS->jcats($JOURNAL->id));

// Global..
include(PATH . 'control/system/global.php');

$tpl->display(THEME_FOLDER . '/' . (isset($tmpLoad) ? $tmpLoad : 'journal') . '.tpl.php');

include(PATH . 'control/system/modules/_footer.php');

?>