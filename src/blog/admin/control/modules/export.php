<?php

/* ADMIN SYSTEM MODULE
----------------------------------*/

$bName = basename(__file__);

if (!defined('PARENT') || !isset($mswUser) || mswPagePerms(substr($bName, 0, -4), $mswUser) == 'no') {
  include(PATH . 'control/modules/header/403.php');
}

include(MSW_ADM_LANG . $bName);

$fjs[] = 'datepicker';
$mswPick = array(
  'lang' => $DT->jslang($msw_cal),
  'time' => 'false'
);
$pagePrefix = $msw_adm_headers15;

include(PATH . 'templates/header.php');
include(PATH . 'templates/' . $bName);
include(PATH . 'templates/footer.php');

?>