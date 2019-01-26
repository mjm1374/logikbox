<?php

/* CLASS FILE
----------------------------------*/

class api extends db {

  public $settings;
  public $dt;
  public $cache;

  private $log = array(
    'file' => 'logs/msw_api_log.log',
    'date_format' => 'd/m/Y, H:iA',
    'divider' => '-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-='
  );

  public function add($fm = array()) {
    $pub_ts = (int) $fm['pubts'];
    db::db_query("INSERT INTO `" . DB_PREFIX . "journals` (
    `staff`,
    `title`,
    `comms`,
    `encomms`,
    `addts`,
    `pubts`,
    `delts`,
    `published`,
    `rss`,
    `metat`,
    `slug`,
    `tags`,
    `stick`,
    `user`,
    `pass`,
    `en`
    ) VALUES (
    '" . mswSQL($fm['staff']) . "',
    '" . mswSQL($fm['title']) . "',
    '" . mswSQL($fm['comms']) . "',
    '{$fm['encomms']}',
    '" . $this->dt->ts() . "',
    '{$pub_ts}',
    '" . (int) $fm['delts'] . "',
    '" . ($pub_ts <= $this->dt->ts() ? 'yes' : 'no') . "',
    '" . $this->dt->rss(). "',
    '" . mswSQL($fm['metat']) . "',
    '" . mswSQL($fm['slug']) . "',
    '" . mswSQL($fm['tags']) . "',
    '{$fm['stick']}',
    '" . mswSQL($fm['user']) . "',
    '" . mswSQL($fm['pass']) . "',
    '{$fm['en']}'
    )");
    $ID = db::db_last_insert_id();
    if (!empty($fm['categories'])) {
      foreach ($fm['categories'] AS $cID) {
        db::db_query("INSERT INTO `" . DB_PREFIX . "cat_journal` (
        `journal`,
        `category`
        ) VALUES (
        '{$ID}',
        '{$cID}'
        )");
      }
    }
    // Clear cache..
    $this->cache->clear_cache_file(array(
      'nav-archive',
      'journal*',
      'calendar*',
      'category*'
    ));
    return $ID;
  }

  public function notifications() {
    $s = array();
    $q = db::db_query("SELECT `name`, `email`, `user` FROM `" . DB_PREFIX . "staff`
         WHERE `en` = 'yes'
         AND `notify` = 'yes'
         ");
    while ($ST = db::db_object($q)) {
      $s[] = (array) $ST;
    }
    // Add global user if not logged in..
    if (defined('ADM_NOTIFICATIONS') && defined('USERNAME')) {
      $s[] = array(
        'name' => USERNAME,
        'email' => $this->settings->email,
        'user' => USERNAME
      );
    }
    return $s;
  }

  public function detection() {
    if (function_exists('file_get_contents')){
      $data = urldecode(file_get_contents('php://input'));
      if ($data) {
        return $data;
      }
    }
    return 'no';
  }

  public function log($msg) {
    if ($this->settings->apilog == 'yes') {
      mswPUT(PATH . $this->log['file'], '[' . date($this->log['date_format'], $this->dt->ts()) . '][' . mswIP() . '] ' . $msg . mswNL() . mswNL() . $this->log['divider'] . mswNL() . mswNL());
    }
  }

}

?>