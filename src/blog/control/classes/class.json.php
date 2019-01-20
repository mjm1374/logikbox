<?php

/* CLASS FILE
----------------------------------*/

class json {

  public function encode($arr) {
    header('Content-type: application/json');
    return json_encode($arr);
  }

  public function decode($json) {
    $result = json_decode($json, true);
    $error  = '';
    switch(json_last_error()) {
      case JSON_ERROR_DEPTH:
        $error = ' - The maximum stack depth has been exceeded';
        break;
      case JSON_ERROR_STATE_MISMATCH:
        $error = ' - Invalid or malformed JSON';
        break;
      case JSON_ERROR_CTRL_CHAR:
        $error = ' - Control character error, possibly incorrectly encoded';
        break;
      case JSON_ERROR_SYNTAX:
        $error = ' - Syntax error';
        break;
      case JSON_ERROR_UTF8:
        $error = ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
    }
    if ($error) {
      try {
        throw new Exception('JSON Error: ' . $error);
      } catch(Exception $e) {
        $result = $e->getMessage();
      }
    }
    return $result;
  }

}

?>