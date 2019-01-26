<?php

/* USER DEFINED OPTION
   Please read carefully. Change ONLY value on right
========================================================================*/

/* COOKIE OPTIONS
   Enable remember me option on login (sets cookie)
   Set cookie duration for expiration
-------------------------------------------------------*/

define('ENABLE_LOGIN_COOKIE', 1);
define('LOGIN_COOKIE_DURATION', 30);

/* SKIP USERS FOR ENTRY LOG
   Comma delimited list of staff ID numbers.
   OR 0 for control/access.php user
-------------------------------------------------------*/

define('SKIP_ELOG_USRS', '');

/* VERSION CHECK / HELP LINKS
   Enable version check and docs link. 1 = Yes, 0 = No
-------------------------------------------------------*/

define('ENABLE_VERSION_CHECK', 1);
define('ENABLE_HELP_LINK', 1);

/* SECURE PASSWORD LENGTH
   Length for secure password for auto password creation
-------------------------------------------------------*/

define('SECURE_PASS_LENGTH', 15);

/* LATEST JOURNALS
   How many latest journals to show on admin dashboard
-------------------------------------------------------*/

define('LATEST_DASHBOARD_JOURNALS', 10);

/* DEFAULT OFF CANVAS PANEL SECTION
   On load this panel will be expanded.
   Can be any key value for menu in control/arrays.php
-------------------------------------------------------*/

define('DEF_OPEN_MENU_PANEL', 'one');

/* SLUG WORD LIMIT
   If word length equals this it will be ignored
-------------------------------------------------------*/

define('SLUG_WORD_LIMIT', 2);

/* IP LOOKUP
   Use {ip} where IP needs to appear in url.
-------------------------------------------------------*/

define('IP_LOOKUP', 'http://whatismyipaddress.com/ip/{ip}');

/* DATE/TIME DELIMITER
   For display only
-------------------------------------------------------*/

define('DT_DIVIDER', ', ');

/* PERMISSIONS DELIMITER
   Do not change
-------------------------------------------------------*/

define('PERMS_DELIMITER', '<##>');

/* FOLDER PATHS
   Do not change
-------------------------------------------------------*/

$last_fldr = basename(substr(dirname(__file__), 0, strpos(dirname(__file__), 'control')-1));
define('REL_PATH', substr(dirname(__file__), 0, strpos(dirname(__file__), 'control')-strlen($last_fldr)-2) . '/');
define('LANG_BASE_PATH', REL_PATH . 'content/language/');

?>