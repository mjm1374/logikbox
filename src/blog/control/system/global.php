<?php

/* GLOBAL VARS
   Sent to all.tpl.php template files
-----------------------------------------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

$metaData = array(
  'lang' => (isset($msw_html_lang) ? $msw_html_lang : 'en'),
  'dir' => (isset($msw_html_dir) ? $msw_html_dir : 'ltr'),
  'charset' => (isset($msw_html_charset) ? $msw_html_charset : 'utf-8'),
  'basehref' => (isset($SETTINGS->ifolder) ? $SETTINGS->ifolder : ''),
  'themefolder' => (defined('THEME_FOLDER') ? THEME_FOLDER . '/' : 'content/_theme_default/'),
  'title' => (isset($titlePrefix) ? mswSH($titlePrefix) . ': ' : '') . (isset($sysTitle) ? mswSH($sysTitle) : ''),
  'keys' => mswSH((isset($msw_meta_keys) ? $msw_meta_keys : (isset($SETTINGS->metakeys) ? $SETTINGS->metakeys : ''))),
  'desc' => mswSH((isset($msw_meta_desc) ? $msw_meta_desc : (isset($SETTINGS->metadesc) ? $SETTINGS->metadesc : '')))
);

if (defined('SAV3_PATH')) {
  $tpl->addPath('template', SAV3_PATH);
}

if (RETAIN_CAL_MONTH_ON_LOAD && isset($SSN) && method_exists($SSN, 'active') && $SSN->active('mswcal') == 'yes') {
  $vcval = $SSN->get('mswcal');
  if ($vcval) {
    $chop = explode(',', $vcval);
    if (isset($chop[0], $chop[1])) {
      $setCalMonth = $chop[0];
      $setCalYear = $chop[1];
    }
    if (isset($setCalMonth, $setCalYear)) {
      $SSN->set(array('calendar-ts' => strtotime($setCalYear . '-' . $setCalMonth . '-01')));
    }
  }
} else {
  if (isset($SSN, $DT) && method_exists($SSN, 'set') && method_exists($DT, 'ts')) {
    $SSN->set(array('calendar-ts' => $DT->ts()));
  }
}

if (isset($DT) && method_exists($DT, 'ts')) {
  if (!isset($msw_archive)) {
    include(LANG_FLDR . 'archive.php');
  }
  $cal = array(
    'days' => $msw_calendar3,
    'month' => (isset($setCalMonth) ? $setCalMonth : date('m', $DT->ts())),
    'year' => (isset($setCalYear) ? $setCalYear : date('Y', $DT->ts())),
    'month_long_txt' => $msw_calendar,
    'month_short_txt' => $msw_calendar2,
    'lang' => array(
      $msw_calendar4,
      $msw_calendar5,
      $msw_calendar6
    )
  );
  $tpl->assign('TODAY', date('dmY', $DT->ts()));
  $tpl->assign('GTEXT', array($msw_calendar7,$msw_calendar8,$msw_calendar9));
  $tpl->assign('SELECT', array(
    'years' => $HTML->select(array('area' => 'years', 'm' => (isset($cal['month']) ? $cal['month'] : ''), 'y' => (isset($cal['year']) ? $cal['year'] : ''))),
    'months' => $HTML->select(array('area' => 'months', 'months' => $msw_calendar, 'm' => (isset($cal['month']) ? $cal['month'] : ''), 'y' => (isset($cal['year']) ? $cal['year'] : '')))
  ));
  $tpl->assign('GOPS', array(
    'creset' => (date('Y-m', $DT->ts()) != $cal['year'] . '-' . $cal['month'] ? 'yes' : 'no')
  ));
  $sspanel = $SSN->get('panel-state');
}
// Build rss link..
$rss_url = '';
if (isset($MODR) && method_exists($MODR, 'url')) {
  $rss_url = $MODR->url(array(
    $MODR->config['slugs']['rss'],
    'rss=yes'
  ));
}
$tpl->assign('RSS_LINK', $rss_url);
$tpl->assign('SOCIAL', (isset($HTML) && method_exists($HTML, 'social') ? $HTML->social(array('lang' => array($msw_common10))) : ''));
$tpl->assign('BOXES', (isset($HTML) && method_exists($HTML, 'boxes') ? $HTML->boxes() : ''));
$tpl->assign('CALENDAR', (isset($HTML) && method_exists($HTML, 'calendar') ? $HTML->calendar($cal) : ''));
$tpl->assign('RECENT_JOURNALS', (isset($JNLS) && method_exists($JNLS, 'recent') ? $JNLS->recent(array('limit' => $recLimit, 'loaded' => (defined('RECENT_LOADED') ? RECENT_LOADED : ''))) : ''));
$tpl->assign('META', $metaData);
$tpl->assign('SETTINGS', (isset($SETTINGS->id) ? (array) $SETTINGS : array()));

// Off canvas menu..
$tpl->assign('NAV_STATE', array(
  (isset($sspanel) && $sspanel == '0' ? ' in' : (!isset($sspanel) || $sspanel == '' ? ' in' : '')),
  (isset($sspanel) && $sspanel == '1' ? ' in' : ''),
  (isset($sspanel) && $sspanel == '2' ? ' in' : '')
));
$tpl->assign('NAV_PAGES', (isset($HTML) && method_exists($HTML, 'pages') ? $HTML->pages() : ''));
$tpl->assign('NAV_CATEGORIES', (isset($HTML) && method_exists($HTML, 'categories') ? $HTML->categories() : ''));
$tpl->assign('NAV_ARCHIVE', (isset($HTML) && method_exists($HTML, 'archive')  ? $HTML->archive(array('c' => $msw_calendar)) : ''));

// Platform detection..
$tpl->assign('MBDX', (isset($PDTC) && method_exists($PDTC, 'isMobile') ? $PDTC : ''));

?>