<?php

/* CLASS FILE
----------------------------------*/

class mswsys extends db {

  public $settings;
  public $cache;
  public $dt;
  public $social;

  public function load($d = array()) {
    switch($d['section']) {
      case 'category':
        $Q = db::db_query("SELECT * FROM `" . DB_PREFIX . "categories`
             WHERE `en` = 'yes'
             AND (`id` = '{$d['id']}' OR `slug` = '" . mswSQL($d['slug']) . "')
             LIMIT 1
             ");
        return db::db_object($Q);
        break;
      case 'journal':
        $Q = db::db_query("SELECT * FROM `" . DB_PREFIX . "journals`
             WHERE `en` = 'yes'
             AND `pubts` <= '" . $this->dt->ts() . "'
             AND `published` = 'yes'
             AND (`id` = '{$d['id']}' OR `slug` = '" . mswSQL($d['slug']) . "')
             LIMIT 1
             ");
        return db::db_object($Q);
        break;
      case 'new-page':
        $Q = db::db_query("SELECT * FROM `" . DB_PREFIX . "pages`
             WHERE `en` = 'yes'
             AND `landing` = 'no'
             AND (`id` = '{$d['id']}' OR `slug` = '" . mswSQL($d['slug']) . "')
             LIMIT 1
             ");
        return db::db_object($Q);
        break;
      case 'landing':
        $Q = db::db_query("SELECT * FROM `" . DB_PREFIX . "pages`
             WHERE `en` = 'yes'
             AND `landing` = 'yes'
             LIMIT 1
             ");
        return db::db_object($Q);
        break;
    }
  }

  public function theme() {
    if ($this->settings->entheme == 'yes') {
      $Q = db::db_query("SELECT `theme` FROM `" . DB_PREFIX . "themes`
           WHERE `from` <= '" . $this->dt->ts() . "' AND `to` >= '" . $this->dt->ts() . "'
           LIMIT 1
           ");
      $T = db::db_object($Q);
      if (isset($T->theme)) {
        return $T->theme;
      }
    }
    return 'none';
  }

  public function modules($js = array(), $area = 'header') {
    $str = '';
    switch($area) {
      case 'header':
        break;
      case 'footer':
        if (in_array('addthis', $js)) {
          $param = $this->social->params('addthis');
          if (isset($param['addthis']['code']) && $param['addthis']['code']) {
            $tmp = mswTmp(PATH . THEME_FOLDER . '/html/social/addthis-js.htm', 'yes');
            if ($tmp) {
              $str = str_replace('{code}', $param['addthis']['code'], $tmp);
            }
          }
        }
        break;
    }
    return $str;
  }

  public function enable() {
    if ($this->settings->autoenable> 0 && ($this->settings->autoenable <= $this->dt->ts())) {
      db::db_query("UPDATE `" . DB_PREFIX . "settings` SET `sysstatus` = 'yes', `autoenable` = '0'");
      $this->cache->clear_cache();
      header("Location: index.php");
      exit;
    }
  }

}

?>