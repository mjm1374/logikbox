<?php

/* CLASS FILE
----------------------------------*/

class backup {

  public $database = null;
  public $compress = false;
  public $hexValue = false;
  public $filename = null;
  public $file = null;
  public $isWritten = false;
  public $settings;

  public function __construct($data = array()) {
    $this->compress = ($data['cmp'] == 'yes' ? true : false);
    $this->database = DB_NAME;
    $this->db       = $data['db'];
    if (!backup::setOutputFile($data['file'])) {
      return false;
    }
    $this->schema_tables = $this->db->db_schema();
    return backup::setDatabase(DB_NAME);
  }

  public function setDatabase($db) {
    if (!$this->db->db_query("USE `" . $this->database . "`")) {
      return false;
    }
    return true;
  }

  public function setCompress($compress) {
    if ($this->isWritten) {
      return false;
    }
    $this->compress = $compress;
    backup::openFile($this->filename);
    return true;
  }

  public function getCompress() {
    return $this->compress;
  }

  public function setOutputFile($filepath) {
    if ($this->isWritten) {
      return false;
    }
    $this->filename = $filepath;
    $this->file     = backup::openFile($this->filename);
    return $this->file;
  }

  public function getOutputFile() {
    return $this->filename;
  }

  public function getTableStructure($table) {
    if (!backup::setDatabase($this->database)) {
      return false;
    }
    $structure = '--' . mswNL();
    $structure .= '-- Table structure for table `' . $table . '` ' . mswNL();
    $structure .= '--' . mswNL() . mswNL();
    $structure .= 'DROP TABLE IF EXISTS `' . $table . '`;' . mswNL();
    $structure .= "CREATE TABLE `" . $table . "` (" . mswNL();
    $records = $this->db->db_query("SHOW FIELDS FROM `" . $table . "`");
    if ($this->db->db_rows($records) == 0) {
      return false;
    }
    while ($record = $this->db->db_fetch_assoc($records)) {
      $structure .= '`' . $record['Field'] . '` ' . ($record['Type'] == 'text' ? 'text default null' : $record['Type']);
      if (!empty($record['Default'])) {
        $structure .= ' NOT NULL DEFAULT \'' . $record['Default'] . '\'';
      }
      if (strcmp($record['Null'], 'YES') != 0) {
        if (!empty($record['Extra']) && $record['Extra'] == 'auto_increment') {
          $structure .= ' NOT NULL ';
        } else {
          if (empty($record['Default'])) {
            if (strpos($record['Type'],'int(') !== false) {
              $structure .= ' NOT NULL DEFAULT \'0\'';
            } else {
              $structure .= ' NOT NULL DEFAULT \'\'';
            }
          }
        }
      }
      if (!empty($record['Extra'])) {
        $structure .= ' ' . $record['Extra'];
      }
      $structure .= "," . mswNL();
    }
    $structure = substr_replace(trim($structure), '', -1);
    $structure .= backup::getSqlKeysTable($table);
    $structure .= mswNL() . ")";
    $records = $this->db->db_query("SHOW TABLE STATUS LIKE '" . $table . "'");
    if ($record = $this->db->db_fetch_assoc($records)) {
      if (!empty($record['Engine'])) {
        $structure .= ' ENGINE=' . $record['Engine'];
      }
      if (!empty($record['Auto_increment'])) {
        $structure .= ' AUTO_INCREMENT=' . $record['Auto_increment'];
      }
    }

    $structure .= ";" . mswNL() . mswNL() . "-- --------------------------------------------------------" . mswNL() . mswNL();
    backup::saveToFile($this->file, $structure);
  }

