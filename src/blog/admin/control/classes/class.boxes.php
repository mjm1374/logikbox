<?php

/* CLASS FILE
----------------------------------*/

class box extends db {

  public $dt;
  public $settings;
  public $cache;

  public function add($fm) {
    db::db_query("INSERT INTO `" . DB_PREFIX . "boxes` (
    `title`,
	  `info`,
	  `en`,
	  `tmp`,
    `icon`
    ) VALUES (
    '" . mswSQL($fm['title']) . "',
    '" . mswSQL($fm['info']) . "',
    '{$fm['en']}',
    '" . mswSQL($fm['tmp']) . "',
    '" . mswSQL($fm['icon']) . "'
    )");
    $ID = db::db_last_insert_id();
    db::db_query("UPDATE `" . DB_PREFIX . "boxes` SET `ordr` = '{$ID}' WHERE `id` = '{$ID}'");
  }

  public function update($fm) {
    db::db_query("UPDATE `" . DB_PREFIX . "boxes` SET
    `title` = '" . mswSQL($fm['title']) . "',
	  `info`  = '" . mswSQL($fm['info']) . "',
	  `en`    = '{$fm['en']}',
	  `tmp`   = '" . mswSQL($fm['tmp']) . "',
    `icon`   = '" . mswSQL($fm['icon']) . "'
    WHERE `id` = '{$fm['id']}'
    ");
  }

  public function delete($fm) {
    db::db_query("DELETE FROM `" . DB_PREFIX . "boxes` WHERE `id` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
    db::db_truncate(array('boxes'));
  }

  public function order($fm) {
    $cnt = 0;
    foreach ($fm['sort'] AS $id) {
      db::db_query("UPDATE `" . DB_PREFIX . "boxes` SET
      `ordr`  = '" . (++$cnt) . "'
      WHERE `id` = '{$id}'
      ");
    }
  }

}

?>