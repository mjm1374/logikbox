<?php

/* ERROR PAGE MODULE
----------------------------------*/

if (defined('PARENT') && defined('THEME_FOLDER')) {
  $tpl = mswS3();

  // Global..
  include(PATH . 'control/system/global.php');

  $tpl->assign('TEXT', $msw_err_headers);
  $tpl->display(THEME_FOLDER . '/error_pages/500.tpl.php');
} else {
  header('HTTP/1.0 500 Internal Server Error');
  header('Content-type: text/html; charset=utf-8');
  echo '<h1>Internal Server Error</h1>';
  echo '<a href="index.php">Return to Website</a>';
}

?>
