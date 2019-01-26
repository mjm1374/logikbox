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
$pagePrefix = $msw_adm_header6;

if (isset($_GET['id'])) {
  $pagePrefix = $msw_adm_add19;
  $ID = (int) $_GET['id'];
  $Q  = $DB->db_query("SELECT * FROM `" . DB_PREFIX . "journals` WHERE `id` = '{$ID}'");
  $ED = $DB->db_object($Q);
  if (!isset($ED->id)) {
    include(PATH . 'control/modules/header/403.php');
  }
}

include(PATH . 'templates/header.php');
include(PATH . 'templates/' . $bName);
include(PATH . 'templates/footer.php');

?>