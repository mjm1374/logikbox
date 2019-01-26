<?php

/* CLASS FILE
----------------------------------*/

class journal extends db {

  public $dt;
  public $cache;
  public $settings;

  public function add($fm) {
    $pub_ts = ($fm['pubts'] ? $this->dt->jstots($fm['pubts'], true) : $this->dt->ts());
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
    '" . $this->dt->jstots($fm['delts'], true) . "',
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
    if (!empty($fm['cats'])) {
      $privcats = journal::privcats();
      foreach ($fm['cats'] AS $cID) {
        db::db_query("INSERT INTO `" . DB_PREFIX . "cat_journal` (
        `journal`,
        `category`,
        `private`
        ) VALUES (
        '{$ID}',
        '{$cID}',
        '" . (in_array($cID, $privcats) ? 'yes' : 'no') . "'
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

  public function update($fm) {
    $pub_ts = ($fm['pubts'] ? $this->dt->jstots($fm['pubts'], true) : $this->dt->ts());
    db::db_query("UPDATE `" . DB_PREFIX . "journals` SET
    `title`     = '" . mswSQL($fm['title']) . "',
    `comms`     = '" . mswSQL($fm['comms']) . "',
    `encomms`   = '{$fm['encomms']}',
    `pubts`     = '{$pub_ts}',
    `delts`     = '" . $this->dt->jstots($fm['delts'], true) . "',
    `published` = '" . ($pub_ts <= $this->dt->ts() ? 'yes' : 'no') . "',
    `metat`     = '" . mswSQL($fm['metat']) . "',
    `slug`      = '" . mswSQL($fm['slug']) . "',
    `tags`      = '" . mswSQL($fm['tags']) . "',
    `stick`     = '{$fm['stick']}',
    `user`      = '" . mswSQL($fm['user']) . "',
    `pass`      = '" . ($fm['user'] ? ($fm['pass'] ? mswSQL($fm['pass']) : $fm['curpass']) : '') . "',
    `en`        = '{$fm['en']}'
    WHERE `id`  = '{$fm['id']}'
    ");
    if (!empty($fm['cats'])) {
      $privcats = journal::privcats();
      db::db_query("DELETE FROM `" . DB_PREFIX . "cat_journal` WHERE `journal` = '{$fm['id']}'");
      db::db_truncate(array('cat_journal'));
      foreach ($fm['cats'] AS $cID) {
        db::db_query("INSERT INTO `" . DB_PREFIX . "cat_journal` (
        `journal`,
        `category`,
        `private`
        ) VALUES (
        '{$fm['id']}',
        '{$cID}',
        '" . (in_array($cID, $privcats) ? 'yes' : 'no') . "'
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
  }

  public function delete($fm) {
    db::db_query("DELETE FROM `" . DB_PREFIX . "journals` WHERE `id` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    db::db_query("DELETE FROM `" . DB_PREFIX . "cat_journal` WHERE `journal` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    db::db_truncate(array('cat_journal','journals'));
    // Clear cache..
    $this->cache->clear_cache_file(array(
      'nav-archive',
      'journal*',
      'calendar*',
      'category*'
    ));
  }

  public function privcats() {
    $cats = array();
    $Q = db::db_query("SELECT `id` FROM `" . DB_PREFIX . "categories`
          WHERE (`user` != '' AND `pass` != '')
          ");
    while ($C = db::db_object($Q)) {
      $cats[] = $C->id;
    }
    return $cats;
  }

  public function cats($id) {
    $cats = array();
    $Q  = db::db_query("SELECT `category` FROM `" . DB_PREFIX . "cat_journal` WHERE `journal` = '{$id}'");
    while ($C = db::db_object($Q)) {
      $cats[] = $C->category;
    }
    return $cats;
  }

}

?>