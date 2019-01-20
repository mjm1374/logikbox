<?php

/* ADMIN SYSTEM MODULE
----------------------------------*/

$bName = basename(__file__);

if (!defined('PARENT') || !isset($mswUser) || mswPagePerms(substr($bName, 0, -4), $mswUser) == 'no') {
  include(PATH . 'control/modules/header/403.php');
}

include(MSW_ADM_LANG . $bName);

$fjs[] = 'textarea';
$fjs[] = 'datepicker';
$mswPick = array(
  'lang' => $DT->jslang($msw_cal),
  'time' => 'true'
);
$pagePrefix = $msw_adm_headers21;

include(PATH . 'templates/header.php');
include(PATH . 'templates/' . $bName);
include(PATH . 'templates/footer.php');

?>