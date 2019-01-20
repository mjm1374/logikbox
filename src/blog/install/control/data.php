<?php

if (!defined('PARENT')) {
  exit;
}

$dataE = array();
$dtcount = 0;

//=========================
// INSTALL SETTINGS
//=========================

$DB->db_query("TRUNCATE TABLE `" . DB_PREFIX . "settings`");
$root = 'http://www.example.com/blog';
$zone = (isset($_POST['timezone']) ? $_POST['timezone'] : 'Europe/London');
if (isset($_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF'])) {
  $root = 'http' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], 'install') - 1) . '/';
}
if (!isset($_POST['timezone'])) {
  if (function_exists('date_default_timezone_get')) {
    $zone = date_default_timezone_get();
  }
  if ($zone == '' & @ini_get('date.timezone')) {
    $zone = @ini_get('date.timezone');
  }
}
$query = $DB->db_query("INSERT INTO `" . DB_PREFIX . "settings` (
  `id`, `website`, `email`, `addemails`, `metadesc`, `metakeys`, `language`, `ifolder`, `theme`, `entheme`, `dateformat`, `timeformat`, `timezone`,
  `calformat`, `weekstart`, `sysstatus`, `reason`, `autoenable`, `version`, `encoder`, `prodkey`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`,
  `smtp_from`, `smtp_email`, `smtp_rfrom`, `smtp_remail`, `smtp_security`, `smtp_debug`, `afoot`, `pfoot`, `modr`, `cache`, `cachetime`, `defcats`,
  `apikey`, `apilog`
) VALUES (
  1, 'My Journal', 'email@example.com', '', '', '', 'english', '" . mswSQL($root) . "', '_theme_default', 'no', 'j M Y', 'H:iA', '{$zone}', 'dd/mm/yyyy',
  'sun', 'yes', '', 0, '" . SCRIPT_VERSION . "', 'msw', '{$prodKey}', '', '', '', '587', '', '', '', '', '', 'yes', '', '', 'no', 'no', '30', '', '', 'yes'
)", true);

if ($query === 'err') {
  $dataE[] = DB_PREFIX . 'settings';
  $ERR     = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'settings', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB, 'Insert');
  ++$count;
  ++$dtcount;
}

//=========================
// INSTALL SOCIAL
//=========================

$DB->db_query("TRUNCATE TABLE `" . DB_PREFIX . "social`");
$query = $DB->db_query("INSERT INTO `" . DB_PREFIX . "social` (`desc`, `param`, `value`) VALUES
  ('disqus', 'disname', ''),
  ('disqus', 'discat', ''),
  ('twitter', 'conkey', ''),
  ('twitter', 'consecret', ''),
  ('twitter', 'token', ''),
  ('twitter', 'key', ''),
  ('twitter', 'username', ''),
  ('links', 'youtube', 'https://www.youtube.com'),
  ('links', 'instagram', 'https://www.instagram.com'),
  ('links', 'twitter', 'https://www.twitter.com'),
  ('links', 'facebook', 'https://www.facebook.com'),
  ('links', 'pinterest', 'https://www.pinterest.com'),
  ('links', 'flickr', 'https://www.flickr.com'),
  ('addthis', 'code', ''),
  ('struct', 'twitter', 'yes'),
  ('struct', 'fb', 'yes'),
  ('struct', 'google', 'yes'
)", true);
if ($query === 'err') {
  $dataE[] = DB_PREFIX . 'social';
  $ERR     = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'social', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB, 'Insert');
  ++$count;
  ++$dtcount;
}

//=========================
// INSTALL BOXES
//=========================

$DB->db_query("TRUNCATE TABLE `" . DB_PREFIX . "boxes`");
$query = $DB->db_query("INSERT INTO `" . DB_PREFIX . "boxes` (`title`, `info`, `ordr`, `en`, `tmp`, `icon`) VALUES
('Calendar', '', 1, 'yes', 'box_calendar.tpl.php', 'calendar'),
('Recent Journals', '', 2, 'yes', 'box_recent_journals.tpl.php', 'clock-o'
)", true);
if ($query === 'err') {
  $dataE[] = DB_PREFIX . 'boxes';
  $ERR     = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'boxes', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB, 'Insert');
  ++$count;
  ++$dtcount;
}

//===========================
// CACHE .HTACCESS CREATION
//===========================

if (mswAPM('mod_rewrite') == 'yes') {
  if (file_exists(REL_PATH . 'content/_theme_default/cache/index.html')) {
    @unlink(REL_PATH . 'content/_theme_default/cache/index.html');
  }
  if (!file_exists(REL_PATH . 'content/_theme_default/cache/.htaccess') && is_writeable(REL_PATH . 'content/_theme_default/cache')) {
    file_put_contents(REL_PATH . 'content/_theme_default/cache/.htaccess', '# No Access' . mswNL() . 'Deny from all');
    @chmod(REL_PATH . 'content/_theme_default/cache/.htaccess', 0664);
  }
} else {
  if (!file_exists(REL_PATH . 'content/_theme_default/cache/index.html') && is_writeable(REL_PATH . 'content/_theme_default/cache')) {
    file_put_contents(REL_PATH . 'content/_theme_default/cache/index.html', 'Access Denied');
    @chmod(REL_PATH . 'content/_theme_default/cache/index.html', 0664);
  }
}

?>