<?php

/* CLASS FILE
----------------------------------*/

class page extends db {

  public $dt;
  public $settings;
  public $cache;

  public function add($fm) {
    db::db_query("INSERT INTO `" . DB_PREFIX . "pages` (
    `name`,
    `metat`,
    `info`,
    `en`,
    `tmp`,
    `landing`,
    `slug`
    ) VALUES (
    '" . mswSQL($fm['name']) . "',
    '" . mswSQL($fm['metat']) . "',
    '" . mswSQL($fm['info']) . "',
    '{$fm['en']}',
    '" . mswSQL($fm['tmp']) . "',
    '{$fm['landing']}',
    '" . mswSQL($fm['slug']) . "'
    )");
    $ID = db::db_last_insert_id();
    db::db_query("UPDATE `" . DB_PREFIX . "pages` SET `ordr` = '{$ID}' WHERE `id` = '{$ID}'");
    if ($fm['landing'] == 'yes') {
      db::db_query("UPDATE `" . DB_PREFIX . "pages` SET `landing` = 'no' WHERE `id` != '{$ID}'");
    }
    // Clear cache..
    $this->cache->clear_cache_file('new-pages');
  }

  public function update($fm) {
    db::db_query("UPDATE `" . DB_PREFIX . "pages` SET
    `name`    = '" . mswSQL($fm['name']) . "',
    `metat`   = '" . mswSQL($fm['metat']) . "',
    `info`    = '" . mswSQL($fm['info']) . "',
    `en`      = '{$fm['en']}',
    `tmp`     = '" . mswSQL($fm['tmp']) . "',
    `landing` = '{$fm['landing']}',
    `slug`    = '" . mswSQL($fm['slug']) . "'
    WHERE `id` = '{$fm['id']}'
    ");
    if ($fm['landing'] == 'yes') {
      db::db_query("UPDATE `" . DB_PREFIX . "pages` SET `landing` = 'no' WHERE `id` != '{$fm['id']}'");
    }
    // Clear cache..
    $this->cache->clear_cache_file('new-pages');
  }

  public function delete($fm) {
    db::db_query("DELETE FROM `" . DB_PREFIX . "pages` WHERE `id` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    db::db_truncate(array('pages'));
    // Clear cache..
    $this->cache->clear_cache_file('new-pages');
  }

  public function order($fm) {
    $cnt = 0;
    foreach ($fm['sort'] AS $id) {
      db::db_query("UPDATE `" . DB_PREFIX . "pages` SET
      `ordr`  = '" . (++$cnt) . "'
      WHERE `id` = '{$id}'
      ");
    }
    // Clear cache..
    $this->cache->clear_cache_file('new-pages');
  }

}

?>