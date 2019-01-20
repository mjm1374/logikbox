<?php

/* CONSTANTS
   Edit values on right, DO NOT change values in capitals
------------------------------------------------------------------------*/

define('SCRIPT_VERSION', '5.2');
define('MSW_PHP_MIN_VER', '5.5');
define('SCRIPT_NAME', 'Maian Weblog');
define('SCRIPT_URL', 'maianweblog.com');
define('SCRIPT_ID', 6);
define('SCRIPT_RELEASE_YR', '2003');
define('SCRIPT_DESC', 'PHP Blog System');

define('GLOBAL_PATH', substr(dirname(__file__), 0, strpos(dirname(__file__), 'control')-1) . '/');
define('AUTO_FILL_PATH', dirname(__file__));
define('MSW_PHP', (version_compare(PHP_VERSION, '7.1.0', '<') ? 'old' : 'new'));

?>