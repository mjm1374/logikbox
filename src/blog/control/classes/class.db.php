<?php

/* CLASS FILE
----------------------------------*/

define('DB_TYPE', 'mysqli'); // postgres not completed, mysqli only
define('DB_PATH', substr(dirname(__file__), 0, strpos(dirname(__file__), 'control') - 1) . '/');
define('DB_ERR_LOG_FOLDER', 'logs'); // Name of logs folder..
define('DB_ERR_ENABLED', 1); // Enable custom error handler?
define('DB_ERR_FILE', 'mysqli_error_log.log'); // Name of logs file..

class db {

  public function db_conn() {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        $connect = @($GLOBALS['___mysqli_dbcon'] = mysqli_connect(trim(DB_HOST),  trim(DB_USER),  trim(DB_PASS)));
        if (!$connect) {
          die(db::db_error());
        }
        $dbname = trim(DB_NAME);
        if ($connect && !((bool)mysqli_query( $connect, 'USE `' . $dbname . '`'))) {
          die(db::db_error());
        }
        if ($connect) {
          // Character set..
          if (DB_CHAR_SET) {
            if (strtolower(DB_CHAR_SET) == 'utf-8') {
              $change = 'utf8';
            }
            db::db_query("SET CHARACTER SET '" . (isset($change) ? $change : DB_CHAR_SET) . "'");
            db::db_query("SET NAMES '" . (isset($change) ? $change : DB_CHAR_SET) . "'");
            db::db_query("SET `sql_mode` = (SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
            if (defined('DB_TIMEZONE') && DB_TIMEZONE != '') {
              db::db_query("SET `time_zone` = '" . DB_TIMEZONE . "'");
            }
          }
          // Locale..
          if (defined('DB_LOCALE')) {
            if (DB_CHAR_SET && DB_LOCALE) {
              db::db_query("SET `lc_time_names` = '" . DB_LOCALE . "'");
            }
          }
        }
        break;
      case 'postgres':
        $connect = @pg_connect('host=' . trim(DB_HOST) . ' port=' . trim(DB_PORT) . ' dbname=' . trim(DB_NAME) . ' user=' . trim(DB_USER) . ' password=' . trim(DB_PASS));
        if ($connect) {
          // Character set..
          if (DB_CHAR_SET) {
            if (strtolower(DB_CHAR_SET) == 'utf-8') {
              $change = 'utf8';
            }
            db::db_query("SET CLIENT_ENCODING TO '" . (isset($change) ? $change : DB_CHAR_SET) . "'");
            db::db_query("SET NAMES '" . (isset($change) ? $change : DB_CHAR_SET) . "'");
          }
          // Locale..
          if (defined('DB_LOCALE')) {
            if (DB_CHAR_SET && DB_LOCALE) {
              db::db_query("SET lc_time = '" . DB_LOCALE . "'");
            }
          }
        }
        break;
    }
  }

