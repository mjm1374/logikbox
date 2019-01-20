<?php

/* USER DEFINED OPTION
   Please read carefully. Change ONLY value on right
========================================================================*/

/* SYSTEM ADMIN FOLDER
   Name of admin folder. For security this is recommended
-------------------------------------------------------*/

define('ADM_FLDR_NAME', 'admin');

/* DEFAULT ITEMS TO SHOW PER PAGE
-------------------------------------------------------*/

define('DEF_PER_PAGE', 20);

/* JOURNALS TO SHOW PER PAGE
-------------------------------------------------------*/

define('JNLS_PER_PAGE', 10);

/* LATEST JOURNALS
   How many journals to show on homepage
-------------------------------------------------------*/

define('HOMEPAGE_LATEST', 5);

/* SEARCH LENGTH
   Words equal to this in length or less than length are omitted in search
-------------------------------------------------------*/

define('SEARCH_SKIP_WORD_LENGTH', 2);

/* ENABLE MAIL
   Switches mail ops on or off. Should always be on for live environment
   1 = On, 0 = Off
-------------------------------------------------------*/

define('MAIL_SWITCH', 1);

/* RECENT JOURNALS
   How many recent journals to show in right menu and footer
-------------------------------------------------------*/

define('RECENT_JOURNALS_MENU', 10);
define('RECENT_JOURNALS_FOOTER', 5);

/* SEARCH OPS
   Logs search keywords to text file. 1 = Yes, 0 = No
   Date format for log file
   Log file name
-------------------------------------------------------*/

define('LOG_SEARCH_KEYWORDS', 0);
define('LOG_SEARCH_DATE_FORMAT', 'd/m/Y');
define('LOG_SEARCH_FILE', 'search_keyword_log.csv');

/* ENABLE API EMAIL NOTIFICATIONS
   More info in the API docs
-------------------------------------------------------*/

define('ENABLE_API_NOTIFICATIONS', 1);

/* AUTO PARSE LINE BREAKS
   For BB code only. If on, auto adds line breaks, if off you must enter line breaks manually when adding blog
   Recommended setting is on. 1 = On, 0 = Off
-------------------------------------------------------*/

define('AUTO_PARSE_LINE_BREAKS', 1);

/* RSS OPTIONS
   RSS date format (Do not change)
   How many RSS journals to show for RSS feed
   Show private entries in RSS feed
-------------------------------------------------------*/

define('RSS_BUILD_DATE_FORMAT', date('r'));
define('RSS_JOURNALS', 30);
define('RSS_PRIVATE_SHOW', 1);

/* ENABLE BB CODE
   Useful for formatting blog entries. If off, no formatting is allowed
-------------------------------------------------------*/

define('EN_BB', 1);

/* RETAIN CALENDAR MONTH ON LOAD
   If on, retains calendar month on load. Session based only, resets when browser closes
   1 = On, 0 = Off
-------------------------------------------------------*/

define('RETAIN_CAL_MONTH_ON_LOAD', 1);

/* TWITTER USER PAGE
   Url for twitter page. Use {user} variable where username should go.
   Unlikely to need changing
-------------------------------------------------------*/

define('TWITTER_LNK', 'https://twitter.com/{user}');

/* CRON OPTIONS
   Keep cron backup file when backup cron runs
   Send cron backup email.
   1 = Yes, 0 = No
-------------------------------------------------------*/

define('KEEP_CRON_BACKUP_FILE', 0);
define('CRON_BACKUP_EMAIL', 1);

/* MAIL X HEADER
   Custom name for mailing system. Default to PHP mailer default
-------------------------------------------------------*/

define('MAIL_X_MAIL_HEADER', 'Journal Mailing System');

/* YOUTUBE EMBED CODE
   Adjust code if required for Youtube embed code

   {CODE} = Video code
-------------------------------------------------------*/

define('YOU_TUBE_EMBED_CODE','<iframe src="https://www.youtube.com/embed/{CODE}" style="border:0 !important" allowfullscreen></iframe>');

/* VIMEO EMBED CODE
   Adjust code if required for Vimeo embed code

   {CODE} = Video code
-------------------------------------------------------*/

define('VIMEO_EMBED_CODE', '<iframe src="https://player.vimeo.com/video/{CODE}" style="border:0 !important" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');

/* DAILY MOTION EMBED CODE
   Adjust code if required for Daily Motion embed code

   {CODE} = Video Code
-------------------------------------------------------*/

define('DAILY_MOTION_EMBED_CODE', '<iframe src="https://www.dailymotion.com/embed/video/{CODE}" style="border:0 !important" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');

/* SOUNDCLOUD PLAYER CODE
   Adjust code if required for soundcloud BB code

   {CODE} = Soundcloud URL
-------------------------------------------------------*/

define('SOUNDCLOUD_EMBED_CODE','<iframe width="100%" height="166" scrolling="no" style="border:0 !important" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{CODE}&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>');

/* MP3 PLAYER EMBED CODE - HTML5 ONLY
   Adjust code if required for mp3 bb code
   This is used in BB code tags.
   Where the mp3 path loads use {MP3}
-------------------------------------------------------*/

define('MP3_EMBED_CODE','<audio controls><source src="{MP3}" type="audio/mpeg">Your browser does not support MP3 files via HTML5 audio tags.</audio>');

/* SYSTEM LANGUAGE FOLDERS
   Change only if really necessary
-------------------------------------------------------*/

define('LANG_FLDR_EM', 'email-templates');
define('LANG_FLDR_ADM', 'admin');

/* MAIL 'FROM' HEADER OVERRIDES
  If your mail server requires specific from headers for all emails, enter here.
-------------------------------------------------------*/

define('MAIL_FROM_NAME_HEADER', '');
define('MAIL_FROM_EMAIL_HEADER', '');

/* FULLTEXT SEARCHING
   0 = Off, 1 = On
-------------------------------------------------------*/

define('FULLTEXT_SEARCH', 1);

?>