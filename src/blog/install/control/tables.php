<?php

if (!defined('PARENT') && defined('INSTALL_RUN')) {
  exit;
}

$engine = (isset($_POST['engine']) && in_array($_POST['engine'], array(
  'MyISAM',
  'InnoDB'
)) ? $_POST['engine'] : 'MyISAM');
$c      = (isset($_POST['charset']) ? $_POST['charset'] : $defChar);
$tableD = array();

if ($sqlVer < 5) {
  if ($c) {
    $split     = explode('_', $c);
    $tableType = 'DEFAULT CHARACTER SET ' . $split[0] . mswNL();
    $tableType .= 'COLLATE ' . $c . mswNL();
  }
  $tableType .= 'TYPE = ' . $engine;
} else {
  if ($c) {
    $split     = explode('_', $c);
    $tableType = 'CHARSET = ' . $split[0] . mswNL();
    $tableType .= 'COLLATE ' . $c . mswNL();
  }
  $tableType .= 'ENGINE = ' . $engine;
}

//============================================================
// INSTALL TABLE...BOXES..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "boxes`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "boxes` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `info` text default null,
  `ordr` int(5) NOT NULL DEFAULT '0',
  `en` enum('yes','no') NOT NULL DEFAULT 'yes',
  `tmp` varchar(250) NOT NULL DEFAULT '',
  `icon` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'boxes';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'boxes', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
  ++$count;
}

//============================================================
// INSTALL TABLE...CATEGORIES..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "categories`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text default null,
  `en` enum('yes','no') NOT NULL DEFAULT 'no',
  `metat` text default null,
  `slug` text default null,
  `ordr` int(6) NOT NULL DEFAULT '0',
  `user` varchar(250) NOT NULL DEFAULT '',
  `pass` varchar(40) NOT NULL DEFAULT '',
  `delts` int(20) NOT NULL DEFAULT '0',
  `display` enum('yes','no') not null default 'no',
  PRIMARY KEY (`id`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'categories';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'categories', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
}

//============================================================
// INSTALL TABLE...CAT JOURNAL..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "cat_journal`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "cat_journal` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `journal` int(8) NOT NULL DEFAULT '0',
  `category` int(8) NOT NULL DEFAULT '0',
  `private` enum('yes','no') NOT NULL DEFAULT 'no',
  `hidden` enum('yes','no') not null default 'no',
  PRIMARY KEY (`id`),
  KEY `prod_index` (`journal`),
  KEY `cat_index` (`category`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'cat_journal';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'cat_journal', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
  ++$count;
}

//============================================================
// INSTALL TABLE...ELOG..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "elog`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "elog` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(8) NOT NULL DEFAULT '0',
  `ts` int(15) DEFAULT NULL,
  `ip` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'elog';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'elog', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
  ++$count;
}

//============================================================
// INSTALL TABLE...JOURNALS..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "journals`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "journals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `staff` int(5) NOT NULL DEFAULT '0',
  `title` text default null,
  `comms` text default null,
  `encomms` enum('yes','no') NOT NULL DEFAULT 'no',
  `addts` int(20) NOT NULL DEFAULT '0',
  `pubts` int(20) NOT NULL DEFAULT '0',
  `delts` int(20) NOT NULL DEFAULT '0',
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  `rss` varchar(35) NOT NULL DEFAULT '',
  `metat` text default null,
  `slug` text default null,
  `tags` text default null,
  `stick` enum('yes','no') NOT NULL DEFAULT 'no',
  `user` varchar(250) NOT NULL DEFAULT '',
  `pass` varchar(40) NOT NULL DEFAULT '',
  `en` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `pubts` (`pubts`),
  KEY `en` (`en`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `comms` (`comms`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'journals';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'journals', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
  ++$count;
}

//============================================================
// INSTALL TABLE...PAGES..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "pages`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "pages` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '',
  `metat` text default null,
  `info` text default null,
  `en` enum('yes','no') NOT NULL DEFAULT 'yes',
  `tmp` varchar(250) NOT NULL DEFAULT '',
  `landing` enum('yes','no') NOT NULL DEFAULT 'no',
  `slug` varchar(250) NOT NULL DEFAULT '',
  `ordr` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'pages';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'pages', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
  ++$count;
}

