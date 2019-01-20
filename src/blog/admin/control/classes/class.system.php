<?php

/* CLASS FILE
----------------------------------*/

class mswsys extends db {

  public $dt;
  public $cache;
  public $settings;

  public function config($fm) {
    db::db_query("UPDATE `" . DB_PREFIX . "settings` SET
    `website`    = '" . mswSQL($fm['website']) . "',
    `email`      = '" . mswSQL($fm['email']) . "',
    `metadesc`   = '" . mswSQL($fm['metak']) . "',
    `metakeys`   = '" . mswSQL($fm['metad']) . "',
    `language`   = '{$fm['language']}',
    `ifolder`    = '" . mswSQL($fm['ifolder']) . "',
    `dateformat` = '" . mswSQL($fm['dateformat']) . "',
    `timeformat` = '" . mswSQL($fm['timeformat']) . "',
    `timezone`   = '{$fm['timezone']}',
    `calformat`  = '{$fm['calformat']}',
    `weekstart`  = '{$fm['weekstart']}',
    `afoot`      = '" . (defined('LICENCE_VER') && LICENCE_VER == 'unlocked' ? mswSQL($fm['afoot']) : '') . "',
    `pfoot`      = '" . (defined('LICENCE_VER') && LICENCE_VER == 'unlocked' ? mswSQL($fm['pfoot']) : '') . "',
    `modr`       = '{$fm['modr']}',
    `apikey`     = '" . mswSQL($fm['apikey']) . "',
    `apilog`      = '{$fm['apilog']}',
    `cache`      = '{$fm['cache']}',
    `cachetime`  = '{$fm['cachetime']}',
    `defcats`    = '" . mswSQL($fm['cats']) . "'
    ");
    // Clear all cache files
    $this->cache->clear_cache();
  }

  public function email($fm) {
    db::db_query("UPDATE `" . DB_PREFIX . "settings` SET
    `addemails`     = '" . mswSQL($fm['addemails']) . "',
	  `smtp_host`     = '" . mswSQL($fm['smtp_host']) . "',
    `smtp_user`     = '" . mswSQL($fm['smtp_user']) . "',
    `smtp_pass`     = '" . mswSQL($fm['smtp_pass']) . "',
    `smtp_port`     = '{$fm['smtp_port']}',
    `smtp_from`     = '" . mswSQL($fm['smtp_from']) . "',
    `smtp_email`    = '" . mswSQL($fm['smtp_email']) . "',
    `smtp_rfrom`    = '" . mswSQL($fm['smtp_rfrom']) . "',
    `smtp_remail`   = '" . mswSQL($fm['smtp_remail']) . "',
    `smtp_security` = '{$fm['smtp_security']}',
    `smtp_debug`    = '{$fm['smtp_debug']}'
    ");
  }

  public function offline($fm) {
    db::db_query("UPDATE `" . DB_PREFIX . "settings` SET
    `sysstatus`  = '" . mswSQL($fm['sysstatus']) . "',
    `reason`     = '" . mswSQL($fm['reason']) . "',
    `autoenable` = '" . $this->dt->jstots($fm['autoenable'], true) . "'
    ");
  }

  public function social() {
    db::db_truncate(array('social'), true);
    foreach (array_keys($_POST['fm']) AS $k) {
      foreach ($_POST['fm'][$k] AS $sK => $sV) {
        if ($sV) {
          db::db_query("INSERT INTO `" . DB_PREFIX . "social` (
          `desc`,
          `param`,
          `value`
          ) VALUES (
          '" . mswSQL($k) . "',
          '" . mswSQL($sK) . "',
          '" . mswSQL($sV) . "'
          )");
        }
      }
    }
    // Clear cache file..
    $this->cache->clear_cache_file('social');
  }

  public function themes($fm) {
    db::db_query("UPDATE `" . DB_PREFIX . "settings` SET
    `theme`   = '" . mswSQL($fm['theme']) . "',
    `entheme` = '" . mswSQL($fm['entheme']) . "'
    ");
    db::db_truncate(array('themes'), true);
    for ($i=0; $i<count($fm['thm']); $i++){
      if ($fm['thm'][$i] && $fm['from'][$i] && $fm['to'][$i]) {
        db::db_query("INSERT INTO `" . DB_PREFIX . "themes` (
        `theme`,
        `from`,
        `to`
        ) VALUES (
        '" . mswSQL($fm['thm'][$i]) . "',
        '" . $this->dt->jstots($fm['from'][$i]) . "',
        '" . $this->dt->jstots($fm['to'][$i]) . "'
        )");
      }
    }
  }

  public function elog($usr) {
    db::db_query("INSERT INTO `" . DB_PREFIX . "elog` (
    `user`,
    `ts`,
    `ip`
    ) VALUES (
    '" . (int) $usr . "',
    '" . $this->dt->ts() . "',
    '" . mswSQL(mswIP()) . "'
    )");
  }

  // Check for new version..
  public function version() {
    $url = 'https://www.maianscriptworld.co.uk/version-check.php?id=' . SCRIPT_ID;
    $str = '';
    if (function_exists('curl_init')) {
      $ch = @curl_init();
      @curl_setopt($ch, CURLOPT_URL, $url);
      @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = @curl_exec($ch);
      @curl_close($ch);
      if ($result) {
        if ($result != $this->settings->version) {
          $str = 'Installed Version: ' . $this->settings->version . mswNL();
          $str .= 'Current Version: ' . $result . mswNL() . mswNL();
          $str .= '<i class="fa fa-times fa-fw"></i> Your version is out of date.' . mswNL() . mswNL();
          $str .= 'Download new version at:' . mswNL();
          $str .= '<a href="https://www.' . SCRIPT_URL . '/download.html" onclick="window.open(this);return false">www.' . SCRIPT_URL . '</a>';
        } else {
          $str = 'Current Version: ' . $this->settings->version . mswNL() . mswNL() . '<i class="fa fa-check fa-fw"></i> You are currently using the latest version';
        }
      }
    } else {
      if (@ini_get('allow_url_fopen') == '1') {
        $result = @file_get_contents($url);
        if ($result) {
          if ($result != $this->settings->version) {
            $str = 'Installed Version: ' . $this->settings->version . mswNL();
            $str .= 'Current Version: ' . $result . mswNL() . mswNL();
            $str .= '<i class="fa fa-times fa-fw"></i> Your version is out of date.' . mswNL() . mswNL();
            $str .= 'Download new version at:' . mswNL();
            $str .= '<a href="https://www.' . SCRIPT_URL . '/download.html" onclick="window.open(this);return false">www.' . SCRIPT_URL . '</a>';
          } else {
            $str = 'Current Version: ' . $this->settings->version . mswNL() . mswNL() . '<i class="fa fa-check fa-fw"></i> You are currently using the latest version';
          }
        }
      }
    }
    // Nothing?
    if ($str == '') {
      $str = 'Server check functions not available.' . mswNL() . mswNL();
      $str .= 'Please visit <a href="https://www.' . SCRIPT_URL . '/download.html" onclick="window.open(this);return false">www.' . SCRIPT_URL . '</a> to check for updates';
    }
    return $str;
  }

  function generate($l = 15, $add = array()) {
    $pass = '';
    $sec = array(
      'A',
      'B',
      'C',
      'D',
      'E',
      'F',
      'G',
      'H',
      'J',
      'K',
      '#',
      '[',
      ']',
      '&',
      '*',
      '(',
      ')',
      '#',
      '!',
      '%',
      'L',
      'M',
      'N',
      'O',
      'P',
      'Q',
      'R',
      'S',
      'T',
      'U',
      'V',
      'W',
      'X',
      'Y',
      'Z',
      'a',
      'b',
      'c',
      'd',
      'e',
      'f',
      'g',
      'h',
      'i',
      'j',
      'k',
      'l',
      'm',
      'n',
      'p',
      'q',
      'r',
      's',
      't',
      'u',
      'v',
      'w',
      'x',
      'y',
      'z',
      '2',
      '3',
      '4',
      '5',
      '6',
      '7',
      '8',
      '9',
      '#',
      '[',
      ']',
      '&',
      '*',
      '(',
      ')',
      '#',
      '!',
      '%'
    );
    if (!empty($add)){
      $sec = array_merge($sec, $add);
    }
    for ($i = 0; $i < count($sec); $i++) {
      $rand = rand(0, (count($sec) - 1));
      $char = $sec[$rand];
      $pass .= $char;
      if (strlen($pass) == $l){
        return $pass;
      }
    }
    return $pass;
  }

}

?>