<?php

/* SYSTEM LOADER
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

if (isset($_GET['c'])) {
  $cmd = 'category';
}

if (isset($_GET['a'])) {
  $cmd = 'archive';
}

if (isset($_GET['cl'])) {
  $cmd = 'archive-cal';
}

if (isset($_GET['j'])) {
  $cmd = 'journal';
}

if (isset($_GET['q'])) {
  $cmd = 'search';
}

if (isset($_GET['pg'])) {
  $cmd = 'pages';
}

if (isset($_GET['rss'])) {
  $cmd = 'rss';
}

if (isset($_GET['ajax-ops'])) {
  include(PATH . 'control/system/ajax.php');
  exit;
}

if (in_array($cmd, array(
  'dashboard', 'category', 'archive', 'journal', 'search', 'pages', 'rss', 'archive-cal'
))) {
  if (file_exists(PATH . 'control/system/modules/' . $cmd . '.php')) {
    include(PATH . 'control/system/modules/' . $cmd . '.php');
  } else{
    include(PATH . 'control/system/headers/403.php');
  }
} else {
  include(PATH . 'control/system/headers/403.php');
}

?>