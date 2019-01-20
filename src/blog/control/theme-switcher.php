<?php

/* THEME SWITCHER
-------------------------------------*/

if (!defined('PARENT') || !isset($SETTINGS->id)) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

$theme = $SYS->theme();
if ($theme != 'none') {
  define('THEME_FOLDER', 'content/' . (is_dir(PATH . 'content/' . $theme) ? $theme : '_theme_default'));
} else {
  define('THEME_FOLDER', 'content/' . (is_dir(PATH . 'content/' . $SETTINGS->theme) ? $SETTINGS->theme : '_theme_default'));
}

?>