  public function getTableData($table, $hexValue = true) {
    if (!backup::setDatabase($this->database)) {
      return false;
    }
    $data = '--' . mswNL();
    $data .= '-- Dumping data for table `' . $table . '`' . mswNL();
    $data .= '--' . mswNL() . mswNL();
    $records    = $this->db->db_query("SHOW FIELDS FROM `" . $table . "`");
    $num_fields = $this->db->db_rows($records);
    if ($num_fields == 0) {
      return false;
    }
    $selectStatement = "SELECT ";
    $insertStatement = "INSERT INTO `$table` (";
    $hexField        = array();
    for ($x = 0; $x < $num_fields; $x++) {
      $record = $this->db->db_fetch_assoc($records);
      if (($hexValue) && (backup::isTextValue($record['Type']))) {
        $selectStatement .= 'HEX(`' . $record['Field'] . '`)';
        $hexField[$x] = true;
      } else {
        $selectStatement .= '`' . $record['Field'] . '`';
        $insertStatement .= '`' . $record['Field'] . '`';
        $insertStatement .= ", ";
        $selectStatement .= ", ";
      }
    }
    $insertStatement = substr($insertStatement, 0, -2) . ') VALUES';
    $selectStatement = substr($selectStatement, 0, -2) . ' FROM `' . $table . '`';
    $records         = $this->db->db_query($selectStatement);
    $num_rows        = $this->db->db_rows($records);
    $num_fields      = $this->db->db_num_fields($records);
    if ($num_rows > 0) {
      $data .= $insertStatement;
      for ($i = 0; $i < $num_rows; $i++) {
        $record = $this->db->db_fetch_assoc($records);
        $data .= ' (';
        for ($j = 0; $j < $num_fields; $j++) {
          $field_name = $this->db->db_field_name($records, $j);
          if (isset($hexField[$j]) && $hexField[$j] && (strlen($record[$field_name]) > 0)) {
            $data .= "0x" . $record[$field_name];
          } else {
            $data .= "'" . str_replace('\"', '"', mswSQL($record[$field_name])) . "'";
          }
          $data .= ',';
        }
        $data = substr($data, 0, -1) . ")";
        $data .= ($i < ($num_rows - 1)) ? ',' : ';';
        $data .= mswNL();
        if (strlen($data) > 1048576) {
          backup::saveToFile($this->file, $data);
          $data = '';
        }
      }
      $data .= mswNL() . "-- --------------------------------------------------------" . mswNL() . mswNL();
      backup::saveToFile($this->file, $data);
    }
  }

  public function getDatabaseStructure() {
    $structure = '';
    $records   = $this->db->db_query("SHOW TABLES");
    if ($this->db->db_rows($records) == 0) {
      return false;
    }
    while ($record = $this->db->db_fetch_rows($records)) {
      $structure .= backup::getTableStructure($record[0]);
    }
    return true;
  }

  public function getDatabaseData($hexValue = true) {
    $records = $this->db->db_query("SHOW TABLES");
    if ($this->db->db_rows($records) == 0) {
      return false;
    }
    while ($record = $this->db->db_fetch_rows($records)) {
      if (in_array($record[0], $this->schema_tables)) {
        backup::getTableData($record[0], $hexValue);
      }
    }
  }

  public function getMySQLVersion() {
    $query   = $this->db->db_query("SELECT VERSION() AS v");
    $VERSION = $this->db->db_object($query);
    return (isset($VERSION->v) ? $VERSION->v : 'Unknown');
  }

  public function doDump() {
    $header = '#--------------------------------------------------------' . mswNL();
    $header .= '# MYSQL DATABASE SCHEMATIC (' . mswCD(strtoupper($this->settings->website)) . ')' . mswNL();
    $header .= '# ' . SCRIPT_NAME . ' v' . SCRIPT_VERSION . mswNL();
    $header .= '# www.' . SCRIPT_URL . mswNL();
    $header .= '# Created: ' . date($this->settings->dateformat) . ' @ ' . date($this->settings->timeformat) . mswNL();
    $header .= '# MySQL Version: ' . backup::getMySQLVersion() . mswNL();
    $header .= '#--------------------------------------------------------' . mswNL() . mswNL();
    backup::saveToFile($this->file, $header . 'SET FOREIGN_KEY_CHECKS = 0;' . mswNL() . mswNL());
    backup::getDatabaseStructure();
    backup::getDatabaseData($this->hexValue);
    backup::saveToFile($this->file, 'SET FOREIGN_KEY_CHECKS = 1;' . mswNL() . mswNL());
    backup::closeFile($this->file);
    return true;
  }

