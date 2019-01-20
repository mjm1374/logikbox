<?php

/* SYSTEM LOADER
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/modules/header/403.php');
}

if (isset($_GET['ajax-ops'])) {
  $cmd = 'ajax-ops';
}

// Load modules..
if (in_array($cmd, array(
  'ajax-ops'
))) {
  if (in_array($_GET['ajax-ops'], array('login'))) {
    $skipLogin = true;
  }
  if (!isset($skipLogin)) {
    mswPerms($mswUser, $cmd);
  }
  include(PATH . 'control/modules/ajax.php');
  exit;
} else {
  if ($cmd != 'login') {
    mswPerms($mswUser, $cmd);
  }
  if (isset($mswSysLinks)) {
    $linkPerms = mswAL($mswSysLinks, $cmd);
    if ($linkPerms) {
      if (file_exists(PATH . 'control/modules/' . $cmd . '.php')) {
        define('LOAD_VER', 1);
        include(PATH . 'control/modules/' . $cmd . '.php');
        exit;
      } else {
        echo '[FATAL ERROR] &quot;<b>control/modules/' . $cmd . '.php</b>&quot; file is missing or invalid. Load terminated.';
        exit;
      }
    }
  }
}

include(PATH . 'control/modules/header/403.php');

?>