//============================================================
// INSTALL TABLE...SETTINGS..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "settings`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "settings` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `website` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `addemails` text default null,
  `metadesc` text default null,
  `metakeys` text default null,
  `language` varchar(40) NOT NULL DEFAULT 'english',
  `ifolder` varchar(250) NOT NULL DEFAULT '',
  `theme` varchar(250) NOT NULL DEFAULT '_theme_default',
  `entheme` enum('yes','no') NOT NULL DEFAULT 'no',
  `dateformat` varchar(20) NOT NULL DEFAULT '',
  `timeformat` varchar(10) NOT NULL DEFAULT 'H:i:s',
  `timezone` varchar(50) NOT NULL DEFAULT 'Europe/London',
  `calformat` varchar(15) NOT NULL DEFAULT 'DD/MM/YYYY',
  `weekstart` enum('sun','mon') NOT NULL DEFAULT 'sun',
  `sysstatus` enum('yes','no') NOT NULL DEFAULT 'no',
  `reason` text default null,
  `autoenable` int(15) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL DEFAULT '',
  `encoder` varchar(10) NOT NULL DEFAULT '',
  `prodkey` varchar(60) NOT NULL DEFAULT '',
  `smtp_host` varchar(100) NOT NULL DEFAULT 'localhost',
  `smtp_user` varchar(100) NOT NULL DEFAULT '',
  `smtp_pass` varchar(100) NOT NULL DEFAULT '',
  `smtp_port` varchar(10) NOT NULL DEFAULT '25',
  `smtp_from` varchar(250) NOT NULL DEFAULT '',
  `smtp_email` varchar(250) NOT NULL DEFAULT '',
  `smtp_rfrom` varchar(250) NOT NULL DEFAULT '',
  `smtp_remail` varchar(250) NOT NULL DEFAULT '',
  `smtp_security` varchar(5) NOT NULL DEFAULT '',
  `smtp_debug` enum('yes','no') NOT NULL DEFAULT 'no',
  `afoot` text default null,
  `pfoot` text default null,
  `modr` enum('yes','no') NOT NULL DEFAULT 'no',
  `cache` enum('yes','no') NOT NULL DEFAULT 'no',
  `cachetime` varchar(10) NOT NULL DEFAULT '30',
  `defcats` varchar(250) NOT NULL DEFAULT '',
  `apikey` varchar(100) NOT NULL DEFAULT '',
  `apilog` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'settings';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'settings', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
  ++$count;
}

//============================================================
// INSTALL TABLE...SOCIAL..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "social`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "social` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `desc` varchar(50) NOT NULL DEFAULT '',
  `param` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `descK` (`desc`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'social';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'social', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
  ++$count;
}

//============================================================
// INSTALL TABLE...STAFF..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "staff`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `user` varchar(250) NOT NULL DEFAULT '',
  `pass` varchar(40) NOT NULL DEFAULT '',
  `type` enum('admin','restricted') NOT NULL DEFAULT 'restricted',
  `tweet` enum('yes','no') NOT NULL DEFAULT 'no',
  `perms` text default null,
  `en` enum('yes','no') NOT NULL DEFAULT 'yes',
  `delp` enum('yes','no') NOT NULL DEFAULT 'yes',
  `notes` text default null,
  `jrest` enum('yes','no') NOT NULL DEFAULT 'no',
  `notify` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'staff';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'staff', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
  ++$count;
}

//============================================================
// INSTALL TABLE...THEMES..
//============================================================

$DB->db_query("DROP TABLE IF EXISTS `" . DB_PREFIX . "themes`");
$query = $DB->db_query("
CREATE TABLE `" . DB_PREFIX . "themes` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(200) NOT NULL DEFAULT '',
  `from` int(15) NOT NULL DEFAULT '0',
  `to` int(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) $tableType", true);

if ($query === 'err') {
  $tableD[] = DB_PREFIX . 'themes';
  $ERR      = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'themes', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB);
  ++$count;
}

?>