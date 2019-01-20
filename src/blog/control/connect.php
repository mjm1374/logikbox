<?php

/*==============================================================================================
  DATABASE CONNECTION PARAMETERS
  Enter your database connection parameters below.
================================================================================================

  DO NOT edit the values in capitals, these are system constants.
  Edit the values on the right ONLY. Examples:

  define('DB_HOST', 'localhost');
  define('DB_USER', 'db_user');

  Important: The prefix is for people with only a single database. If you aren`t bothered
  about the prefix, do NOT comment it out. Leave it blank if no prefix is required.

================================================================================================*/

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'logikbox');
define('DB_PASS', 'SpaceStation2001*');
define('DB_NAME', 'logikbox');
define('DB_PREFIX', 'mw_');

/*============================================================================================================
  MYSQL CHARACTER SET
  ===================

  For more info visit:
  http://dev.mysql.com/doc/refman/5.0/en/charset.html

  utf8 should be fine in most cases.

============================================================================================================*/

define('DB_CHAR_SET', 'utf8');

/*============================================================================================================
  MYSQL LOCALE
  ============

  Specify the locale for your database. Where date_format is used to convert dates, this will convert the
  date into your own locale. If you aren`t sure, leave as is.

  For more info visit:
  http://dev.mysql.com/doc/refman/5.0/en/locale-support.html (MySQL5)
  http://dev.mysql.com/doc/refman/4.1/en/locale-support.html (MySQL4)

  Examples:
  define('DB_LOCALE', 'en_US'); = English/United States
  define('DB_LOCALE', 'en_AU'); = English/Australia
  define('DB_LOCALE', 'fi_FI'); = Finnish/Finland

============================================================================================================*/

define('DB_LOCALE', 'en_GB');

/*============================================================================================================
  MYSQL TIMEZONE
  ==============

  For more info visit:
  https://dev.mysql.com/doc/refman/5.5/en/time-zone-support.html

  This should not be changed unless you have issues where MySQL date filtering isn`t returning
  the expected results. This offset should correspond to the timezone set in your settings.

  This can be totally deactivated by entering a blank value.

============================================================================================================*/

define('DB_TIMEZONE', '+00:00');

/*============================================================================================================
  SECRET KEY OR SALT
  ==================

  Specify secret key (also known as salt). This is for security and is encrypted during script execution.
  DO NOT change this value at a later date. Change ONLY before a clean install.

  This should ideally be a mix of random numbers, letters and characters. You can use sha1 and md5 for added
  security. You should not use something that changes with each page load.

  GOOD examples:
  define('SECRET_KEY', 'jh7sghe[]]0gjhfger');
  define('SECRET_KEY', md5('jh7sghe[]]0gjhfger'));
  define('SECRET_KEY', sha1('jh7sghe[]]0gjhfger'));

  BAD examples:
  define('SECRET_KEY', rand(1111,9999));
  define('SECRET_KEY', sha1(rand(1111,9999)));

  If you are using this system on multiple domains, set a different key for each

============================================================================================================
*/

define('SECRET_KEY', 'ES(k$b^F5E+g(`C');

?>