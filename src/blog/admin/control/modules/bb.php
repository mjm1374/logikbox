<?php

/* ADMIN SYSTEM MODULE
----------------------------------*/

if (!defined('PARENT')) {
  include(PATH . 'control/modules/header/403.php');
}

$bName = basename(__file__);

include(MSW_ADM_LANG . $bName);

$pagePrefix = $msw_adm_headers18;

include(PATH . 'templates/header.php');
include(PATH . 'templates/bbcode.php');
include(PATH . 'templates/footer.php');

?>