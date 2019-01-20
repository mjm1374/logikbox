<?php

$modules = array(
  array(
    'CURL',
    'curl_init',
    'function',
    'http://php.net/manual/en/book.curl.php'
  ),
  array(
    'MYSQLI',
    'mysqli_connect',
    'function',
    'http://php.net/manual/en/book.mysqli.php'
  ),
  array(
    'JSON',
    'json_encode',
    'function',
    'http://php.net/manual/en/book.json.php'
  )
);

switch(MSW_PHP) {
  case 'old':
    $modules[] = array(
      'MCRYPT',
      'mcrypt_decrypt',
      'function',
      'http://php.net/manual/en/book.mcrypt.php'
    );
    break;
  case 'new':
    $modules[] = array(
      'OPENSSL',
      'openssl_encrypt',
      'function',
      'http://php.net/manual/en/ref.openssl.php'
    );
    break;
}

$permissions = array(
 LANG_FLDR_ADM . '/backup',
 'content/_theme_default/cache',
 'logs'
);

$cSets = $DB->db_charsets();

?>