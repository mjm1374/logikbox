<?php

function mswInsLog($table, $error, $code, $line, $file, $db, $type = 'Create') {
  $header = '';
  if (MSW_INSTALL_LOG) {
    if (!file_exists(REL_PATH . 'logs/' . MSW_INSTALL_LOG_FILE)) {
      $header = 'Script: ' . SCRIPT_NAME . mswNL();
      $header .= 'Script Version: ' . SCRIPT_VERSION . mswNL();
      $header .= 'PHP Version: ' . phpVersion() . mswNL();
      $header .= 'DB Version: ' . $db->db_version() . mswNL();
      if (isset($_SERVER['SERVER_SOFTWARE'])) {
        $header .= 'Server Software: ' . $_SERVER['SERVER_SOFTWARE'] . mswNL();
      }
      if (isset($_SERVER["HTTP_USER_AGENT"])) {
        if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'win')) {
          $platform = 'Windows';
        } else if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mac')) {
          $platform = 'Mac';
        } else {
          $platform = 'Other';
        }
        $header .= 'Platform: ' . $platform . mswNL();
      }
      $header .= '=================================================================================' . mswNL();
    }
    $string = 'Table: ' . $table . mswNL();
    $string .= 'Operation: ' . $type . mswNL();
    $string .= 'Error Code: ' . $code . mswNL();
    $string .= 'Error Msg: ' . $error . mswNL();
    $string .= 'On Line: ' . $line . mswNL();
    $string .= 'In File: ' . $file . mswNL();
    $string .= '- - - - - - - - - - - - - - - - - - - - - ' . mswNL();
    @file_put_contents(REL_PATH . 'logs/' . MSW_INSTALL_LOG_FILE, $header . $string, FILE_APPEND);
  }
}

// Generates 60 character product key..
$_SERVER['HTTP_HOST']   = (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : uniqid(rand(), 1));
$_SERVER['REMOTE_ADDR'] = (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : uniqid(rand(), 1));
$c1                     = sha1($_SERVER['HTTP_HOST'] . date('YmdHis') . $_SERVER['REMOTE_ADDR'] . time());
$c2                     = sha1(uniqid(rand(), 1) . time());
$prodKey                = substr($c1 . $c2, 0, 60);
$prodKey                = strtoupper($prodKey);

?>