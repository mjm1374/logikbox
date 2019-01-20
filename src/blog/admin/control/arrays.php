<?php

/* NAV MENU
------------------------------------------------*/

$mswSysLinks = array(
  'one' => array(
    'txt' => $msw_adm_nav,
    'icon' => 'pencil',
    'links' => array(
      'add' => $msw_adm_nav5,
      'manage' => $msw_adm_nav6,
      'cat' => $msg_adm_nav16
    )
  ),
  'two' => array(
    'txt' => $msw_adm_nav2,
    'icon' => 'users',
    'links' => array(
      'staff' => $msw_adm_nav7
    )
  ),
  'three' => array(
    'txt' => $msw_adm_nav3,
    'icon' => 'desktop',
    'links' => array(
      'pages' => $msw_adm_nav10,
      'boxes' => $msw_adm_nav11,
      'themes' => $msg_adm_nav20
    )
  ),
  'four' => array(
    'txt' => $msw_adm_nav4,
    'icon' => 'cog',
    'links' => array(
      'settings' => $msw_adm_nav12,
      'email' => $msw_adm_nav13,
      'social' => $msg_adm_nav17,
      'offline' => $msg_adm_nav19
    )
  ),
  'five' => array(
    'txt' => $msw_adm_nav8,
    'icon' => 'wrench',
    'links' => array(
      'export' => $msw_adm_nav15,
      'backup' => $msw_adm_nav14,
      'elog' => $msg_adm_nav18
    )
  )
);


/* JAVASCRIPT CALENDAR FORMATS
   DO NOT change
--------------------------------------------------------------*/

$jsCalFormat = array(
  'dd-mm-yyyy',
  'dd/mm/yyyy',
  'yyyy-mm-dd',
  'yyyy/mm/dd',
  'mm-dd-yyyy',
  'mm/dd/yyyy'
);


/* ADDITIONAL PASSWORD CHARACTER ARRAY
   If set, added to array for auto pass generation
--------------------------------------------------------------*/

$addPassChars = array(
  '@','+'
);

?>