<?php

/* CLASS FILE
----------------------------------*/

class graph extends db {

  public $dt;
  public $settings;
  public $years;

  public function display() {
    $arr = array(array(0,0,0,0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0,0,0,0));
    $q = db::db_query("SELECT count(*) AS `jC`,
         MONTH(FROM_UNIXTIME(`addts`)) AS `jM`,
         YEAR(FROM_UNIXTIME(`addts`)) AS `jY`
         FROM `" . DB_PREFIX . "journals`
         WHERE YEAR(FROM_UNIXTIME(`addts`)) IN('{$this->years[0]}','{$this->years[1]}')
         GROUP BY YEAR(FROM_UNIXTIME(`addts`)), MONTH(FROM_UNIXTIME(`addts`))
         ");
    while ($J = db::db_object($q)) {
      switch($J->jY){
        case $this->years[0]:
          $arr[0][($J->jM - 1)] = mswNFM($J->jC);
          break;
        case $this->years[1]:
          $arr[1][($J->jM - 1)] = mswNFM($J->jC);
          break;
      }
    }
    return array(
      implode(',', $arr[0]),
      implode(',', $arr[1])
    );
  }

}

?>