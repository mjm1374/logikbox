<?php

/* CLASS FILE
----------------------------------*/

class dt {

  public $settings;
  public $config = array(
    // For calendar links only.
    // uk = UK format (d/m/Y, d-m-Y)
    // us = US format (m/d/Y, m-d-Y)
    'calendar_link_format' => 'us'
  );

  public function ts() {
    return strtotime(date('Y-m-d H:i:s'));
  }

  public function rss() {
    return date('r', dt::ts());
  }

  public function display($s = array(), $ts = 0, $sep = ' @ ') {
    return date($this->settings->dateformat . $sep . $this->settings->timeformat, $ts);
  }

  public function converter($ts, $time = false) {
    if ($ts == '0') {
      return '';
    }
    return date(str_replace(array('dd','mm','yyyy'),array('d','m','Y'),$this->settings->calformat), $ts) . ($time ? ' ' . date('H:i', $ts) : '');
  }

  public function jslang($l) {
    if (file_exists(PATH . LANG_FLDR_ADM . 'templates/js/plugins/i18n/datepicker.' . $l . '.js')) {
      return $l;
    }
    return 'en';
  }

  public function totime($when) {
    return strtotime(date('Y-m-d H:i:s', strtotime($when)));
  }

  public function jstots($date, $time = false) {
    if ($date == '') {
      return '0';
    }
    $fmt = array();
    if (strpos($date, '-') !== false) {
      $d = explode('-', $date);
      $c = explode('-', $this->settings->calformat);
      if ($time && isset($d[2])) {
        $t = explode(' ', str_replace(array(' am',' AM',' pm',' PM'),array(),$d[2]));
        $d[2] = trim($t[0]);
        $fmt['time'] = trim($t[1]);
      }
    }
    if (strpos($date, '/') !== false) {
      $d = explode('/', $date);
      $c = explode('/', $this->settings->calformat);
      if ($time && isset($d[2])) {
        $t = explode(' ', str_replace(array(' am',' AM',' pm',' PM'),array(),$d[2]));
        $d[2] = trim($t[0]);
        $fmt['time'] = trim($t[1]);
      }
    }
    for ($i=0; $i<count($d); $i++){
      switch(strtolower($c[$i])) {
        case 'dd':
        case 'd':
          $fmt['day'] = trim($d[$i]);
          break;
        case 'mm':
        case 'm':
          $fmt['month'] = trim($d[$i]);
          break;
        case 'yyyy':
        case 'yy':
          $fmt['year'] = trim($d[$i]);
          break;
      }
    }
    if (!isset($fmt['year'])) {
      return '0';
    }
    return strtotime(date($fmt['year'] . '-' . $fmt['month'] . '-' . $fmt['day'] . ' ' . (isset($fmt['time']) ? $fmt['time'] . ':00' : '00:00:00')));
  }

  public function calLinkFormat($date, $del) {
    switch($this->config['calendar_link_format']) {
      case 'us':
        $chop = explode($del, $date);
        return $chop[1]. $del . $chop[0] . $del . $chop[2];
        break;
      default:
        return $date;
        break;
    }
  }

}

?>