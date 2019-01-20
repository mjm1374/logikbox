<?php

/* ADMIN SYSTEM MODULE
----------------------------------*/

$bName = basename(__file__);

if (!defined('PARENT')) {
  include(PATH . 'control/modules/header/403.php');
}

include(MSW_ADM_LANG . $bName);

include(PATH . 'templates/' . $bName);

?>