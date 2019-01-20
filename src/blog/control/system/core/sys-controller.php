<?php

/*
  SOFTWARE CONTROLLER FILE
  Please DO NOT make changes to this file, thank you

  This software is protected by UK laws. To modify this
  file to bypass the licence system is strictly forbidden
----------------------------------------------------------*/

if (!defined('PARENT')) {exit;}

switch(MSW_PHP) {
  case 'old':
    if (!function_exists('mcrypt_decrypt')) {
      die('Software Load Failure.<br><br>PHP <b>must</b> be compiled with <a href="http://php.net/manual/en/book.mcrypt.php">mcrypt</a> support.<br><br>Try enabling the mcrypt extension in the PHP.ini file and rebooting the server or recompile with mcrypt support.');
    }
    break;
  case 'new':
    if (!function_exists('openssl_encrypt')) {
      die('Software Load Failure.<br><br>PHP <b>must</b> be compiled with <a href="http://php.net/manual/en/ref.openssl.php">openssl</a> support.<br><br>Try enabling the openssl extension in the PHP.ini file and rebooting the server or recompile with openssl support.');
    }
    break;
}

if (!function_exists('mysqli_connect')) {
  die('Software Load Failure.<br><br>PHP <b>must</b> be compiled with <a href="http://php.net/manual/en/book.mysqli.php">mysqli_connect</a> support.');
}

define('LIC_PATH', substr(dirname(__file__), 0, strpos(dirname(__file__), 'control') - 1) . '/');
define('LIC_DOM', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''));
define('LIC_DOM_HOST', substr((isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''), 4));
define('LIC_UNI', '81393E818545A87DE8EF11C9744A14C5C2B61AC5');
define('LIC_ENC_SALT', 'wQdu9Eej3ARoge8tZJq4Mm16WfOpyMb3TNqkoKzdg8Irn8pU6vR26xvbYB0t3LWUv5YMI8Ddyw73jUT5EL6kFg==');
define('LIC_SOFTWARE', 'weblog');
define('RESTR_BOXES', 3);
define('RESTR_PAGES', 3);
define('RESTR_CATS', 5);
define('RESTR_STAFF', 2);
define('DEV_BETA', 'no');
define('DEV_BETA_EXP', '0000-00-00');

// Log cron data..
if (defined('LOG_CRON_GLOBALS')) {
  mswPUT(LIC_PATH . 'log/cron_info.txt', print_r($GLOBALS, true));
}

class mswLic extends db {

  private $cronFiles = array();

