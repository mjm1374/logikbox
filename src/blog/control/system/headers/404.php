<?php

/* ERROR PAGE MODULE
----------------------------------*/

if (defined('PARENT') && defined('THEME_FOLDER')) {
  $tpl = mswS3();

  // Global..
  include(PATH . 'control/system/global.php');

  $tpl->assign('TEXT', $msw_err_headers);
  $tpl->display(THEME_FOLDER . '/error_pages/404.tpl.php');
} else {
  header('HTTP/1.0 404 Not Found');
  header('Content-type: text/html; charset=utf-8');
  echo '<h1>Page Not Found..</h1>';
  echo '<a href="index.php">Return to Website</a>';
}

?>
