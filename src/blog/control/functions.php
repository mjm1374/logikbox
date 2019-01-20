<?php

/* FUNCTIONS
----------------------------------*/

function mswFCNV($size = 0, $precision = 2) {
  if ($size > 0) {
    $base     = log($size) / log(1024);
    $suffixes = array(
      'Bytes',
      'KB',
      'MB',
      'GB',
      'TB'
    );
    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
  } else {
    return '0Bytes';
  }
}

function mswKeys($k) {
  return preg_replace('/[^0-9a-zA-Z_\s]/', '', $k);
}

function mswSSL() {
  return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'yes' : 'no');
}

function mswSlug($data) {
  return preg_replace('/[^\w]-/', '', strtolower($data));
}

function mswTO($m = '100', $l = 0) {
  @ini_set('memory_limit', $m . 'M');
  @set_time_limit($l);
}

function mswBB($text, $s, $bb) {
  return (EN_BB ? $bb->bbParser($text) : (AUTO_PARSE_LINE_BREAKS ? mswL2BR(mswCD($text)) : mswCD($text)));
}

function mswEmVal($em) {
  if (function_exists('filter_var') && filter_var($em, FILTER_VALIDATE_EMAIL)) {
    return 'yes';
  } else {
    if (preg_match('/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}' .
      '[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/sD', $em)) {
      return 'yes';
    }
  }
  return 'no';
}

function mswLang($s) {
  $base = PATH . 'content/language/';
  return $base . $s->language . '/';
}

function mswS3() {
  $tpl = new Savant3();
  return $tpl;
}

function mswTmp($file, $silent = 'no') {
  if (file_exists($file)) {
    return trim(@file_get_contents($file));
  }
  return ($silent == 'no' ? $file . ' template is missing' : '');
}

function mswEnc($data) {
  return (function_exists('sha1') ? sha1($data) : md5($data));
}

function mswTZ($zne, $tzs) {
  date_default_timezone_set(($zne && in_array($zne, array_keys($tzs)) ? $zne : 'Europe/London'));
}

function mswIP($arr = false) {
  $ips = array();
  $types = array(
    'HTTP_CLIENT_IP',
    'HTTP_X_FORWARDED_FOR',
    'HTTP_X_FORWARDED',
    'HTTP_X_CLUSTER_CLIENT_IP',
    'HTTP_FORWARDED_FOR',
    'HTTP_FORWARDED',
    'REMOTE_ADDR'
  );
  foreach ($types AS $key) {
    if (array_key_exists($key, $_SERVER) === true) {
      foreach (array_map('trim', explode(',', $_SERVER[$key])) AS $ipA) {
        if (!in_array($ipA, $ips) && filter_var($ipA, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
          $ips[] = $ipA;
        } else {
          // Double check for localhost..
          if (!in_array($ipA, $ips) && in_array($ipA, array('::1','127.0.0.1'))) {
            $ips[] = $ipA;
          }
        }
      }
    }
  }
  if ($arr) {
    return $ips;
  }
  return (!empty($ips) ? implode(',', $ips) : '');
}

function mswNFM($num, $dec = 0) {
  return @number_format($num, $dec);
}

// New line to break..
function mswL2BR($text) {
  // Second param added in 5.3.0, else its not available..
  if (version_compare(phpversion(), '5.3.0', '<')) {
    return str_replace(mswNL(), '<br>', $text);
  }
  return nl2br($text, false);
}

function mswNL() {
  if (defined('PHP_EOL')) {
    return PHP_EOL;
  }
  $nl = "\r\n";
  if (isset($_SERVER["HTTP_USER_AGENT"]) && strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'win')) {
    $nl = "\r\n";
  } else if (isset($_SERVER["HTTP_USER_AGENT"]) && strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'mac')) {
    $nl = "\r";
  } else {
    $nl = "\n";
  }
  return $nl;
}

function mswMan($s, $db) {
  if ($s->version == 'manual') {
    $root = 'http://www.example.com/blog';
    $zone = 'Europe/London';
    if (isset($_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF'])) {
      $root = 'http' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], 'index.php') - 1) . '/';
    }
    $db->db_query("UPDATE `" . DB_PREFIX . "settings` SET
    `ifolder` = '" . mswSQL($root) . "',
    `version` = '" . SCRIPT_VERSION . "',
    `timezone` = '{$zone}',
    `prodkey` = '" . mswPK() . "'
    ");
    header("Location: index.php");
    exit;
  }
}

function mswQT($data) {
  $data = str_replace(array(
    '"'
  ), array(
    '&quot;'
  ), $data);
  return $data;
}

function mswSH($data) {
  $data = htmlspecialchars($data);
  $data = str_replace('&amp;#', '&#', $data);
  $data = str_replace('&amp;amp;', '&amp;', $data);
  return mswCD($data);
}

function mswCD($data) {
  if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
    $sybase = strtolower(@ini_get('magic_quotes_sybase'));
    if (empty($sybase) || $sybase == 'off') {
      // Fixes issue of new line chars not parsing between single quotes..
      $data = str_replace('\n', '\\\n', $data);
      return stripslashes($data);
    }
  }
  return $data;
}

function mswSTG($data) {
  return strip_tags(trim($data));
}

