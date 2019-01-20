<?php

/* CLASS FILE
----------------------------------*/

class modrw {

  public $settings;
  public $errs;
  public $config = array(
    'slugs' => array(
      'cat' => 'category',
      'arc' => 'archive',
      'jnl' => 'journal',
      'sch' => 'search',
      'npg' => 'page',
      'sch' => 'search',
      'rss' => 'rss',
      'cal' => 'calendar'
    )
  );

  public function parser() {
    switch($this->settings->modr) {
      case 'yes':
        $system = array();
        if (isset($_GET['_msw_'])) {
          // Check .htaccess file exists..
          if (!file_exists(PATH . '.htaccess')) {
            die('
             [<b>ERROR</b>] Search engine friendly urls are enabled but the .htaccess file is <b>not</b> present.<br><br>
             Please rename "<b>htaccess_COPY.txt</b>" to "<b>.htaccess</b>" and reload page.
            ');
          }
          if (in_array($_GET['_msw_'], $system)) {
            $_GET['p'] = $_GET['_msw_'];
          } else {
            $chop = explode('/', $_GET['_msw_']);
            if (isset($chop[0])) {
              // Category..
              if ($chop[0] == $this->config['slugs']['cat'] && isset($chop[1]) && count($chop) <= 3) {
                $_GET['c'] = $chop[1];
                if (isset($chop[2])) {
                  $_GET['next'] = (int) $chop[2];
                }
              // Archive..
              } elseif ($chop[0] == $this->config['slugs']['arc'] && isset($chop[1],$chop[2]) && count($chop) <= 4) {
                $_GET['a'] = (int) $chop[1] . '-' . (int) $chop[2];
                if (isset($chop[3])) {
                  $_GET['next'] = (int) $chop[3];
                }
              // Calendar Archive..
              } elseif ($chop[0] == $this->config['slugs']['cal'] && isset($chop[1],$chop[2],$chop[3]) && count($chop) <= 5) {
                $_GET['cl'] = (int) $chop[1] . '-' . (int) $chop[2] . '-' . (int) $chop[3];
                if (isset($chop[4])) {
                  $_GET['next'] = (int) $chop[4];
                }
              // Journal..
              } elseif ($chop[0] == $this->config['slugs']['jnl'] && isset($chop[1]) && count($chop) <= 2) {
                $_GET['j'] = $chop[1];
              // Search..
              } elseif ($chop[0] == $this->config['slugs']['sch'] && isset($chop[1]) && count($chop) <= 3) {
                $_GET['q'] = $chop[1];
                if (isset($chop[2])) {
                  $_GET['next'] = (int) $chop[2];
                }
              } elseif ($chop[0] == $this->config['slugs']['npg'] && isset($chop[1]) && count($chop) == 2) {
                $_GET['pg'] = $chop[1];
              } elseif ($chop[0] == $this->config['slugs']['rss'] && count($chop) == 1) {
                $_GET['rss'] = $chop[0];
              } else {
                if (!class_exists('Savant3_Filter')) {
                  include(PATH . 'control/engine/Savant3.php');
                }
                $SETTINGS = $this->settings;
                $msw_err_headers = $this->errs;
                include(PATH . 'control/system/headers/404.php');
                exit;
              }
            } else {
              if (!class_exists('Savant3_Filter')) {
                include(PATH . 'control/engine/Savant3.php');
              }
              $SETTINGS = $this->settings;
              $msw_err_headers = $this->errs;
              include(PATH . 'control/system/headers/404.php');
              exit;
            }
          }
        }
        break;
      case 'no':
        // Var should never exist if rewrite rules are off..
        if (isset($_GET['_msw_'])) {
          header("Location: " . $this->settings->ifolder);
          exit;
        }
        break;
    }
  }

  public function url($data = array()) {
    if ($data[0] == 'base_href') {
      return $this->settings->ifolder;
    } else {
      switch($this->settings->modr) {
        case 'yes':
          return $this->settings->ifolder . mswCD($data[0]);
          break;
        case 'no':
          return $this->settings->ifolder . (isset($data[1]) ? '?' . $data[1] : '?p=' . $data[0]);
          break;
      }
    }
  }

}

?>