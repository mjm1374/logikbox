<?php

/* API HANDLER
----------------------------------------------------*/

if (!defined('PARENT') || !defined('MSWAPI')) {
  include(PATH . 'control/system/headers/403.php');
  exit;
}

if ($SETTINGS->apikey == '') {
  exit;
}

include(LANG_FLDR . 'api.php');
$APID = $JSON->decode($apiDetect);

if ($SETTINGS->apikey && isset($APID['apikey']) && $APID['apikey'] == $SETTINGS->apikey) {
  $API->log($msw_api);
  // Journals variables..
  $fm = array(
    'staff' => (isset($APID['journal']['staff']) && $APID['journal']['staff'] > 0 ? (int) $APID['journal']['staff'] : '0'),
    'title' => (isset($APID['journal']['title']) ? $APID['journal']['title'] : ''),
    'comms' => (isset($APID['journal']['comms']) ? $APID['journal']['comms'] : ''),
    'metat' => (isset($APID['journal']['metat']) ? $APID['journal']['metat'] : ''),
    'tags' => (isset($APID['journal']['tags']) ? $APID['journal']['tags'] : ''),
    'slug' => (isset($APID['journal']['slug']) ? mswSlug($APID['journal']['slug']) : ''),
    'pubts' => (isset($APID['journal']['pubts']) && $APID['journal']['pubts'] > 0 ? (int) $APID['journal']['pubts'] : $DT->ts()),
    'delts' => (isset($APID['journal']['delts']) && $APID['journal']['delts'] > 0 ? (int) $APID['journal']['delts'] : '0'),
    'user' => (isset($APID['journal']['user']) && $APID['journal']['user'] ? $APID['journal']['user'] : ''),
    'pass' => (isset($APID['journal']['pass']) && $APID['journal']['pass'] ? mswEnc(SECRET_KEY . $APID['journal']['pass']) : ''),
    'en' => (isset($APID['journal']['en']) && in_array($APID['journal']['en'], array('yes','no')) ? $APID['journal']['en'] : 'yes'),
    'encomms' => (isset($APID['journal']['encomms']) && in_array($APID['journal']['encomms'], array('yes','no')) ? $APID['journal']['encomms'] : 'no'),
    'stick' => (isset($APID['journal']['stick']) && in_array($APID['journal']['stick'], array('yes','no')) ? $APID['journal']['stick'] : 'no'),
    'tweet' => (isset($APID['tweet']) ? $APID['tweet'] : ''),
    'categories' => (!empty($APID['categories']) ? $APID['categories'] : array())
  );
  // Error check..
  $err = array();
  foreach ($fm AS $k => $v) {
    switch($k) {
      case 'title':
      case 'comms':
        if ($v == '') {
          $err[] = '"' . $k . '" ' . $msw_api5;
        }
        break;
      case 'staff':
        if ($v > 0) {
          $Q  = $DB->db_query("SELECT `id` FROM `" . DB_PREFIX . "staff`
          WHERE `id` = '" . (int) $v . "'");
          $ST = $DB->db_object($Q);
          if (!isset($ST->id)) {
            $err[] = '"' . $k . '" ' . $msw_api8;
          }
        }
        break;
      case 'slug':
        if ($v == '') {
          $err[] = '"' . $k . '" ' . $msw_api5;
        } else {
          $Q  = $DB->db_query("SELECT `id` FROM `" . DB_PREFIX . "journals`
          WHERE `slug` = '" . mswSQL($v) . "'");
          $J = $DB->db_object($Q);
          if (isset($J->id)) {
            $err[] = '"' . $k . '" ' . $msw_api9;
          }
        }
        break;
      case 'categories':
        if (empty($v)) {
          $err[] = '"' . $k . '" ' . $msw_api7;
        } else {
          $Q  = $DB->db_query("SELECT `journal` FROM `" . DB_PREFIX . "cat_journal`
          WHERE `category` IN(" . mswSQL(implode(',', $v)) . ")
          LIMIT 1
          ");
          $J = $DB->db_object($Q);
          if (!isset($J->journal)) {
            $err[] = '"' . $k . '" ' . $msw_api7;
          }
        }
        break;
    }
  }
  if (!empty($err)) {
    $API->log(str_replace('{count}', count($err), $msw_api4) . mswNL() . implode(mswNL(), $err));
    echo $JSON->encode(array('status' => 'err'));
  } else {
    // Add blog..
    $ID = $API->add($fm);
    if ($ID > 0) {
      $API->log($msw_api10);
      // Send notifications..
      if (ENABLE_API_NOTIFICATIONS) {
        include(PATH . LANG_FLDR_ADM . '/control/access.php');
        if ($DB->db_rowcount('staff', 'WHERE `en` = \'yes\' AND `notify` = \'yes\'') > 0 || (defined('ADM_NOTIFICATIONS') && ADM_NOTIFICATIONS)) {
          include(LANG_FLDR . 'emails.php');
          $nStaff         = $API->notifications();
          $ntsent         = array();
          if (!empty($nStaff)) {
            $url = $MODR->url(array(
              $MODR->config['slugs']['jnl'] . '/' . $fm['slug'],
              'j=' . $ID
            ));
            $MAILR->addTag('{AUTHOR}', $msw_api16);
            $MAILR->addTag('{TITLE}', mswCD($fm['title']));
            $MAILR->addTag('{URL}', $url);
            $MAILR->addTag('{DATETIME}', ($fm['pubts'] > 0 && $fm['pubts'] > $DT->ts() ? date($SETTINGS->dateformat,$fm['pubts']) . ',' . date($SETTINGS->timeformat,$fm['pubts']) : $msw_api17));
            include(PATH . 'control/classes/mailer/global-mail-tags.php');
            $msg = mswTmp(MSW_EM_LANG . 'journal-api-notification.txt');
            $sbj = str_replace('{website}', $SETTINGS->website, $msw_emails3);
            for ($i=0; $i<count($nStaff); $i++) {
              $addEmails = '';
              if (defined('USERNAME') && $nStaff[$i]['name'] == USERNAME) {
                $addEmails = $SETTINGS->addemails;
              }
              $MAILR->addTag('{NAME}', $nStaff[$i]['name']);
              $MAILR->addTag('{USER}', $nStaff[$i]['user']);
              $MAILR->sendMail(array(
                'from_email' => ($SETTINGS->smtp_email ? $SETTINGS->smtp_email : $SETTINGS->email),
                'from_name' => ($SETTINGS->smtp_from ? $SETTINGS->smtp_from : $SETTINGS->website),
                'to_email' => $nStaff[$i]['email'],
                'to_name' => $nStaff[$i]['name'],
                'subject' => $sbj,
                'replyto' => array(
                  'name' => ($SETTINGS->smtp_rfrom ? $SETTINGS->smtp_rfrom : $SETTINGS->website),
                  'email' => ($SETTINGS->smtp_remail ? $SETTINGS->smtp_remail : $SETTINGS->email)
                ),
                'template' => $msg,
                'language' => $SETTINGS->language,
                'add-emails' => $addEmails,
                'alive' => 'yes'
              ));
              $ntsent[] = $nStaff[$i]['name'];
            }
            $MAILR->smtpClose();
          }
          if (!empty($ntsent)) {
            $API->log($msw_api11 . mswNL() . implode(mswNL(), $ntsent));
          }
        }
      } else {
        $API->log($msw_api13);
      }
      // Send tweet..
      if ($fm['tweet']) {
        include(PATH . 'control/api/twitter/codebird.php');
        $tweetapi = $SCL->params('twitter');
        if (isset($tweetapi['twitter']['conkey']) && $tweetapi['twitter']['conkey'] && $tweetapi['twitter']['consecret']) {
          $CB = new Codebird();
          $CB->setConsumerKey($tweetapi['twitter']['conkey'], $tweetapi['twitter']['consecret']);
          $cbi = $CB->getInstance();
          $cbi->setToken($tweetapi['twitter']['token'], $tweetapi['twitter']['key']);
          $params = array(
            'status' => $fm['tweet']
          );
          $pingreply  = (array) $cbi->statuses_update($params);
          if (isset($pingreply['httpstatus']) && $pingreply['httpstatus'] == '200') {
            $API->log($msw_api12);
          } else {
            $API->log($msw_api15);
          }
        }
      }
      // Clear cache..
      $CACHE->clear_cache_file(array(
        'nav-archive',
        'journal*',
        'calendar*',
        'category*'
      ));
      // Done..
      $API->log($msw_api3);
      echo $JSON->encode(array('status' => 'ok', 'id' => $ID));
    } else {
      $API->log($msw_api14);
      echo $JSON->encode(array('status' => 'err'));
    }
  }
} else {
  $API->log($msw_api2);
  echo $JSON->encode(array('status' => 'err'));
}

?>