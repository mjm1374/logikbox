<?php

/* CLASS FILE
----------------------------------*/

class cat extends db {

  public $dt;
  public $settings;
  public $cache;

  public function add($fm) {
    db::db_query("INSERT INTO `" . DB_PREFIX . "categories` (
    `title`,
    `en`,
    `metat`,
    `slug`,
    `user`,
    `pass`,
    `delts`,
    `display`
    ) VALUES (
    '" . mswSQL($fm['title']) . "',
    '{$fm['en']}',
    '" . mswSQL($fm['metat']) . "',
    '" . mswSQL($fm['slug']) . "',
    '" . mswSQL($fm['user']) . "',
    '" . mswSQL($fm['pass']) . "',
    '" . $this->dt->jstots($fm['delts']) . "',
    '" . mswSQL($fm['display']) . "'
    )");
    $ID = db::db_last_insert_id();
    // Update order for new cat..
    db::db_query("UPDATE `" . DB_PREFIX . "categories` SET `ordr` = '{$ID}' WHERE `id` = '{$ID}'");
    // Clear cache..
    $this->cache->clear_cache_file(array(
      'nav-cats',
      'journal-categories*'
    ));
  }

  public function update($fm) {
    db::db_query("UPDATE `" . DB_PREFIX . "categories` SET
    `title`   = '" . mswSQL($fm['title']) . "',
    `en`      = '{$fm['en']}',
    `metat`   = '" . mswSQL($fm['metat']) . "',
    `slug`    = '" . mswSQL($fm['slug']) . "',
    `user`    = '" . mswSQL($fm['user']) . "',
    `pass`    = '" . ($fm['user'] ? ($fm['pass'] ? mswSQL($fm['pass']) : $fm['curpass']) : '') . "',
    `delts`   = '" . $this->dt->jstots($fm['delts']) . "',
    `display` = '" . mswSQL($fm['display']) . "'
    WHERE `id` = '{$fm['id']}'
    ");
    // Update cat journal table for privacy field..
    db::db_query("UPDATE `" . DB_PREFIX . "cat_journal` SET
    `private` = '" . ($fm['user'] && $fm['pass'] ? 'yes' : 'no') . "',
    `hidden` = '" . mswSQL($fm['display']) . "'
    WHERE `category` = '{$fm['id']}'
    ");
    // Clear cache..
    $this->cache->clear_cache_file(array(
      'nav-cats',
      'journal-categories*'
    ));
  }

  public function delete($fm) {
    $j = array();
    db::db_query("DELETE FROM `" . DB_PREFIX . "categories` WHERE `id` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    $q = db::db_query("SELECT `journal`,`category` FROM `" . DB_PREFIX . "cat_journal` WHERE `category` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    while ($C = db::db_object($q)) {
      if (db::db_rowcount('cat_journal','WHERE `journal` = \'' . $C->journal . '\' AND `category` != \'' . $C->category . '\'') == 0) {
        $j[] = $C->journal;
      }
    }
    db::db_query("DELETE FROM `" . DB_PREFIX . "cat_journal` WHERE `category` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    if (!empty($j)) {
      db::db_query("DELETE FROM `" . DB_PREFIX . "journals` WHERE `id` IN(" . mswSQL(implode(',', $j)) . ")");
    }
    db::db_truncate(array('categories','journals','cat_journal'));
    // Clear cache..
    $this->cache->clear_cache_file(array(
      'nav-cats',
      'nav-archive',
      'journal*',
      'calendar*',
      'category*'
    ));
  }

  public function order($fm) {
    $cnt = 0;
    foreach ($fm['sort'] AS $id) {
      db::db_query("UPDATE `" . DB_PREFIX . "categories` SET
      `ordr`  = '" . (++$cnt) . "'
      WHERE `id` = '{$id}'
      ");
    }
    // Clear cache..
    $this->cache->clear_cache_file(array(
      'nav-cats',
      'journal-categories*'
    ));
  }

}

?>