<?php

/* ADMIN SYSTEM MODULE
----------------------------------*/

if (!defined('LOAD_VER')) {
  include(PATH . 'control/modules/header/403.php');
}

if ($SSN->active('adm_menu_panel') == 'yes') {
  $SSN->delete(array('adm_menu_panel'));
}

$bName = basename(__file__);

include(MSW_ADM_LANG . $bName);
include(MSW_ADM_LANG . 'manage.php');

$fjs[] = 'chartist';
$pagePrefix = $msw_adm_headers17;

include(PATH . 'templates/header.php');
if (isset($mswUser[2]['id']) && file_exists(PATH . 'templates/dashboard-' . $mswUser[2]['id'] . '.php')) {
  include(PATH . 'templates/dashboard-' . $mswUser[2]['id'] . '.php');
} else {
  include(PATH . 'templates/' . $bName);
}
include(PATH . 'templates/footer.php');

?>