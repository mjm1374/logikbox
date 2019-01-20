<?php

/* CLASS FILE
----------------------------------*/

class tools extends db {

  public $dt;
  public $settings;
  private $sep = ',';

  public function export($fm) {
    switch($fm['type']) {
      case 'staff':
        $fpath = PATH . 'backup/staff-' . $this->dt->ts() . '.csv';
        $exp = array();
        $Q  = db::db_query("SELECT * FROM `" . DB_PREFIX . "staff` ORDER BY `name`");
        while ($S = db::db_object($Q)) {
          $exp[] = ($fm['name'] == 'yes' ? mswCSV($S->name) . $this->sep : '') .
          ($fm['email'] == 'yes' ? mswCSV($S->email) . $this->sep : '') .
          ($fm['user'] == 'yes' ? mswCSV($S->user) : '');
        }
        break;
      case 'journals':
        $fpath = PATH . 'backup/journals-' . $this->dt->ts() . '.csv';
        $exp = array($fm['lang'][0]);
        $sql = '';
        if ($fm['from'] && $fm['to']) {
          $sql = 'WHERE `' . DB_PREFIX . 'journals`.`pubts` BETWEEN \'' . $this->dt->jstots($fm['from']) . '\' AND \'' . $this->dt->jstots($fm['to']) . '\'';
        }
        if (!empty($fm['cats'])) {
          $sql .= ($sql ? mswNL() . 'AND ' : 'WHERE ') . '`' . DB_PREFIX . 'cat_journal`.`category` IN(' . mswSQL(implode(',', $fm['cats'])) . ')';
        }
        $Q  = db::db_query("SELECT * FROM `" . DB_PREFIX . "journals`
              LEFT JOIN `" . DB_PREFIX . "staff`
              ON `" . DB_PREFIX . "journals`.`staff` = `" . DB_PREFIX . "staff`.`id`
              LEFT JOIN `" . DB_PREFIX . "cat_journal`
              ON `" . DB_PREFIX . "journals`.`id` = `" . DB_PREFIX . "cat_journal`.`journal`
              $sql
              GROUP BY `" . DB_PREFIX . "cat_journal`.`journal`
              ORDER BY `" . DB_PREFIX . "journals`.`title`
              ");
        while ($J = db::db_object($Q)) {
          $exp[] = mswCSV($J->title) . $this->sep .
          mswCSV(($J->staff > 0 ? $J->name : (defined('USERNAME') ? USERNAME : $fm['lang'][1]))) . $this->sep .
          mswCSV($J->comms) . $this->sep .
          mswCSV($J->addts) . $this->sep .
          mswCSV($J->pubts) . $this->sep .
          mswCSV($J->metat) . $this->sep .
          mswCSV($J->slug) . $this->sep .
          mswCSV($J->tags);
        }
        break;
    }
    if (isset($fpath)) {
      mswPUT($fpath, implode(mswNL(), $exp));
    }
    return (isset($fpath) ? $fpath : '');
  }

  public function exelog($l) {
    $fpath = PATH . 'backup/elog-' . $this->dt->ts() . '.csv';
    $log = array();
    $Q  = db::db_query("SELECT *,
          `" . DB_PREFIX . "elog`.`user` AS `usrID`
          FROM `" . DB_PREFIX . "elog`
          LEFT JOIN `" . DB_PREFIX . "staff`
          ON `" . DB_PREFIX . "elog`.`user` = `" . DB_PREFIX . "staff`.`id`
          " . (isset($_GET['u']) ? 'WHERE `' . DB_PREFIX . 'elog`.`user` = \'' . (int) $_GET['u'] . '\'' : '') . "
          ORDER BY `" . DB_PREFIX . "elog`.`ts` DESC
          ");
    while ($L = db::db_object($Q)) {
      $log[] = mswCSV(($L->usrID == 0 ? (defined('USERNAME') ? USERNAME : $l) : $L->name)) . $this->sep .
      mswCSV(mswIPList($L->ip, 'no')) . $this->sep .
      mswCSV($this->dt->display($this->settings, $L->ts, DT_DIVIDER));
    }
    mswPUT($fpath, implode(mswNL(), $log));
    return $fpath;
  }

  public function elog($fm = array(), $op = 'single') {
    switch($op) {
      case 'single':
        db::db_query("DELETE FROM `" . DB_PREFIX . "elog` WHERE `id` IN(" . mswSQL(implode(',', $fm['ids'])) . ")");
        db::db_truncate(array('elog'));
        break;
      case 'all':
        db::db_truncate(array('elog'), true);
        break;
    }
  }

}

?>