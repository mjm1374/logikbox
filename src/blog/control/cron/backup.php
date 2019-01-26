<?php

/* DATABASE BACKUP - CRON
--------------------------------------------*/

date_default_timezone_set('UTC');

define('PARENT', 1);
define('PATH', substr(dirname(__file__), 0, strpos(dirname(__file__), 'control')-1) . '/');

include(PATH . 'control/classes/class.session.php');
$SSN = new sessHandlr();

include(PATH . 'control/userdef.php');
include(PATH . 'control/connect.php');
include(PATH . 'control/functions.php');
include(PATH . 'control/system/constants.php');
include(PATH . 'control/system/init.php');

include(LANG_FLDR . LANG_FLDR_ADM . '/backup.php');
include(LANG_FLDR . 'emails.php');
include(PATH . 'control/classes/class.db-backup.php');

/* DB BACKUP
--------------------------------------------*/

$fpath = PATH . LANG_FLDR_ADM . '/backup/db-backup-' . $DT->ts() . '.gz';
$DBB = new backup(array(
  'file' => $fpath,
  'cmp' => 'yes',
  'db' => $DB
));

$DBB->settings = $SETTINGS;
$DBB->db       = $DB;
$DBB->doDump();

//Send emails..
if (CRON_BACKUP_EMAIL) {
  if ($SETTINGS->email && file_exists($fpath)) {
    include(PATH . 'control/classes/mailer/global-mail-tags.php');
    $msg = mswTmp(MSW_EM_LANG . 'backup.txt');
    $sbj = str_replace('{website}', $SETTINGS->website, $msw_emails2);
    $MAILR->addTag('{DATE_TIME}', date($SETTINGS->dateformat) . ' @ ' . date($SETTINGS->timeformat));
    $MAILR->addTag('{VERSION}', SCRIPT_VERSION);
    $MAILR->addTag('{FILE}', basename($fpath));
    // Include attachment..
    $MAILR->attachments[$fpath] = basename($fpath);
    // Send..
    $MAILR->sendMail(array(
      'from_email' => ($SETTINGS->smtp_email ? $SETTINGS->smtp_email : $SETTINGS->email),
      'from_name' => ($SETTINGS->smtp_from ? $SETTINGS->smtp_from : $SETTINGS->website),
      'to_email' => $SETTINGS->email,
      'to_name' => $SETTINGS->website,
      'subject' => $sbj,
      'replyto' => array(
      'name' => ($SETTINGS->smtp_rfrom ? $SETTINGS->smtp_rfrom : $SETTINGS->website),
      'email' => ($SETTINGS->smtp_remail ? $SETTINGS->smtp_remail : $SETTINGS->email)
    ),
    'template' => $msg,
    'add-emails' => $SETTINGS->addemails,
    'language' => $SETTINGS->language
    ));
    $MAILR->smtpClose();
    // Delete backup file if set..
    if (!KEEP_CRON_BACKUP_FILE && file_exists($fpath)) {
      @unlink($fpath);
    }
  }
}

echo '[' . date('j F Y @ H:iA') . '] ' . $msw_cron . PHP_EOL . str_repeat('-=', 50) . PHP_EOL;
exit;

?>