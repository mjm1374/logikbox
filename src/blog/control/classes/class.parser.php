<?php

/* CLASS FILE
----------------------------------*/

class parser {

  public $settings;

  // Word wrap is on..Change if necessary..
  private $wordwrap = array('on', 200);

  // Display text based on whats enabled..
  public function txtParsingEngine($text, $admin = true) {
    $text = trim($text);
    if ($this->settings->enableBBCode == 'yes' || $admin) {
      return parser::wordWrap($this->bbCode->bbParser($text));
    } else {
      return parser::wordWrap(mswL2BR(parser::autoLinkParser($text)));
    }
  }

  // Wordwrap..
  public function wordWrap($text) {
    if ($this->wordwrap[0] == 'on') {
      return wordwrap($text, $this->wordwrap[1], mswNL(), true);
    }
    return $text;
  }

  // Make urls clickable..
  public function clickableUrl($matches) {
    $ret = '';
    $url = $matches[2];
    if (empty($url)) {
      return $matches[0];
    }
    // removed trailing [.,;:] from URL
    if (in_array(substr($url, -1), array(
      '.',
      ',',
      ';',
      ':'
    )) === true) {
      $ret = substr($url, -1);
      $url = substr($url, 0, strlen($url) - 1);
    }
    return $matches[1] . '<a href="' . $url . '" rel="nofollow" onclick="window.open(this);return false" title="' . $url . '">' . $url . '</a>' . $ret;
  }

  // Make FTP links clickable..
  public function clickableFTP($matches) {
    $ret  = '';
    $dest = $matches[2];
    $dest = 'http://' . $dest;
    if (empty($dest)) {
      return $matches[0];
    }
    // removed trailing [,;:] from URL
    if (in_array(substr($dest, -1), array(
      '.',
      ',',
      ';',
      ':'
    )) === true) {
      $ret  = substr($dest, -1);
      $dest = substr($dest, 0, strlen($dest) - 1);
    }
    return $matches[1] . '<a href="' . $dest . '" rel="nofollow" onclick="window.open(this);return false" title="' . $dest . '">' . $dest . '</a>' . $ret;
  }

  // Hyperlinks, no protocol..
  public function clickableUrlNP($matches) {
    $dest = $matches[2] . '.' . $matches[3] . $matches[4];
    return $matches[1] . '<a href="http://' . $dest . '" rel="nofollow">' . $dest . '</a>';
  }

  // Make email links clickable..
  public function clickableEmail($matches) {
    $email = $matches[2] . '@' . $matches[3];
    return $matches[1] . '<a href="mailto:' . $email . '" title="' . $email . '" rel="nofollow">' . $email . '</a>';
  }

  // Callback functions for link parsing..
  public function autoLinkParser($data) {
    $data = mswQT($data);
    $ext  = 'com|org|net|gov|edu|mil|co.uk|uk.com|us|info|biz|ws|name|mobi|cc|tv';
    // Auto parse links..borrowed from Wordpress..:)
    $data = preg_replace_callback('#(?!<.*?)(?<=[\s>])(\()?(([\w]+?)://((?:[\w\\x80-\\xff\#$%&~/\-=?@\[\](+]|[.,;:](?![\s<])|(?(1)\)(?![\s<])|\)))+))(?![^<>]*?>)#is', array(
      $this,
      'clickableUrl'
    ), $data);
    $data = preg_replace_callback("#(?!<.*?)([\s{}\(\)\[\]>])([a-z0-9\-\.]+[a-z0-9\-])\.($ext)((?:[/\#?][^\s<{}\(\)\[\]]*[^\.,\s<{}\(\)\[\]]?)?)(?![^<>]*?>)#is", array(
      $this,
      'clickableUrlNP'
    ), $data);
    $data = preg_replace_callback('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', array(
      $this,
      'clickableFTP'
    ), $data);
    $data = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', array(
      $this,
      'clickableEmail'
    ), $data);
    // Clean links within links..
    $data = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $data);
    return $data;
  }

}

?>