function mswQS($data) {
  return str_replace(array(
    '"',
    "'"
  ), array(), $data);
}

function mswJSClean($js) {
  return str_replace("'", "\'", $js);
}

function mswMDAM($func, $arr) {
  $newArr = array();
  if (!empty($arr)) {
    foreach ($arr AS $key => $value) {
      if ($func == 'mysqli_real_escape_string') {
        $newArr[$key] = (is_array($value) ? mswMDAM($func, $value) : $func($GLOBALS['___mysqli_dbcon'], $value));
      } else {
        $newArr[$key] = (is_array($value) ? mswMDAM($func, $value) : $func($value));
      }
    }
  }
  return $newArr;
}

function mswDAP($data) {
  return str_replace("''", "'", $data);
}

function mswSQL($data) {
  if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
    $sybase = strtolower(@ini_get('magic_quotes_sybase'));
    if (empty($sybase) || $sybase == 'off') {
      $data = stripslashes($data);
    } else {
      $data = mswDAP($data);
    }
  }
  $data = ((isset($GLOBALS['___mysqli_dbcon']) && is_object($GLOBALS['___mysqli_dbcon'])) ? mysqli_real_escape_string($GLOBALS['___mysqli_dbcon'], $data) : ((trigger_error("Fix the mysqli_real_escape_string() call, this code does not work.", E_USER_ERROR)) ? "" : ""));
  return $data;
}

function mswFoot($footcode, $loc = 'front') {
  switch($loc) {
    case 'admin':
      if (LICENCE_VER == 'unlocked' && $footcode) {
        $foot = mswCD($footcode);
      } else {
        $foot = 'Powered by: <a href="https://www.' . SCRIPT_URL . '" onclick="window.open(this);return false" title="' . mswQT(SCRIPT_NAME) . '">' . SCRIPT_NAME . '</a><br>
        &copy; ' . (date('Y') == SCRIPT_RELEASE_YR ? SCRIPT_RELEASE_YR : SCRIPT_RELEASE_YR .' - ' . date('Y')) . ' <a href="https://www.maianscriptworld.co.uk" title="Maian Script World" onclick="window.open(this);return false">Maian Script World</a>. All Rights Reserved.';
      }
      break;
    default:
      if (LICENCE_VER == 'unlocked' && $footcode) {
        $foot = mswCD($footcode);
      } else {
        $foot = 'Powered by: <a href="https://www.' . SCRIPT_URL . '" onclick="window.open(this);return false" title="' . mswQT(SCRIPT_NAME) . '">' . SCRIPT_NAME . '</a><br>
        &copy; ' . (date('Y') == SCRIPT_RELEASE_YR ? SCRIPT_RELEASE_YR : SCRIPT_RELEASE_YR .' - ' . date('Y')) . ' <a href="https://www.maianscriptworld.co.uk" title="Maian Script World" onclick="window.open(this);return false">Maian Script World</a>. All Rights Reserved.';
      }
      break;
  }
  return $foot;
}

function mswPK() {
  $_SERVER['HTTP_HOST']   = (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : uniqid(rand(), 1));
  $_SERVER['REMOTE_ADDR'] = (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : uniqid(rand(), 1));
  if (function_exists('sha1')) {
    $c1      = sha1($_SERVER['HTTP_HOST'] . date('YmdHis') . $_SERVER['REMOTE_ADDR'] . time());
    $c2      = sha1(uniqid(rand(), 1) . time());
    $prodKey = substr($c1 . $c2, 0, 60);
  } elseif (function_exists('md5')) {
    $c1      = md5($_SERVER['HTTP_POST'] . date('YmdHis') . $_SERVER['REMOTE_ADDR'] . time());
    $c2      = md5(uniqid(rand(), 1), time());
    $prodKey = substr($c1 . $c2, 0, 60);
  } else {
    $c1      = str_replace('.', '', uniqid(rand(), 1));
    $c2      = str_replace('.', '', uniqid(rand(), 1));
    $c3      = str_replace('.', '', uniqid(rand(), 1));
    $prodKey = substr($c1 . $c2 . $c3, 0, 60);
  }
  return strtoupper($prodKey);
}

function mswAPM($module) {
  return (function_exists('apache_get_modules') && in_array($module, apache_get_modules()) ? 'yes' : 'no');
}

function mswPUT($file, $data) {
  file_put_contents($file, $data, FILE_APPEND);
}

function mswFLCTR() {
  if (!file_exists(GLOBAL_PATH . 'control/system/core/sys-controller.php')) {
    die('<!DOCTYPE html><head><meta charset="utf-8"><title>Fatal Error</title><style type="text/css">body { font: 15px verdana;}</style></head><body><span style="color:red">[FATAL ERROR]</span> The "<b>control/system/core/sys-controller.php</b>" file does NOT exist in your installation.<br><br>If the file has been quarantined by anti-virus software or a server security scanner, it is a false positive.</body></html>');
  }
}

$_GET  = mswMDAM('mswSTG', $_GET);
$_GET  = mswMDAM('mswQS', $_GET);
$_GET  = mswMDAM('htmlspecialchars', $_GET);
$_POST = mswMDAM('trim', $_POST);

?>