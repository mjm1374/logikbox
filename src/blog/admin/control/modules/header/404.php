<?php

/* HEADER FILE
----------------------------------*/

if (!defined('WINPARENT')) {
  define('WINPARENT', 1);
}

define('PATH_ERR', substr(dirname(__file__), 0, strpos(dirname(__file__), 'control')-1) . '/');

$pageTitle = '404';

include(PATH_ERR . 'templates/windows/header.php');
include(PATH_ERR . 'templates/windows/404.php');
include(PATH_ERR . 'templates/windows/footer.php');
exit;

?>
