<?php

/* SYSTEM OPS - CRON
--------------------------------------------*/

date_default_timezone_set('UTC');

define('PARENT', 1);
define('PATH', substr(dirname(__file__), 0, strpos(dirname(__file__), 'control')-1) . '/');

include(PATH . 'control/classes/class.session.php');
$SSN = new sessHandlr();

include(PATH . 'control/userdef.php');
include(PATH . 'control/connect.php');
include(PATH . 'control/functions.php');
include(PATH . 'control/system/constants.php');
include(PATH . 'control/system/init.php');

/* AUTO DELETE CATEGORIES
--------------------------------------------*/

$r = $JNLS->cronjobs(array('op' => 'cats', 'lang' => $msw_cron4));

/* AUTO DELETE JOURNALS
--------------------------------------------*/

$r .= $JNLS->cronjobs(array('op' => 'journals', 'lang' => $msw_cron4));

/* ACTIVATE UNPUBLISHED JOURNALS
--------------------------------------------*/

$r .= $JNLS->cronjobs(array('op' => 'publish', 'lang' => $msw_cron4));

if ($r) {
  $CACHE->clear_cache();
  echo '[' . date('j F Y @ H:iA') . '] ' . $msw_cron2 . mswNL() . mswNL() . $r . mswNL() . str_repeat('-=', 50) . mswNL();
} else {
  echo '[' . date('j F Y @ H:iA') . '] ' . $msw_cron3 . mswNL() . str_repeat('-=', 50) . mswNL();
}
exit;

?>