  private function mswLE() {
    $newline = "\r\n";
    if (isset($_SERVER["HTTP_USER_AGENT"]) && strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'win')) {
      $newline = "\r\n";
    } else if (isset($_SERVER["HTTP_USER_AGENT"]) && strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'mac')) {
      $newline = "\r";
    } else {
      $newline = "\n";
    }
    return (defined('PHP_EOL') ? PHP_EOL : $newline);
  }

  public function mswCheckLicence() {
    if (@file_exists(LIC_PATH . 'licence.lic')) {
      $Q       = db::db_query("SELECT `prodkey` FROM `" . DB_PREFIX . "settings`", true);
      if ($Q == 'err') {
        $fatalErr = true;
      } else {
        $s = db::db_object($Q);
      }
      $licfile = @file_get_contents(LIC_PATH . 'licence.lic');
      $file    = explode('------ MSW LIC FILE DATA -------', $licfile);
      // Decode here..
      if (MSW_PHP == 'old') {
        $dec     = mswLic::mswDecoder((isset($file[1]) ? $file[1] : '#'));
      } else {
        $dec     = mswLic::mswDecoder((isset($file[2]) ? $file[2] : '#:#'));
      }
      preg_match("/<mswlic>(.+)<\/mswlic>/si", $dec, $match);
      // If the prodkey field is missing, show message..
      if (isset($fatalErr) || (!isset($fatalErr) && !isset($s->prodkey))) {
        echo mswLic::mswRuntimeFatalError();
        exit;
      }
      if (isset($match[1]) && $match[1] == 'failed-cipher') {
        echo mswLic::mswRuntimeFatalError('cipher');
        exit;
      }
      if (isset($match[1]) && isset($s->prodkey)) {
        // Is this the free version?
        if (strtolower($match[1]) == 'free-' . LIC_SOFTWARE) {
          if (DEV_BETA != 'no' && !defined('LIC_DEV')) {
            if (@strtotime(DEV_BETA_EXP) > 0 && DEV_BETA_EXP < date('Y-m-d')) {
              echo mswLic::mswEventHandler(4, '', '', '', strtotime(DEV_BETA_EXP));
              exit;
            }
            define('LIC_BETA', DEV_BETA);
            define('LIC_BETA_VER', strtotime(DEV_BETA_EXP));
            return 'unlocked';
          }
          return (defined('LIC_DEV') ? 'unlocked' : 'locked');
        } else {
          if (isset($match[1])) {
            $block = explode('|', $match[1]);
            $alld  = array();
            $key   = (isset($block[0]) ? strtoupper($block[0]) : '');
            $uni   = (isset($block[1]) ? strtoupper($block[1]) : '');
            $scr   = (isset($block[2]) ? $block[2] : '');
            $dom   = (isset($block[3]) ? strtolower($block[3]) : '');
            $exp   = (isset($block[4]) ? $block[4] : '');
            $beta  = (isset($block[5]) ? explode(',', $block[5]) : '');
            // Domains to array..
            if (strpos($dom, ',') !== false) {
              $alld = explode(',', $dom);
            } else {
              $alld[] = $dom;
            }
            // Is this a beta version?
            if (isset($beta[0], $beta[1]) && @strtotime($beta[0]) > 0) {
              if (@strtotime($beta[0]) > 0 && $beta[0] < date('Y-m-d')) {
                echo mswLic::mswEventHandler(4, '', '', '', strtotime($beta[0]));
                exit;
              }
              define('LIC_BETA', $beta[0]);
              define('LIC_BETA_VER', strtotime($beta[1]));
              return 'unlocked';
            } else {
              if ($key && $uni && $scr && $dom) {
                // Check expiry..
                if ($exp && strtotime($exp) > 0) {
                  if ($exp < date('Y-m-d')) {
                    echo mswLic::mswEventHandler(7, '', '', '', strtotime($exp));
                    exit;
                  }
                }
                // Localhost and cron jobs..
                // Prevents cron running with errors..
                $cronHost = array(
                  'localhost',
                  '127.0.0.1',
                  '::1'
                );
                if (isset($_SERVER['argv'][0]) && in_array(basename($_SERVER['argv'][0]), $this->cronFiles)) {
                  define('CRON_RUNNING', 1);
                }
                if (isset($_SERVER['_']) && !defined('CRON_RUNNING')) {
                  define('CRON_RUNNING', 1);
                }
                // Logging..
                if (defined('LOG_CRON_GLOBALS')) {
                  $string  = 'LICENCE VALUES' . mswLic::mswLE() . '= = = = = = = = = = = = = = =' . mswLic::mswLE();
                  $string .= 'LIC_DOM VALUE: ' . LIC_DOM . mswLic::mswLE();
                  $string .= 'LIC_DOM_HOST VALUE: ' . LIC_DOM_HOST . mswLic::mswLE();
                  $string .= 'Localhost: ' . print_r($cronHost, true) . mswLic::mswLE();
                  $string .= 'All Domains: ' . print_r($alld, true) . mswLic::mswLE();
                  $string .= 'Dom Value: ' . $dom . mswLic::mswLE();
                  $string .= 'Server Vars: ' . print_r($_SERVER, true) . mswLic::mswLE();
                  mswPUT(LIC_PATH . LOG_FOLDER . '/cron_info.txt', trim($string));
                }
                // Check key..
                if ($key != strtoupper($s->prodkey)) {
                  echo mswLic::mswEventHandler(3, '', $key, $s);
                  exit;
                  // Check domain.
                } else if (!defined('LIC_BYPASS') && !defined('CRON_RUNNING') && !in_array(LIC_DOM, $cronHost) && !in_array(strtolower(LIC_DOM), $alld) && !in_array(strtolower(LIC_DOM_HOST), $alld) && strpos(LIC_DOM, $dom) === false) {
                  echo mswLic::mswEventHandler(2, $dom, '', $s);
                  exit;
                  // Check software..
                } else if (($uni != LIC_UNI) || ($scr != LIC_SOFTWARE)) {
                  echo mswLic::mswEventHandler(6, '', '', $s);
                  exit;
                  // All good..
                } else {
                  return 'unlocked';
                }
              } else {
                // Corrupt..
                echo mswLic::mswEventHandler(5, '', '', $s);
                exit;
              }
            }
          } else {
            // Corrupt..
            echo mswLic::mswEventHandler(5, '', '', $s);
            exit;
          }
        }
      } else {
        // Corrupt..
        echo mswLic::mswEventHandler(5, '', '', $s);
        exit;
      }
    } else {
      // Missing..
      echo mswLic::mswEventHandler(1);
      exit;
    }
  }

  public function mswEventHandler($code, $domain = '', $key = '', $s = '', $exp = 0) {
    if (defined('LOG_CRON_GLOBALS')) {
      $string  = 'CODE LOGGING' . mswLic::mswLE() . '= = = = = = = = = = = = = = =' . mswLic::mswLE();
      $string .= $code . mswLic::mswLE();
      mswPUT(LIC_PATH . LOG_FOLDER . '/cron_info.txt', trim($string));
    }
    switch ($code) {
      case '1':
        $e = 'This software requires a &quot;licence.lic&quot; file. It should be in the root of your software installation.';
        break;
      case '2':
        $e = 'The &quot;licence.lic&quot; file within this installation cannot run on this server because the domain specified in the licence instructions (' . $domain . ') is different to the installation domain (' . LIC_DOM . '). If you need to change the domain for your licence, please log into the <a href="https://www.maiangateway.com" onclick="window.open(this);return false">licence centre</a>';
        break;
      case '3':
        $e = 'The &quot;licence.lic&quot; file within this installation contains an invalid product key (' . $key . ').<br><br>Check this value against the product key on your purchase page in your script admin area.<br><br>This may be due to entering the key incorrectly on licence creation or you may have re-installed the software again, which created a new key.<br><br>If you have re-installed, please <a href="https://www.maiangateway.com" onclick="window.open(this);return false">update your product key</a> and re-download the licence again.';
        break;
      case '4':
        $e = 'This beta version expired on ' . date('j/M/Y', $exp) . '. All beta versions are valid for 1 month only.<br><br>If you are an active beta tester, please contact us for a new licence file.<br><span style="font-weight:normal"><a href="mailto:support@maianscriptworld.co.uk?subject=Beta%20Licence">support@maianscriptworld.co.uk</a></span><br><br>Remember that beta versions should NOT be used in a production environment.';
        break;
      case '5':
        $e = 'This &quot;licence.lic&quot; file appears to be corrupt. Please re-download and try again.<br><br>If this persists, please contact us.';
        break;
      case '6':
        $e = 'This &quot;licence.lic&quot; file appears to be for different software. Please re-download and try again.<br><br>If this persists, please contact us.';
        break;
      case '7':
        $e = 'This licence expired on ' . date('j/M/Y', $exp) . '.';
        break;
      default:
        $e = 'Unknown error. Please contact us for assistance.';
        break;
    }
    $doctype = '<!DOCTYPE html><html lang="en">';
    $footer  = '<p class="footer"><a href="https://www.maiangateway.com" onclick="window.open(this);return false">Maian Script World Licencing System</a> &copy;' . (date('Y') == 2017 ? '2017' : '2017 - ' . date('Y')) . ' David Ian Bennett &amp; Maian Script World</p>';
    $help    = 'If the above message wasn`t helpful, you should first see if a solution is in the software documentation ("docs" folder).<br><br>If that doesn`t help, please post on the <a href="https://www.maianscriptworld.co.uk/forums/" onclick="window.open(this);return false">support forums</a> at Maian Script World for <b>FREE</b> support.<br><br>If you have paid for a commercial licence, please send a message via the <a href="https://www.maiangateway.com" onclick="window.open(this);return false">Licence Centre</a>, thank you.<br><br>We apologise for any inconvenience and hope this issue is resolved as soon as possible.<br><br>David Ian Bennett<span class="leaddev">(Lead Developer - Maian Script World)</span>';
    return $doctype . '<head><meta charset="utf-8"><title>[' . SCRIPT_NAME . '] Licence Error</title><style type="text/css">body{background:#f8f8f8;font:15px arial;color:#555}a{color:#555}a:hover{text-decoration:none}p{margin:0;padding:0}.footer{font:11px arial;color:#fff;width:850px;margin:0 auto;text-align:right;padding:10px 0 0 0}.footer a{color:#fff}#wrapper{width:85%;margin:0 auto;padding:1px;margin-top:20px;background:#fff;border:1px solid #555;-webkit-border-radius: 5px 5px 5px 5px;-khtml-border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px}#wrapper .head {background:#ff9999;color:#fff;padding:20px;height:30px;font:normal 26px arial;-webkit-border-radius: 5px 5px 0 0;-khtml-border-radius: 5px 5px 0 0;-moz-border-radius: 5px 5px 0 0;border-radius: 5px 5px 0 0}.head span{float:right;color:#fff;font:26px arial;display:block}.msg{padding:20px;border-top:1px solid #555}.msg .error{display:block;background:#fff;margin:20px 0 20px 0;line-height:22px;padding:15px 0 15px 0;font-weight:bold;border-top:2px solid #ff9999;border-bottom:2px solid #ff9999}.leaddev{display:block;margin-top:5px;font-size:12px;font-style:italic}</style></head><body><div id="wrapper"><p class="head"><span>ERR CODE (' . ($code ? $code : 'N/A') . ')</span>' . strtoupper(SCRIPT_NAME) . '</p><p class="msg">The following licence error has occurred while running this software:<span class="error">' . $e . '</span>' . $help . '</p></div>' . $footer . '</body></html>';
  }

  static function mswSafe64Encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array(
      '+',
      '/',
      '='
    ), array(
      '-',
      '_',
      ''
    ), $data);
    return $data;
  }

  public function mswSafe64Decode($string) {
    $data = str_replace(array(
      '-',
      '_'
    ), array(
      '+',
      '/'
    ), $string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
      $data .= substr('====', $mod4);
    }
    return base64_decode($data);
  }

  public function mswEncoder($value) {
    if (!$value) {
      return false;
    }
    switch(MSW_PHP) {
      case 'old':
        $text      = $value;
        $iv_size   = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv        = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_mswEncrypt(MCRYPT_RIJNDAEL_256, substr(LIC_UNI, 0, 32), $text, MCRYPT_MODE_ECB, $iv);
        return trim(mswLic::mswSafe64Encode($crypttext));
        break;
      case 'new':
        $text      = $value;
        $iv        = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        $encrypted = openssl_encrypt($text, 'AES-256-CBC', LIC_ENC_KEY, 0, $iv);
        return trim($encrypted . ':' . mswLic::mswSafe64Encode($iv));
        break;
    }
  }

  public function mswDecoder($value) {
    if (!$value) {
      return false;
    }
    switch(MSW_PHP) {
      case 'old':
        $crypttext   = mswLic::mswSafe64Decode($value);
        $iv_size     = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv          = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, substr(LIC_UNI, 0, 32), $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
        break;
      case 'new':
        $ciphers     = openssl_get_cipher_methods();
        $parts       = explode(':', $value);
        // Uppercase...
        if (isset($parts[0], $parts[1]) && in_array('AES-256-CBC', $ciphers)) {
          return trim(openssl_decrypt($parts[0], 'AES-256-CBC', LIC_ENC_KEY, 0, mswLic::mswSafe64Decode($parts[1])));
        }
        // Might even be lowercase..
        if (isset($parts[0], $parts[1]) && in_array('aes-256-cbc', $ciphers)) {
          return trim(openssl_decrypt($parts[0], 'aes-256-cbc', LIC_ENC_KEY, 0, mswLic::mswSafe64Decode($parts[1])));
        }
        return 'failed-cipher';
        break;
    }
  }

  public function mswSysCheck() {
    $err = array();
    $cnt = 0;
    if (phpVersion() < MSW_PHP_MIN_VER) {
      $err[] = '(' . (++$cnt) . ') Your PHP version of ' . phpVersion() . ' is too old to run this software. v' . MSW_PHP_MIN_VER . '+ is required';
    } else {
      if (is_dir(LIC_PATH . 'install')) {
        $err[] = '(' . (++$cnt) . ') Please remove or rename the "install" folder in your software directory.';
      }
      if (SECRET_KEY == 'maian-blog-system') {
        $err[] = '(' . (++$cnt) . ') Secret key in database connection file (control/connect.php) MUST be renamed for security.';
      }
      if (!function_exists('json_encode')) {
        $err[] = '(' . (++$cnt) . ') <a href="http://www.php.net//manual/en/book.json.php" onclick="window.open(this);return false">JSON</a> functions NOT enabled. Please recompile server with json support.';
      }
      if (defined('MSW_PHP') && MSW_PHP == 'old' && !function_exists('mcrypt_decrypt')) {
        $err[] = '(' . (++$cnt) . ') <a href="http://php.net/manual/en/book.mcrypt.php" onclick="window.open(this);return false">MCRYPT</a> library NOT found. Please recompile server with mcrypt support.';
      }
      if (defined('MSW_PHP') && MSW_PHP == 'new' && !function_exists('openssl_encrypt')) {
        $err[] = '(' . (++$cnt) . ') <a href="http://php.net/manual/en/ref.openssl.php" onclick="window.open(this);return false">OPENSSL</a> functions NOT found. Please recompile server with openssl support.';
      }
      if (!function_exists('curl_init')) {
        $err[] = '(' . (++$cnt) . ') <a href="http://www.php.net/manual/en/book.curl.php" onclick="window.open(this);return false">CURL</a> functions NOT enabled. Please recompile server with curl support.';
      }
    }
    if (!empty($err)) {
      $doctype = '<!DOCTYPE html><html lang="en">';
      $footer  = '<p class="footer"><a href="https://www.' . SCRIPT_URL . '" onclick="window.open(this);return false">' . SCRIPT_NAME . '</a> &copy;' . (date('Y') == 2017 ? '2017' : '2017 - ' . date('Y')) . ' David Ian Bennett &amp; Maian Script World</p>';
      $help    = 'If any modules are missing and you don`t understand how to enable them, please contact your web host who should be able to assist as in most cases, root server access is required.<br><br>If you require information, please post on the <a href="https://www.maianscriptworld.co.uk/forums/" onclick="window.open(this);return false">support forums</a> at Maian Script World for <b>FREE</b> support.<br><br>If you have paid for a commercial licence, please send a message via the <a href="https://www.maiangateway.com" onclick="window.open(this);return false">Licence Centre</a>, thank you.<br><br>I apologise for any inconvenience.<br><br>David Ian Bennett<span class="leaddev">(Lead Developer - Maian Script World)</span>';
      return $doctype . '<head><meta charset="utf-8"><title>[' . SCRIPT_NAME . '] Runtime Error(s)</title><style type="text/css">body{background:#f8f8f8;font:15px arial;color:#555}a{color:#555}a:hover{text-decoration:none}p{margin:0;padding:0}.footer{font:11px arial;color:#fff;width:850px;margin:0 auto;text-align:right;padding:10px 0 0 0}.footer a{color:#fff}#wrapper{width:85%;margin:0 auto;padding:1px;margin-top:20px;background:#fff;border:1px solid #555;-webkit-border-radius: 5px 5px 5px 5px;-khtml-border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px}#wrapper .head {background:#ff9999;color:#fff;padding:20px;height:30px;font:normal 26px arial;-webkit-border-radius: 5px 5px 0 0;-khtml-border-radius: 5px 5px 0 0;-moz-border-radius: 5px 5px 0 0;border-radius: 5px 5px 0 0}.head span{float:right;color:#fff;font:26px arial;display:block}.msg{padding:20px;border-top:1px solid #555}.msg .error{display:block;background:#fff;margin:20px 0 20px 0;line-height:22px;padding:15px 0 15px 0;font-weight:bold;border-top:2px solid #ff9999;border-bottom:2px solid #ff9999}.leaddev{display:block;margin-top:5px;font-size:12px;font-style:italic}</style></head><body><div id="wrapper"><p class="head"><span>RUNTIME ERRORS</span>' . strtoupper(SCRIPT_NAME) . '</p><p class="msg">The following runtime errors have occurred while running this software:<span class="error">' . implode('<br><br>', $err) . '</span>' . $help . '</p></div>' . $footer . '</body></html>';
    }
  }

  public function mswRuntimeFatalError($flag = '') {
    $err     = array();
    if ($flag == 'cipher') {
      $err[] = 'PHP must be compiled with OpenSSL support and the "AES-256-CBC" cipher must be available.<br><br>Please recompile PHP and reboot server';
    } else {
      $err[]   = 'Database failed. Did you run the installer? <a href="install/">Attempt to Load Installer</a><br><br>If link fails, access the "/install/" directory in your installation.';
    }
    $doctype = '<!DOCTYPE html><html lang="en">';
    $footer  = '<p class="footer"><a href="https://www.' . SCRIPT_URL . '" onclick="window.open(this);return false">' . SCRIPT_NAME . '</a> &copy;' . (date('Y') == 2017 ? '2017' : '2017 - ' . date('Y')) . ' David Ian Bennett &amp; Maian Script World</p>';
    $help    = 'If you don`t understand the above message and require assistance, please post on the <a href="https://www.maianscriptworld.co.uk/forums/" onclick="window.open(this);return false">support forums</a> at Maian Script World for <b>FREE</b> support.<br><br>If you have paid for a commercial licence, please send a message via the <a href="https://www.maiangateway.com" onclick="window.open(this);return false">Licence Centre</a>, thank you.<br><br>I apologise for any inconvenience.<br><br>David Ian Bennett<span class="leaddev">(Lead Developer - Maian Script World)</span>';
    return $doctype . '<head><meta charset="utf-8"><title>[' . SCRIPT_NAME . '] Runtime Error(s)</title><style type="text/css">body{background:#f8f8f8;font:15px arial;color:#555}a{color:#555}a:hover{text-decoration:none}p{margin:0;padding:0}.footer{font:11px arial;color:#fff;width:850px;margin:0 auto;text-align:right;padding:10px 0 0 0}.footer a{color:#fff}#wrapper{width:85%;margin:0 auto;padding:1px;margin-top:20px;background:#fff;border:1px solid #555;-webkit-border-radius: 5px 5px 5px 5px;-khtml-border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px}#wrapper .head {background:#ff9999;color:#fff;padding:20px;height:30px;font:normal 26px arial;-webkit-border-radius: 5px 5px 0 0;-khtml-border-radius: 5px 5px 0 0;-moz-border-radius: 5px 5px 0 0;border-radius: 5px 5px 0 0}.head span{float:right;color:#fff;font:26px arial;display:block}.msg{padding:20px;border-top:1px solid #555}.msg .error{display:block;background:#fff;margin:20px 0 20px 0;line-height:22px;padding:15px 0 15px 0;font-weight:bold;border-top:2px solid #ff9999;border-bottom:2px solid #ff9999}.leaddev{display:block;margin-top:5px;font-size:12px;font-style:italic}</style></head><body><div id="wrapper"><p class="head"><span>RUNTIME ERRORS</span>' . strtoupper(SCRIPT_NAME) . '</p><p class="msg">The following runtime errors have occurred while running this software:<span class="error">' . implode('<br><br>', $err) . '</span>' . $help . '</p></div>' . $footer . '</body></html>';
  }

  public function mswSysFreeCheck() {
    $err = array();
    $cnt = 0;
    if ($this->db_rowcount('categories') > RESTR_CATS) {
      $err[] = '(' . (++$cnt) . ') The free version permits the following number of categories: ' . RESTR_CATS;
    }
    if ($this->db_rowcount('staff') > RESTR_STAFF) {
      $err[] = '(' . (++$cnt) . ') The free version permits the following number of additional staff: ' . RESTR_STAFF;
    }
    if ($this->db_rowcount('boxes') > RESTR_BOXES) {
      $err[] = '(' . (++$cnt) . ') The free version permits the following number of menu boxes: ' . RESTR_BOXES;
    }
    if ($this->db_rowcount('pages') > RESTR_PAGES) {
      $err[] = '(' . (++$cnt) . ') The free version permits the following number of additional pages: ' . RESTR_PAGES;
    }
    if (!empty($err)) {
      $doctype = '<!DOCTYPE html><html lang="en">';
      $footer  = '<p class="footer"><a href="https://www.' . SCRIPT_URL . '" onclick="window.open(this);return false">' . SCRIPT_NAME . '</a> &copy;' . (date('Y') == 2017 ? '2017' : '2017 - ' . date('Y')) . ' David Ian Bennett &amp; Maian Script World</p>';
      $help    = 'If you made manual changes in your database, please revert these changes back to remove this error. If you have paid for a commercial licence, please generate your licence at the <a href="https://www.maiangateway.com" onclick="window.open(this);return false">Licence Centre</a> to remove this error, thank you.<br><br>A commercial licence offers the following benefits:<br><br><span style="color:#225d6d;font-style:italic;display:block">+ ALL Future upgrades FREE of Charge<br>
      + Notifications of new version releases<br>
      + All features unlocked and unlimited<br>
      + Copyright removal included in price<br>
      + No links in email footers<br>
      + One off payment, no subscriptions<br>
      + 12 Months priority support (renewable)</span><br>Click the purchase link in your admin area for more information.<br><br>I apologise for any inconvenience.<br><br>David Ian Bennett<span class="leaddev">(Lead Developer - Maian Script World)</span>';
      return $doctype . '<head><meta charset="utf-8"><title>[' . SCRIPT_NAME . '] Free Version Error(s)</title><style type="text/css">body{background:#f8f8f8;font:15px arial;color:#555}a{color:#555}a:hover{text-decoration:none}p{margin:0;padding:0}.footer{font:11px arial;color:#fff;width:850px;margin:0 auto;text-align:right;padding:10px 0 0 0}.footer a{color:#fff}#wrapper{width:85%;margin:0 auto;padding:1px;margin-top:20px;background:#fff;border:1px solid #555;-webkit-border-radius: 5px 5px 5px 5px;-khtml-border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px}#wrapper .head {background:#ff9999;color:#fff;padding:20px;height:30px;font:normal 26px arial;-webkit-border-radius: 5px 5px 0 0;-khtml-border-radius: 5px 5px 0 0;-moz-border-radius: 5px 5px 0 0;border-radius: 5px 5px 0 0}.head span{float:right;color:#fff;font:26px arial;display:block}.msg{padding:20px;border-top:1px solid #555}.msg .error{display:block;background:#fff;margin:20px 0 20px 0;line-height:22px;padding:15px 0 15px 0;font-weight:bold;border-top:2px solid #ff9999;border-bottom:2px solid #ff9999}.leaddev{display:block;margin-top:5px;font-size:12px;font-style:italic}</style></head><body><div id="wrapper"><p class="head"><span>FREE VERSION ERRORS</span>' . strtoupper(SCRIPT_NAME) . '</p><p class="msg">The following errors have occurred while running this software:<span class="error">' . implode('<br><br>', $err) . '</span>' . $help . '</p></div>' . $footer . '</body></html>';
    }
  }

}

// Initialise..
$MSWLIC = new mswLic();
define('LIC_ENC_KEY', sha1(sha1(mswLic::mswSafe64Encode(LIC_ENC_SALT))) . sha1(mswLic::mswSafe64Encode(LIC_ENC_SALT)));
define('LICENCE_VER', $MSWLIC->mswCheckLicence());

// System check..
if (!defined('LIC_DEV')) {
  $err = $MSWLIC->mswSysCheck();
  if ($err) {
    echo $err;
    exit;
  }
}
// Free version check..
if (!defined('LIC_DEV') && !defined('ADMIN_PANEL')) {
  if (LICENCE_VER == 'locked') {
    $err = $MSWLIC->mswSysFreeCheck();
    if ($err) {
      echo $err;
      exit;
    }
  }
}

?>