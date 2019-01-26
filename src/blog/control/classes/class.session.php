<?php

/* CLASS FILE
----------------------------------*/

class sessHandlr {

  public function set($s = array(), $cookie = 'no') {
    foreach ($s AS $k => $v) {
      switch($cookie) {
        case 'yes':
          $_SESSION[$k] = $v;
          break;
        case 'no':
          $_SESSION[mswEnc(SECRET_KEY . $k . SECRET_KEY)] = $v;
          break;
      }
    }
  }

  public function get($key){
    return (isset($_SESSION[mswEnc(SECRET_KEY . $key . SECRET_KEY)]) ? $_SESSION[mswEnc(SECRET_KEY . $key . SECRET_KEY)] : '');
  }

  public function delete($s = array()) {
    if (!empty($s)) {
      foreach ($s AS $key) {
        unset($_SESSION[mswEnc(SECRET_KEY . $key . SECRET_KEY)]);
      }
    }
  }

  public function active($key) {
    return (isset($_SESSION[mswEnc(SECRET_KEY . $key . SECRET_KEY)]) ? 'yes' : 'no');
  }

}

?>