<?php

if (!isset($_GET['ajax-ops']) || !defined('PARENT')) {
  exit;
}

$arr = array('status' => 'err', 'txt' => array('System Error', 'An error has occurred. Enable error logging in "install/control/config.php" and run again. Check the error log in the "logs" folder.<br><br>If install logging isn`t enabled, enable it in "install/control/config.php".'));

switch($_GET['ajax-ops']) {
  case 'install':
    // Set timezone for installer..
    @date_default_timezone_set($_POST['timezone']);
    define('INSTALL_RUN', 1);
    include(PATH . 'control/tables.php');
    if ($count > 0) {
      $arr['txt'][1] = 'One or more database tables could not be installed. Enable error logging in "install/control/config.php" and run again. Check the error log in the "logs" folder.<br><br>If install logging isn`t enabled, enable it in "install/control/config.php".';
    } else {
      include(PATH . 'control/data.php');
      if ($dtcount > 0) {
        $arr['txt'][1] = 'The database errored when installing the default system data. Enable error logging in "install/control/config.php" and run again. Check the error log in the "logs" folder.<br><br>If install logging isn`t enabled, enable it in "install/control/config.php".';
      } else {
        if (isset($_POST['demo'])) {
          include(PATH . 'control/demo.php');
          if ($dcount > 0) {
            $arr['txt'][1] = 'An error occurred when installing the demo system. Enable error logging in "install/control/config.php" and run again. Check the error log in the "logs" folder.<br><br>If install logging isn`t enabled, enable it in "install/control/config.php".';
          }
        }
        if ($count == 0) {
          $arr['status'] = 'ok';
          $arr['txt'] = array('Installation Successful', '<b>' . SCRIPT_NAME . '</b> installed with no errors and the software is ready to use.<br><br>Please refer to the installation instructions for more info and login details etc.<br><br>I hope you enjoy your new system.');
        }
      }
    }
    break;
}

echo $JSON->encode($arr);
exit;

?>