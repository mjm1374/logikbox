<?php

/* ADMIN SYSTEM MODULE
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/modules/header/403.php');
}

$pagePrefix = 'Purchase';

include(PATH . 'templates/header.php');
include(PATH . 'templates/purchase.php');
include(PATH . 'templates/footer.php');

?>