  public function db_query($query, $boolean = false) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        if ($boolean) {
          $q = mysqli_query($GLOBALS['___mysqli_dbcon'], $query);
          return (!$q ? 'err' : $q);
        } else {
          $q = mysqli_query($GLOBALS['___mysqli_dbcon'], $query) or die(db::db_error(false,$query));
          return $q;
        }
        break;
      case 'postgres':
        if ($boolean) {
          $q = pg_query($query);
          return (!$q ? 'err' : $q);
        } else {
          $q = pg_query($query) or die(db::db_error(false,$query));
          return $q;
        }
        break;
    }
  }

  public function db_version() {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        $query   = @db::db_query("SELECT VERSION() AS `v`");
        $VERSION = @db::db_object($query);
        return (isset($VERSION->v) ? $VERSION->v : 'Unknown');
        break;
      case 'postgres':
        $connect = @pg_connect('host=' . trim(DB_HOST) . ' port=' . trim(DB_PORT) . ' dbname=' . trim(DB_NAME) . ' user=' . trim(DB_USER) . ' password=' . trim(DB_PASS));
        $PG      = pg_version($connect);
        return (isset($PG['client']) ? $PG['client'] : 'Unknown');
        break;
    }
    return $q;
  }

  public function db_rows($query) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return mysqli_num_rows($query);
        break;
      case 'postgres':
        return pg_num_rows($query);
        break;
    }
  }

  public function db_fetch_rows($query) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return mysqli_fetch_row($query);
        break;
      case 'postgres':
        return pg_fetch_row($query);
        break;
    }
  }

  public function db_fetch_assoc($query) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return mysqli_fetch_assoc($query);
        break;
      case 'postgres':
        return pg_fetch_assoc($query);
        break;
    }
  }

  public function db_test_conn($test = false) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        $connect = @($GLOBALS['___mysqli_dbcon'] = mysqli_connect(DB_HOST,  DB_USER,  DB_PASS));
        if (!$connect) {
          if ($test) {
            return 'Connection Failed - Check Connection Parameters';
          }
          db::db_error();
        }
        if ($connect && !((bool)mysqli_query( $connect, "USE " . constant('DB_NAME')))) {
          if ($test) {
            return 'Connection Failed - Check Connection Parameters';
          }
          db::db_error();
        }
        if ($test) {
          return 'Connection Successful';
        }
        break;
      case 'postgres':
        $connect = pg_connect('host=' . trim(DB_HOST) . ' port=' . trim(DB_PORT) . ' dbname=' . trim(DB_NAME) . ' user=' . trim(DB_USER) . ' password=' . trim(DB_PASS));
        if (!$connect) {
          if ($test) {
            return 'Connection Failed - Check Connection Parameters';
          }
          db::db_error();
        }
        if ($test) {
          return 'Connection Successful';
        }
        break;
    }
  }

  public function db_error($raw = false, $query='') {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        if ($raw) {
          return array(
            ((is_object($GLOBALS['___mysqli_dbcon'])) ? mysqli_errno($GLOBALS['___mysqli_dbcon']) : (($___mysqli_res = mysqli_connect_errno()) ? $___mysqli_res : false)),
            ((is_object($GLOBALS['___mysqli_dbcon'])) ? mysqli_error($GLOBALS['___mysqli_dbcon']) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))
          );
        }
        return (db::db_error_log(((is_object($GLOBALS['___mysqli_dbcon'])) ? mysqli_errno($GLOBALS['___mysqli_dbcon']) : (($___mysqli_res = mysqli_connect_errno()) ? $___mysqli_res : false)), ((is_object($GLOBALS['___mysqli_dbcon'])) ? mysqli_error($GLOBALS['___mysqli_dbcon']) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)), $query));
        break;
      case 'postgres':
        if ($raw) {
          return array(
            0,
            pg_last_error()
          );
        }
        return (db::db_error_log(0, pg_last_error(), $query));
        break;
    }
  }

  public function db_schema() {
    $tbl = array();
    if (strlen(DB_PREFIX) > 0) {
      $q = db::db_query("SHOW TABLES WHERE SUBSTRING(`Tables_in_" . DB_NAME . "`,1," . strlen(DB_PREFIX) . ") = '" . DB_PREFIX . "'");
    } else {
      $q = db::db_query("SHOW TABLES");
    }
    while ($TABLES = db::db_object($q)) {
      $field = 'Tables_in_' . DB_NAME;
      $tbl[] = $TABLES->{$field};
    }
    return $tbl;
  }

  public function db_num_fields($query) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return (($___mysqli_tmp = mysqli_num_fields($query)) ? $___mysqli_tmp : false);
        break;
      case 'postgres':
        return pg_num_fields($query);
        break;
    }
  }

  public function db_array($query) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return mysqli_fetch_array($query);
        break;
      case 'postgres':
        return pg_fetch_array($query);
        break;
    }
  }

  public function db_object($query) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return mysqli_fetch_object($query);
        break;
      case 'postgres':
        return pg_fetch_object($query);
        break;
    }
  }

  public function db_foundrows() {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        $c = db::db_object(db::db_query("SELECT FOUND_ROWS() AS `rows`"));
        return (isset($c->rows) ? $c->rows : '0');
        break;
      case 'postgres':
        break;
    }
  }

  public function db_aff_rows() {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return mysqli_affected_rows($GLOBALS['___mysqli_dbcon']);
        break;
      case 'postgres':
        return pg_affected_rows();
        break;
    }
  }

  public function db_last_insert_id() {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return mysqli_insert_id($GLOBALS['___mysqli_dbcon']);
        break;
      case 'postgres':
        return pg_last_oid($GLOBALS['___mysqli_dbcon']);
        break;
    }
  }

  public function db_truncate($tables = array(), $force = false) {
    if (!empty($tables)) {
      foreach ($tables AS $t) {
        if (db::db_rowcount($t) == 0 || $force) {
          db::db_query("TRUNCATE TABLE `" . DB_PREFIX . $t . "`");
        }
      }
    }
  }

  public function db_field_name($query, $field) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return mysqli_fetch_field_direct((is_object($query) ? $query : $GLOBALS['___mysqli_dbcon']), $field)->name;
        break;
      case 'postgres':
        return pg_field_name((is_object($query) ? $query : $GLOBALS['___mysqli_dbcon']), $field)->name;
        break;
    }
  }

  public function db_escape($data) {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        return (isset($GLOBALS['___mysqli_dbcon']) && is_object($GLOBALS['___mysqli_dbcon']) ? mysqli_real_escape_string($GLOBALS['___mysqli_dbcon'], $data) : '');
        break;
      case 'postgres':
        return pg_escape_string($data);
        break;
    }
  }

  public function db_charsets() {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        $cSets    = array();
        $DCHARSET = db::db_query("SHOW CHARACTER SET");
        while ($CH = db::db_object($DCHARSET)) {
          if (is_object($CH)) {
            $CH_SET = (array) $CH;
            if (isset($CH_SET['Charset'])) {
              $DCOLL = db::db_query("SHOW COLLATION LIKE '" . $CH_SET['Charset'] . "%'");
              while ($COL = db::db_object($DCOLL)) {
                if (is_object($COL)) {
                  $COL_SET = (array) $COL;
                  if (isset($COL_SET['Collation'])) {
                    $cSets[] = $COL_SET['Collation'];
                  }
                }
              }
            }
          }
        }
        return $cSets;
      case 'postgres':
        break;
    }
  }

  public function db_table($table, $row, $id, $and = '', $params = '*') {
    $q = db::db_query("SELECT $params FROM `" . DB_PREFIX . $table . "`
         WHERE `$row`  = '$id'
         $and
         LIMIT 1
         ");
    return db::db_object($q);
  }

  public function db_rowcount($table, $where = '', $format = true) {
    $q = db::db_query("SELECT count(*) AS `r_count` FROM " . DB_PREFIX . $table . " " . $where);
    $r = db::db_object($q);
    if ($format) {
      return (isset($r->r_count) ? mswNFM($r->r_count) : '0');
    } else {
      return $r->r_count;
    }
  }

  public function db_table_status() {
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        $tables = array();
        $q      = db::db_query("SHOW TABLE STATUS");
        while ($T = db::db_fetch_assoc($q)) {
          $tables[] = $T['Name'];
        }
        return $tables;
        break;
      case 'postgres':
        break;
    }
  }

  public function db_strict_mode() {
    $str = 'no';
    switch ((in_array(DB_TYPE, array(
      'mysqli',
      'postgres'
    )) ? DB_TYPE : 'mysqli')) {
      case 'mysqli':
        $Q   = db::db_query("SELECT @@sql_mode AS `mode`");
        $ST  = db::db_object($Q);
        if (isset($ST->mode) && strpos(strtolower($ST->mode), 'strict_trans_tables') !== false) {
          $str = 'yes';
        }
        break;
      case 'postgres':
        break;
    }
    return $str;
  }

  public function db_error_log($code, $error, $query = '') {
    if (DB_ERR_ENABLED) {
      if (!function_exists('mswNL')) {
        function mswNL() {
          return PHP_EOL;
        }
      }
      $message  = 'Date/Time: ' . date('j F Y @ H:i:s') . mswNL();
      $message .= 'Code: ' . $code . mswNL();
      $message .= 'Error: ' . $error . mswNL();
      $message .= 'File: ' . __file__ . mswNL();
      $message .= 'Line: ' . __line__ . mswNL();
      if ($query) {
        $message .= 'Message : ' . mswNL() . mswNL() . trim($query) . mswNL();
      }
      $message .= mswNL() . '= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =' . mswNL() . mswNL();
      // Attempt to create log folder if it doesn`t exist..
      if (!is_dir(DB_PATH . DB_ERR_LOG_FOLDER)) {
        $oldumask = @umask(0);
        @mkdir(DB_PATH . DB_ERR_LOG_FOLDER, 0777);
        @umask($oldumask);
      }
      if (is_dir(DB_PATH . DB_ERR_LOG_FOLDER) && is_writeable(DB_PATH . DB_ERR_LOG_FOLDER)) {
        mswPUT(DB_PATH . DB_ERR_LOG_FOLDER . '/' . DB_ERR_FILE, $message);
      }
    }
    echo '<div style="background:#ff9999"><p style="padding:10px;color:#fff">Database Error. Check software log for more details.</p></div>';
  }

}

?>