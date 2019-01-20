<?php

/* CLASS FILE
----------------------------------*/

class staff extends db {

  public $dt;
  public $settings;
  public $cache;

  public function add($fm) {
    db::db_query("INSERT INTO `" . DB_PREFIX . "staff` (
    `name`,
    `email`,
    `user`,
    `pass`,
    `type`,
    `tweet`,
    `perms`,
    `en`,
    `delp`,
    `notes`,
    `jrest`,
    `notify`
    ) VALUES (
    '" . mswSQL($fm['name']) . "',
    '" . mswSQL($fm['email']) . "',
    '" . mswSQL($fm['user']) . "',
    '" . mswSQL($fm['pass']) . "',
    '{$fm['type']}',
    '" . mswSQL($fm['tweet']) . "',
    '" . mswSQL($fm['perms']) . "',
    '{$fm['en']}',
    '{$fm['delp']}',
    '" . mswSQL($fm['notes']) . "',
    '{$fm['jrest']}',
    '{$fm['notify']}'
    )");
  }

  public function update($fm) {
    db::db_query("UPDATE `" . DB_PREFIX . "staff` SET
    `name`   = '" . mswSQL($fm['name']) . "',
    `email`  = '" . mswSQL($fm['email']) . "',
    `user`   = '" . mswSQL($fm['user']) . "',
    `pass`   = '" . ($fm['pass'] ? mswSQL($fm['pass']) : $fm['curpass']) . "',
    `type`   = '{$fm['type']}',
    `tweet`  = '" . mswSQL($fm['tweet']) . "',
    `perms`  = '" . mswSQL($fm['perms']) . "',
    `en`     = '{$fm['en']}',
    `delp`   = '{$fm['delp']}',
    `notes`  = '" . mswSQL($fm['notes']) . "',
    `jrest`  = '{$fm['jrest']}',
    `notify` = '{$fm['notify']}'
    WHERE `id` = '{$fm['id']}'
    ");
  }

  public function notifications($id = 0, $type = '') {
    $s = array();
    $q = db::db_query("SELECT `name`, `email`, `user` FROM `" . DB_PREFIX . "staff`
         WHERE `notify` = 'yes'
         AND `en` = 'yes'
         AND `id` != '{$id}'
         ");
    while ($JN = db::db_object($q)) {
      $s[] = (array) $JN;
    }
    // Add global user if not logged in..
    if (defined('ADM_NOTIFICATIONS') && defined('USERNAME') && $type != 'global') {
      $s[] = array(
        'name' => USERNAME,
        'email' => $this->settings->email,
        'user' => USERNAME
      );
    }
    return $s;
  }

  public function delete($fm) {
    $j = array();
    db::db_query("DELETE FROM `" . DB_PREFIX . "staff` WHERE `id` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    $q = db::db_query("SELECT `id` FROM `" . DB_PREFIX . "journals` WHERE `staff` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    while ($JN = db::db_object($q)) {
      $j[] = $JN->id;
    }
    if (!empty($j)) {
      db::db_query("DELETE FROM `" . DB_PREFIX . "cat_journal` WHERE `journal` IN(" . mswSQL(implode(',', $j)) . ")");
    }
    db::db_query("DELETE FROM `" . DB_PREFIX . "journals` WHERE `staff` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    db::db_truncate(array('staff','journals','cat_journal'));
    // Clear cache..
    $this->cache->clear_cache_file(array(
      'nav-archive',
      'journal*',
      'calendar*',
      'category*'
    ));
  }

}

?>