  public function writeDump($filename) {
    if (!backup::setOutputFile($filename)) {
      return false;
    }
    backup::doDump();
    backup::closeFile($this->file);
    return true;
  }

  public function getSqlKeysTable($table) {
    $primary         = '';
    $sqlKeyStatement = '';
    $unique          = array();
    $index           = array();
    $fulltext        = array();
    $results         = $this->db->db_query("SHOW KEYS FROM `{$table}`");
    if ($this->db->db_rows($results) == 0) {
      return false;
    }
    while ($row = $this->db->db_object($results)) {
      if (($row->Key_name == 'PRIMARY') AND ($row->Index_type == 'BTREE')) {
        if ($primary == '') {
          $primary = "  PRIMARY KEY  (`{$row->Column_name}`";
        } else {
          $primary .= ", `{$row->Column_name}`";
        }
      }
      if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '0') AND ($row->Index_type == 'BTREE')) {
        if (!isset($unique[$row->Key_name])) {
          $unique[$row->Key_name] = "  UNIQUE KEY `{$row->Key_name}` (`{$row->Column_name}`";
        } else {
          $unique[$row->Key_name] .= ", `{$row->Column_name}`";
        }
      }
      if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '1') AND ($row->Index_type == 'BTREE')) {
        if (!isset($index[$row->Key_name])) {
          $index[$row->Key_name] = "  KEY `{$row->Key_name}` (`{$row->Column_name}`";
        } else {
          $index[$row->Key_name] .= ", `{$row->Column_name}`";
        }
      }
      if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '1') AND ($row->Index_type == 'FULLTEXT')) {
        if (!isset($fulltext[$row->Key_name])) {
          $fulltext[$row->Key_name] = "  FULLTEXT `{$row->Key_name}` (`{$row->Column_name}`";
        } else {
          $fulltext[$row->Key_name] .= ", `{$row->Column_name}`";
        }
      }
    }
    if ($primary != '') {
      $sqlKeyStatement .= "," . mswNL();
      $primary .= ")";
      $sqlKeyStatement .= $primary;
    }
    if (is_array($unique)) {
      foreach ($unique AS $keyName => $keyDef) {
        $sqlKeyStatement .= "," . mswNL();
        $keyDef .= ")";
        $sqlKeyStatement .= $keyDef;
      }
    }
    if (is_array($index)) {
      foreach ($index AS $keyName => $keyDef) {
        $sqlKeyStatement .= "," . mswNL();
        $keyDef .= ")";
        $sqlKeyStatement .= $keyDef;
      }
    }
    if (is_array($fulltext)) {
      foreach ($fulltext AS $keyName => $keyDef) {
        $sqlKeyStatement .= "," . mswNL();
        $keyDef .= ")";
        $sqlKeyStatement .= $keyDef;
      }
    }
    return $sqlKeyStatement;
  }

  public function isTextValue($field_type) {
    switch($field_type) {
      case 'tinytext':
      case 'text':
      case 'mediumtext':
      case 'longtext':
      case 'binary':
      case 'varbinary':
      case 'tinyblob':
      case 'blob':
      case 'mediumblob':
      case 'longblob':
        return true;
        break;
      default:
        return false;
    }
  }

  public function openFile($filename) {
    $file = false;
    if ($this->compress) {
      $file = gzopen($filename, 'w9');
    } else {
      $file = fopen($filename, 'ab');
    }
    return $file;
  }

  public function saveToFile($file, $data) {
    if ($this->compress) {
      if ($file) {
        gzwrite($file, $data);
      }
    } else {
      if ($file) {
        fwrite($file, $data);
      }
    }
    $this->isWritten = true;
  }

  public function closeFile($file) {
    if ($this->compress) {
      if ($file) {
        gzclose($file);
      }
    } else {
      if ($file) {
        fclose($file);
      }
    }
  }

}

?>