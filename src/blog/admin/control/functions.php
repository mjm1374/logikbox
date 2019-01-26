<?php

/* FUNCTIONS
----------------------------------*/

function mswCSV($d) {
  $d = str_replace('"', '', $d);
  return '"' . mswCD($d) . '"';
}

function mswCTPR($db) {
  $jns = array();
  $Q  = $db->db_query("SELECT * FROM `" . DB_PREFIX . "categories`
        LEFT JOIN `" . DB_PREFIX . "cat_journal`
        ON `" . DB_PREFIX . "categories`.`id` = `" . DB_PREFIX . "cat_journal`.`category`
        ORDER BY `" . DB_PREFIX . "categories`.`id`
        ");
  while ($C = $db->db_object($Q)) {
    if ($C->user && $C->pass) {
      if (!in_array($C->journal, $jns)) {
        $jns[] = $C->journal;
      }
    }
  }
  return (!empty($jns) ? $jns : array(0));
}

function mswIPList($ip, $hyper = 'yes') {
  if (strpos($ip, ',') !== false) {
    $str = '';
    foreach (explode(',', $ip) AS $ipa) {
      $str[] = ($hyper == 'yes' ? '<a href="' . str_replace('{ip}',$ipa, IP_LOOKUP) . '" onclick="window.open(this);return false">' : '') . $ipa . ($hyper == 'yes' ? '</a>' : '');
    }
    return implode(', ', $str);
  } else {
    return ($hyper == 'yes' ? '<a href="' . str_replace('{ip}',$ip, IP_LOOKUP) . '" onclick="window.open(this);return false">' : '') . $ip . ($hyper == 'yes' ? '</a>' : '');
  }
}

function mswAL($l, $pg) {
  if (in_array($pg, array('dashboard','login','bb','purchase'))){
    return true;
  }
  foreach (array_keys($l) AS $p) {
    if (isset($l[$p]['links']) && in_array($pg, array_keys($l[$p]['links']))) {
      return true;
    }
  }
  return false;
}

function mswHelp($pg) {
  switch($pg) {
    case 'abc':
      $lnk = 'ad-' . $pg . '.html';
      break;
    case 'purchase':
      return 'https://www.' . SCRIPT_URL . '/purchase.html';
      break;
    default:
      $lnk = 'ad-' . $pg . '.html';
      break;
  }
  return '../docs/' . $lnk;
}

function mswUsr($s, $db, $ssn) {
  if (file_exists(PATH . 'control/access.php') && !in_array(PATH . 'control/access.php', get_included_files())) {
    include_once(PATH . 'control/access.php');
  }
  $user = array();
  // Check cookie..
  if (isset($_COOKIE[mswEnc(SECRET_KEY . DB_NAME)]) && $ssn->active('adm_user') == 'no' && $ssn->active('adm_staff') == 'no') {
    $a = unserialize($_COOKIE[mswEnc(SECRET_KEY . DB_NAME)]);
    $ssn->set($a, 'yes');
  }
  if (defined('USERNAME') && defined('PASSWORD') && $ssn->active('adm_user') == 'yes' && $ssn->get('adm_user') == USERNAME && $ssn->active('adm_global') == 'yes' && $ssn->get('adm_global') == mswEnc(SECRET_KEY . mswEnc('gl0bal'))) {
    $user[0] = USERNAME;
    $user[1] = 'global';
    $user[2] = 0;
  } else {
    if ($ssn->active('adm_staff') == 'yes' && $ssn->active('adm_type') == 'yes' && $ssn->active('adm_staff_id') == 'yes') {
      if ($ssn->active('adm_staff_id') == 'yes') {
        $ID = (int) $ssn->get('adm_staff_id');
        $Q = $db->db_query("SELECT * FROM `" . DB_PREFIX . "staff`
             WHERE `id` = '{$ID}'
             AND `user` = '" . mswSQL($ssn->get('adm_staff')) . "'
             AND `en` = 'yes'
             ");
        $U = $db->db_object($Q);
        if (isset($U->id, $U->user)) {
          $user[0] = $ssn->get('adm_staff');
          $user[1] = $ssn->get('adm_type');
          $user[2] = (array) $U;
        }
      }
    }
  }
  return $user;
}

function mswPagePerms($pg, $usr) {
  $p = 'no';
  if (isset($usr[1]) && $usr[1] == 'global') {
    $p = 'yes';
  } else {
    if (isset($usr[2]) && isset($usr[2]['perms'])) {
      if (isset($usr[1]) && $usr[1] == 'admin') {
        $p = 'yes';
      } else {
        $pages = explode('<##>', $usr[2]['perms']);
        if (in_array($pg, $pages)) {
          $p = 'yes';
        }
      }
    }
  }
  return $p;
}

function mswOptPerms($opt, $usr) {
  $p = 'no';
  if (isset($usr[1]) && $usr[1] == 'global') {
    $p = 'yes';
  } else {
    if (isset($usr[2]) && isset($usr[2][$opt]) && in_array($usr[2][$opt], array('yes','no'))) {
      $p = $usr[2][$opt];
    }
  }
  return $p;
}

function mswPerms($usr, $cmd) {
  $login = ($cmd == 'login' ? true : false);
  if (!$login) {
    if (!isset($usr[0], $usr[1]) || $usr[0] == '' || $usr[1] == '') {
      header("Location: index.php?p=login");
      exit;
    }
  } else {
    if (isset($usr[0], $usr[1]) && $usr[0] && in_array($usr[1], array('global','restricted','admin'))) {
      header("Location: index.php");
      exit;
    }
  }
}

?>
