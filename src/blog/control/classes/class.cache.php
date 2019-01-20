<?php

/* CLASS FILE
----------------------------------*/

class cache {

  public function __construct($s) {
    // Options..Change if required..
    $this->cache_options = array(
      // Is cache enabled?..
      'cache_enable' => 'no',
      // Expiry time in minutes..
      'expiry_time' => $s->cachetime,
      // Current timestamp..
      'current_time' => strtotime(date('Y-m-d H:i:s')),
      // Cache directory path (must be writeable. DO NOT CHANGE!!)
      'cache_dir' => GLOBAL_PATH . (defined('THEME_FOLDER') ? THEME_FOLDER . '/' : '') . 'cache',
      // Preferred cache extension..
      'cache_ext' => '.cache',
      // Settings..
      'settings' => $s
    );
  }

  public function cache_link($nm) {
    return $this->cache_options['cache_dir'] . '/' . $nm . $this->cache_options['cache_ext'];
  }

  public function cache_file($file, $data) {
    if ($this->cache_options['cache_enable'] == 'yes' && $data) {
      if (file_exists($file)) {
        @unlink($file);
      }
      if (is_dir($this->cache_options['cache_dir']) && is_writeable($this->cache_options['cache_dir'])) {
        mswPUT($file, trim($data));
      }
    } else {
      cache::clear_cache();
    }
  }

  public function cache_time($f) {
    return strtotime(date('Y-m-d H:i:s', filemtime($f)));
  }

  public function cache_exp($t) {
    if ($this->cache_options['cache_enable'] == 'yes') {
      if ($this->cache_options['expiry_time'] > 0) {
        $diff = round(($this->cache_options['current_time'] - $t) / 60, 0);
        // If we are within cache time, return cache file..
        if ($t > 0 && $diff <= $this->cache_options['expiry_time']) {
          return 'load';
        }
      } else {
        return 'load';
      }
    } else {
      cache::clear_cache();
    }
    return 'cache';
  }

  public function cache_serialize($data = array()) {
    return serialize($data);
  }

  public function cache_unserialize($file) {
    return unserialize(file_get_contents($file));
  }

  public function clear_cache_file($file) {
    $dir = opendir(GLOBAL_PATH . 'content');
    while (false !== ($read = readdir($dir))) {
      if (is_dir(GLOBAL_PATH . 'content/' . $read) && substr($read, 0, 6) == '_theme') {
        if (is_array($file)) {
          if (!empty($file)) {
            foreach ($file AS $f) {
              if (strpos($f, '*') !== false) {
                $wild = str_replace('*','',$f);
                cache::clear_cache($wild);
              } else {
                if (file_exists(GLOBAL_PATH . 'content/' . $read . '/cache/' . $f . $this->cache_options['cache_ext'])) {
                  @unlink(GLOBAL_PATH . 'content/' . $read . '/cache/' . $f . $this->cache_options['cache_ext']);
                }
                cache::cache_flags($f, $read);
              }
            }
          }
        } else {
          if (strpos($file, '*') !== false) {
            $wild = str_replace('*','',$file);
            cache::clear_cache($wild);
          } else {
            if (file_exists(GLOBAL_PATH . 'content/' . $read . '/cache/' . $file . $this->cache_options['cache_ext'])) {
              @unlink(GLOBAL_PATH . 'content/' . $read . '/cache/' . $file . $this->cache_options['cache_ext']);
            }
            cache::cache_flags($file, $read);
          }
        }
      }
    }
    closedir($dir);
  }

  public function clear_cache($wildcard = '') {
    if (is_dir(GLOBAL_PATH . 'content')) {
      $thm = opendir(GLOBAL_PATH . 'content');
      while (false !== ($thmread = readdir($thm))) {
        if (is_dir(GLOBAL_PATH . 'content/' . $thmread) && substr($thmread, 0, 6) == '_theme') {
          if (is_dir(GLOBAL_PATH . 'content/' . $thmread . '/cache')) {
            $dir = opendir(GLOBAL_PATH . 'content/' . $thmread . '/cache');
            while (false !== ($read = readdir($dir))) {
              $info = pathinfo(GLOBAL_PATH . 'content/' . $thmread . '/cache/' . $read);
              if (isset($info['extension']) && $info['extension']) {
                if ($wildcard && strpos($read, $wildcard) !== false) {
                  @unlink(GLOBAL_PATH . 'content/' . $thmread . '/cache/' . $read);
                } else {
                  if ($wildcard == '' && '.' . strtolower($info['extension']) == strtolower($this->cache_options['cache_ext'])) {
                    @unlink(GLOBAL_PATH . 'content/' . $thmread . '/cache/' . $read);
                  }
                }
              }
            }
            closedir($dir);
          }
        }
      }
      closedir($thm);
    }
  }

  public function cache_flags($file, $dir) {
    $var = array('guest','personal','trade');
    foreach ($var AS $vars) {
      if (file_exists(GLOBAL_PATH . 'content/' . $dir . '/cache/' . $file . '-' . $vars . $this->cache_options['cache_ext'])) {
        @unlink(GLOBAL_PATH . 'content/' . $dir . '/cache/' . $file . '-' . $vars . $this->cache_options['cache_ext']);
      }
    }
  }

  // Not used..
  public function cache_size() {
    $size = 0;
    if (is_dir($this->cache_options['cache_dir'])) {
      $dir = opendir($this->cache_options['cache_dir']);
      while (false !== ($read = readdir($dir))) {
        $info = pathinfo($this->cache_options['cache_dir'] . '/' . $read);
        if (isset($info['extension']) && $info['extension'] && '.' . $info['extension'] == $this->cache_options['cache_ext']) {
          $size += @filesize($this->cache_options['cache_dir'] . '/' . $read);
        }
      }
      closedir($dir);
    }
    return mswFCNV($size);
  }

}

?>