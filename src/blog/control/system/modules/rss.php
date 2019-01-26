<?php

/* RSS MODULE
----------------------------------*/

if (!defined('PARENT') || !isset($_GET['rss'])) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

include(LANG_FLDR . 'journal.php');
include(LANG_FLDR . 'rss.php');
include(LANG_FLDR . 'category.php');

// Is RSS cached?
$mCache = $CACHE->cache_link('journal-rss');
if ($CACHE->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
  if ($CACHE->cache_exp($CACHE->cache_time($mCache)) == 'load') {
    header('Content-Type: text/xml');
    echo mswTmp($mCache);
    exit;
  }
}

include(PATH .'control/classes/class.rss.php');
$RSS           = new rss();
$RSS->rwr      = $MODR;
$RSS->cache    = $CACHE;
$RSS->settings = $SETTINGS;

$url = $MODR->url(array(
  $MODR->config['slugs']['rss'],
  'rss=yes'
));

// RSS - Start build..
$build = $RSS->open();

// RSS - Feed info..
$build .= $RSS->info(array(
  'title' => str_replace('{website}', mswCD($SETTINGS->website), $msw_rss),
  'link' => $url,
  'date' => RSS_BUILD_DATE_FORMAT,
  'desc' => str_replace('{website}', mswCD($SETTINGS->website), $msw_rss2),
  'site' => mswCD($SETTINGS->website)
));

// RSS - Latest journals..
$recent = $JNLS->getjournals(array('area' => 'rss'));
if (!empty($recent)) {
  for ($i=0; $i<count($recent); $i++) {
    if ($recent[$i]->slug) {
      $url = $MODR->url(array(
        $MODR->config['slugs']['jnl'] . '/' . $recent[$i]->slug,
        'j=' . $recent[$i]->id
      ));
    } else {
      $url = $SETTINGS->ifolder . '?j=' . $recent[$i]->id;
    }
    $private = ($recent[$i]->user && $recent[$i]->pass ? 'yes' : 'no');
    // Is journal private via category?
    if ($private == 'no') {
      if ($JNLS->privcats($recent[$i]->id) == 'yes') {
        $private = 'yes';
        $privCat = 'yes';
      }
    }
    $privateIcon = $private;
    $build .= $RSS->add(array(
      'title' => mswCD($recent[$i]->title),
      'link' => $url,
      'date' => $recent[$i]->rss,
      'desc' => ($private == 'yes' ? str_replace('{url}', $url, (isset($privCat) ? $msw_category8 : $msw_category6)) : mswBB($recent[$i]->comms, $SETTINGS, $BB)),
      'footer' => $JNLS->staff(array(
        'id' => $recent[$i]->id,
        'staff' => $recent[$i]->staff,
        'lang' => array($msw_journal5))
      ) . ' / ' . date($SETTINGS->dateformat,  $recent[$i]->pubts) . ', ' . date($SETTINGS->timeformat, $recent[$i]->pubts)
    ));
  }
}

// RSS - Close build..
$build .= $RSS->close();

// RSS - Update cache if enabled..
$CACHE->cache_file($mCache, mswCD(trim($build)));

// RSS - Output..
header('Content-Type: text/xml');
echo mswCD(trim($build));
exit;

?>