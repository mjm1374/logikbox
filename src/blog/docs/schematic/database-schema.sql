-- --------------------------------------------------------
-- MySQL 5 SCHEMA - MAIAN WEBLOG
-- This does NOT install the demo system.
-- --------------------------------------------------------

DROP TABLE IF EXISTS `mw_boxes`;
CREATE TABLE IF NOT EXISTS `mw_boxes` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `info` text default null,
  `ordr` int(5) NOT NULL DEFAULT '0',
  `en` enum('yes','no') NOT NULL DEFAULT 'yes',
  `tmp` varchar(250) NOT NULL DEFAULT '',
  `icon` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `mw_boxes` (`title`, `info`, `ordr`, `en`, `tmp`, `icon`) VALUES
	('Calendar', '', 1, 'yes', 'box_calendar.tpl.php', 'calendar'),
  ('Recent Journals', '', 2, 'yes', 'box_recent_journals.tpl.php', 'clock-o');

DROP TABLE IF EXISTS `mw_categories`;
CREATE TABLE IF NOT EXISTS `mw_categories` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mw_cat_journal`;
CREATE TABLE IF NOT EXISTS `mw_cat_journal` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `journal` int(8) NOT NULL DEFAULT '0',
  `category` int(8) NOT NULL DEFAULT '0',
  `private` enum('yes','no') NOT NULL DEFAULT 'no',
  `hidden` enum('yes','no') not null default 'no',
  PRIMARY KEY (`id`),
  KEY `prod_index` (`journal`),
  KEY `cat_index` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mw_elog`;
CREATE TABLE IF NOT EXISTS `mw_elog` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(8) NOT NULL DEFAULT '0',
  `ts` int(15) DEFAULT NULL,
  `ip` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mw_journals`;
CREATE TABLE IF NOT EXISTS `mw_journals` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mw_pages`;
CREATE TABLE IF NOT EXISTS `mw_pages` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mw_settings`;
CREATE TABLE IF NOT EXISTS `mw_settings` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `mw_settings` (`website`, `email`, `addemails`, `metadesc`, `metakeys`, `language`, `ifolder`, `theme`, `entheme`, `dateformat`, `timeformat`, `timezone`, `calformat`, `weekstart`, `sysstatus`, `reason`, `autoenable`, `version`, `encoder`, `prodkey`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `smtp_from`, `smtp_email`, `smtp_rfrom`, `smtp_remail`, `smtp_security`, `smtp_debug`, `afoot`, `pfoot`, `modr`, `cache`, `cachetime`, `defcats`, `apikey`, `apilog`) VALUES
	('My Journal', 'email@example.com', '', '', '', 'english', '', '_theme_default', 'no', 'j M Y', 'H:iA', '', 'dd/mm/yyyy', 'sun', 'yes', '', 0, 'manual', 'msw', '', '', '', '', '587', '', '', '', '', '', 'yes', '', '', 'no', 'no', '30', '', '', 'yes');

DROP TABLE IF EXISTS `mw_social`;
CREATE TABLE IF NOT EXISTS `mw_social` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `desc` varchar(50) NOT NULL DEFAULT '',
  `param` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `descK` (`desc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `mw_social` (`desc`, `param`, `value`) VALUES
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
  ('links', 'flickr', 'https://www.flickr.com'),
  ('addthis', 'code', ''),
  ('struct', 'twitter', 'yes'),
  ('struct', 'fb', 'yes'),
  ('struct', 'google', 'yes');

DROP TABLE IF EXISTS `mw_staff`;
CREATE TABLE IF NOT EXISTS `mw_staff` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mw_themes`;
CREATE TABLE IF NOT EXISTS `mw_themes` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(200) NOT NULL DEFAULT '',
  `from` int(15) NOT NULL DEFAULT '0',
  `to` int(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;