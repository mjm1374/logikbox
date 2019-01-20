<?php

/* STRUCTURED META DATA
   Facebook Open Graph
   Twitter Cards
   Google+ Schema.org
---------------------------------------*/


if (!defined('PARENT')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

// Defaults..
$twPar = $SCL->params('twitter');
$mswMetaData = $SCL->structured(array(
  'fb' => array(
    'site' => mswSH($SETTINGS->website),
    'url' => (isset($metas['url']) && $metas['url'] ? $metas['url'] : $SETTINGS->ifolder),
    'title' => (isset($metas['title']) && $metas['title'] ? $metas['title'] : mswSH($SETTINGS->website)),
    'desc' => (isset($metas['desc']) && $metas['desc'] ? $metas['desc'] : mswSH($SETTINGS->metadesc)),
    'image' => (isset($metas['img']) && $metas['img'] ? $metas['img'] : $SETTINGS->ifolder . THEME_FOLDER . '/images/social-facebook.png'),
    'img-path' => (isset($metas['imgpath']) && $metas['imgpath'] ? $metas['imgpath'] : PATH . THEME_FOLDER . '/images/social-facebook.png')
  ),
  'tw' => array(
    'user' => (isset($twPar['twitter']['username']) ? $twPar['twitter']['username'] : ''),
    'title' => (isset($metas['title']) && $metas['title'] ? $metas['title'] : mswSH($SETTINGS->website)),
    'desc' => (isset($metas['desc']) && $metas['desc'] ? $metas['desc'] : mswSH($SETTINGS->metadesc)),
    'image' => (isset($metas['img']) && $metas['img'] ? $metas['img'] : $SETTINGS->ifolder . THEME_FOLDER . '/images/social-twitter.png')
  ),
  'gg' => array(
    'title' => (isset($metas['title']) && $metas['title'] ? $metas['title'] : mswSH($SETTINGS->website)),
    'desc' => (isset($metas['desc']) && $metas['desc'] ? $metas['desc'] : mswSH($SETTINGS->metadesc)),
    'image' => (isset($metas['img']) && $metas['img'] ? $metas['img'] : $SETTINGS->ifolder . THEME_FOLDER . '/images/social-google.png')
  ))
);

?>