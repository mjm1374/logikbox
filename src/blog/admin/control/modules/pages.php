<?php

/* ADMIN SYSTEM MODULE
----------------------------------*/

$bName = basename(__file__);

if (!defined('PARENT') || !isset($mswUser) || mswPagePerms(substr($bName, 0, -4), $mswUser) == 'no') {
  include(PATH . 'control/modules/header/403.php');
}

include(MSW_ADM_LANG . $bName);

$fjs[] = 'textarea';
$pagePrefix = $msw_adm_header9;

if (isset($_GET['id'])) {
  $pagePrefix = $msw_adm_pages13;
  $ID = (int) $_GET['id'];
  $Q  = $DB->db_query("SELECT * FROM `" . DB_PREFIX . "pages` WHERE `id` = '{$ID}'");
  $ED = $DB->db_object($Q);
  if (!isset($ED->id)) {
    include(PATH . 'control/modules/header/403.php');
  }
}

include(PATH . 'templates/header.php');
include(PATH . 'templates/' . $bName);
include(PATH . 'templates/footer.php');

?>