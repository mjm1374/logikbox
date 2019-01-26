<?php

if (!isset($MAILR) || !method_exists('mailr', 'addTag') || !isset($SETTINGS->id)) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

/* EMAIL LANGUAGE FILE
----------------------------------------------------------*/

include(GLOBAL_PATH . 'content/language/' . $SETTINGS->language . '/emails.php');

/* CUSTOM MAIL HEADERS
  -------------------------------------------------------------------------------------------
  Custom mail headers should always start 'X-'. Array key is custom header name and array
  value is the custom header value. Example:

  $customMailHeaders = array(
    'X-Custom'  => 'Value',
    'X-Custom2' => 'Value 2'
  );
---------------------------------------------------------------------------------------------*/

$customMailHeaders = array();

/* GLOBAL MAIL TAGS
  ------------------------------------------
  Tags here are sent to ALL emails..
--------------------------------------------*/

$MAILR->smtp_host  = $SETTINGS->smtp_host;
$MAILR->smtp_user  = $SETTINGS->smtp_user;
$MAILR->smtp_pass  = $SETTINGS->smtp_pass;
$MAILR->smtp_port  = $SETTINGS->smtp_port;
$MAILR->debug      = $SETTINGS->smtp_debug;
$MAILR->smtp_sec   = $SETTINGS->smtp_security;
$MAILR->sbjpref    = str_replace('{website}', $SETTINGS->website, $msw_emails_prefix);

$MAILR->htmlelements = array(
  'lang' => (isset($msw_html_lang) ? $msw_html_lang : 'en'),
  'dir' => (isset($msw_html_dir) ? $msw_html_dir : 'ltr'),
  'charset' => (isset($msw_mail_charset) ? $msw_mail_charset : 'utf-8')
);

$MAILR->xheaders    = $customMailHeaders;
$MAILR->config      = (array) $SETTINGS;
$MAILR->htmltags    = (isset($mailrTags) ? $mailrTags : array());
$MAILR->mailSwitch  = (MAIL_SWITCH ? 'yes' : 'no');

$MAILR->addTag('{SCRIPT_NAME}', SCRIPT_NAME);
$MAILR->addTag('{DATE}', date($SETTINGS->dateformat));
$MAILR->addTag('{TIME}', date($SETTINGS->timeformat));
$MAILR->addTag('{WEBSITE_NAME}', $SETTINGS->website);
$MAILR->addTag('{WEBSITE_EMAIL}', $SETTINGS->email);
$MAILR->addTag('{WEBSITE_URL}', $SETTINGS->ifolder);
$MAILR->addTag('{ADMIN_FOLDER}', (defined('ADM_FLDR_NAME') ? ADM_FLDR_NAME :'admin'));
$MAILR->addTag('{IP}', mswIP());

?>