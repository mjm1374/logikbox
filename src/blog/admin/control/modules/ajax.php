<?php

/* AJAX OPS
--------------------------------------------------------*/

if (!defined('PARENT') || !isset($_GET['ajax-ops'])) {
  exit;
}

$arr = array('status' => 'err', 'txt' => array($msw_ajax, $msw_ajax2));

switch($_GET['ajax-ops']) {

  // Categories..
  case 'cat':
  case 'cat-edit':
  case 'cat-del':
  case 'cat-sort':
    include(MSW_ADM_LANG . 'cat.php');
    include(PATH . 'control/classes/class.categories.php');
    $CATS           = new cat();
    $CATS->dt       = $DT;
    $CATS->settings = $SETTINGS;
    $CATS->cache    = $CACHE;
    switch($_GET['ajax-ops']) {
      case 'cat':
      case 'cat-edit':
        $fm = array(
          'title' => (isset($_POST['fm']['title']) ? $_POST['fm']['title'] : ''),
          'metat' => (isset($_POST['fm']['metat']) ? $_POST['fm']['metat'] : ''),
          'slug' => (isset($_POST['fm']['slug']) ? mswSlug($_POST['fm']['slug']) : ''),
          'en' => (isset($_POST['fm']['en']) && in_array($_POST['fm']['en'], array('yes','no')) ? $_POST['fm']['en'] : 'yes'),
          'user' => (isset($_POST['fm']['user']) ? $_POST['fm']['user'] : ''),
          'pass' => (isset($_POST['fm']['pass']) && $_POST['fm']['pass'] ? mswEnc(SECRET_KEY . $_POST['fm']['pass']) : ''),
          'curpass' => (isset($_POST['fm']['curpass']) ? $_POST['fm']['curpass'] : ''),
          'delts' => (isset($_POST['fm']['delts']) ? $_POST['fm']['delts'] : ''),
          'display' => (isset($_POST['fm']['display']) && in_array($_POST['fm']['display'], array('yes','no')) ? $_POST['fm']['display'] : 'no'),
          'id' => (isset($_POST['fm']['id']) ? (int) $_POST['fm']['id'] : '0')
        );
        if ($_GET['ajax-ops'] == 'cat') {
          if ($fm['title'] == '' || $fm['slug'] == '') {
            $arr['txt'][1] = $msw_adm_cat18;
          } else {
            if ($DB->db_rowcount('categories', 'WHERE `title` = \'' . mswSQL($fm['title']) . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_cat17;
            } elseif ($DB->db_rowcount('categories', 'WHERE `slug` = \'' . mswSQL($fm['slug']) . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_cat22;
            } else {
              if (LICENCE_VER == 'locked' && !defined('LIC_DEV') && ($DB->db_rowcount('categories') + 1) > RESTR_CATS) {
                $arr['txt'][1] = str_replace('{cats}', RESTR_CATS, $msw_adm_cat23);
              } else {
                $CATS->add($fm);
                $arr['status'] = 'ok';
                $arr['txt'][1] = $msw_adm_cat14;
              }
            }
          }
        } else {
          if ($fm['title'] == '' || $fm['slug'] == '') {
            $arr['txt'][1] = $msw_adm_cat18;
          } else {
            if ($DB->db_rowcount('categories', 'WHERE `title` = \'' . mswSQL($fm['title']) . '\' AND `id` != \'' . $fm['id'] . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_cat17;
            } elseif ($DB->db_rowcount('categories', 'WHERE `slug` = \'' . mswSQL($fm['slug']) . '\' AND `id` != \'' . $fm['id'] . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_cat22;
            } else {
              $CATS->update($fm);
              $arr['status'] = 'ok';
              $arr['txt'][1] = $msw_adm_cat15;
            }
          }
        }
        break;
      case 'cat-del':
        $fm = array(
          'ids' => (!empty($_POST['fm']['id']) ? $_POST['fm']['id'] : array())
        );
        if (!empty($fm['ids'])) {
          $CATS->delete($fm);
          $arr['status'] = 'ok';
          $arr['tr-ds'] = $fm['ids'];
          $arr['txt'][1] = $msw_adm_cat16;
        } else {
          $arr['txt'][1] = $msw_common8;
        }
        break;
      case 'cat-sort':
        $fm = array(
          'sort' => (!empty($_POST['fm']['sort']) ? $_POST['fm']['sort'] : array())
        );
        if (!empty($fm['sort'])) {
          $CATS->order($fm);
          $arr['status'] = 'ok';
        }
        break;
    }
    break;

  // Journals..
  case 'add':
  case 'add-edit':
  case 'manage-del':
  case 'archived':
    include(MSW_ADM_LANG . 'add.php');
    include(MSW_ADM_LANG . 'manage.php');
    include(PATH . 'control/classes/class.journals.php');
    $JNLS           = new journal();
    $JNLS->dt       = $DT;
    $JNLS->settings = $SETTINGS;
    $JNLS->cache    = $CACHE;
    switch($_GET['ajax-ops']) {
      case 'add':
      case 'add-edit':
        $fm = array(
          'staff' => (isset($mswUser[2]['id']) ? $mswUser[2]['id'] : '0'),
          'title' => (isset($_POST['fm']['title']) ? $_POST['fm']['title'] : ''),
          'comms' => (isset($_POST['fm']['comms']) ? $_POST['fm']['comms'] : ''),
          'cats' => (!empty($_POST['fm']['cats']) ? $_POST['fm']['cats'] : array()),
          'metat' => (isset($_POST['fm']['metat']) ? $_POST['fm']['metat'] : ''),
          'tags' => (isset($_POST['fm']['tags']) ? $_POST['fm']['tags'] : ''),
          'slug' => (isset($_POST['fm']['slug']) ? mswSlug($_POST['fm']['slug']) : ''),
          'pubts' => (isset($_POST['fm']['pubts']) ? $_POST['fm']['pubts'] : ''),
          'delts' => (isset($_POST['fm']['delts']) ? $_POST['fm']['delts'] : ''),
          'user' => (isset($_POST['fm']['user']) ? $_POST['fm']['user'] : ''),
          'pass' => (isset($_POST['fm']['pass']) && $_POST['fm']['pass'] ? mswEnc(SECRET_KEY . $_POST['fm']['pass']) : ''),
          'curpass' => (isset($_POST['fm']['curpass']) ? $_POST['fm']['curpass'] : ''),
          'en' => (isset($_POST['fm']['en']) && in_array($_POST['fm']['en'], array('yes','no')) ? $_POST['fm']['en'] : 'yes'),
          'encomms' => (isset($_POST['fm']['encomms']) && in_array($_POST['fm']['encomms'], array('yes','no')) ? $_POST['fm']['encomms'] : 'no'),
          'stick' => (isset($_POST['fm']['stick']) && in_array($_POST['fm']['stick'], array('yes','no')) ? $_POST['fm']['stick'] : 'no'),
          'tweet' => (isset($_POST['fm']['tweet']) ? $_POST['fm']['tweet'] : ''),
          'id' => (isset($_POST['fm']['id']) ? (int) $_POST['fm']['id'] : '0')
        );
        if ($_GET['ajax-ops'] == 'add') {
          if ($fm['title'] == '' || $fm['comms'] == '' || $fm['slug'] == '' || empty($fm['cats'])) {
            $arr['txt'][1] = $msg_adm_add26;
          } else {
            if ($DB->db_rowcount('journals', 'WHERE `title` = \'' . mswSQL($fm['title']) . '\'') > 0) {
              $arr['txt'][1] = $msg_adm_add24;
            } elseif ($DB->db_rowcount('journals', 'WHERE `slug` = \'' . mswSQL($fm['slug']) . '\'') > 0) {
              $arr['txt'][1] = $msg_adm_add31;
            } else {
              $ID = $JNLS->add($fm);
              // Send notification emails..
              if ($DB->db_rowcount('staff', 'WHERE `en` = \'yes\'') > 0 && isset($mswUser[2]['id'])) {
                include(MSW_LANG . 'emails.php');
                include(PATH . 'control/classes/class.staff.php');
                $STFF           = new staff();
                $STFF->dt       = $DT;
                $STFF->settings = $SETTINGS;
                $nStaff         = $STFF->notifications($mswUser[2]['id'], $mswUser[1]);
                $ntsent         = array();
                if (!empty($nStaff)) {
                  $url = $MODR->url(array(
                    $MODR->config['slugs']['jnl'] . '/' . $fm['slug'],
                    'j=' . $ID
                  ));
                  $MAILR->addTag('{AUTHOR}', ($mswUser[1] == 'global' && defined('USERNAME') ? USERNAME : $mswUser[2]['name']));
                  $MAILR->addTag('{TITLE}', mswCD($fm['title']));
                  $MAILR->addTag('{URL}', '');
                  $MAILR->addTag('{DATETIME}', ($fm['pubts'] && $DT->jstots($fm['pubts'], true) > $DT->ts() ? $fm['pubts'] : $msg_adm_add27));
                  include(GLOBAL_PATH . 'control/classes/mailer/global-mail-tags.php');
                  $msg = mswTmp(MSW_EM_LANG . LANG_FLDR_ADM . '/journal-notification.txt');
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
              }
              // Post tweet..
              if (mswOptPerms('tweet', $mswUser) == 'yes' && $fm['tweet']) {
                include(GLOBAL_PATH . 'control/api/twitter/codebird.php');
                $SOC = new social();
                $tweetapi = $SOC->params('twitter');
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
                    $addntl = $msg_adm_add28;
                  } else {
                    $addntl = $msg_adm_add29;
                  }
                }
              }
              $arr['status'] = 'ok';
              $arr['txt'][1] = $msg_adm_add22 . (!empty($ntsent) ? str_replace('{staff}',implode(', ', $ntsent),$msg_adm_add30) : '') . (isset($addntl) ? $addntl : '');
            }
          }
        } else {
          if ($fm['title'] == '' || $fm['comms'] == '' || $fm['slug'] == '' || empty($fm['cats'])) {
            $arr['txt'][1] = $msg_adm_add26;
          } else {
            if ($DB->db_rowcount('journals', 'WHERE `title` = \'' . mswSQL($fm['title']) . '\' AND `id` != \'' . $fm['id'] . '\'') > 0) {
              $arr['txt'][1] = $msg_adm_add24;
            } elseif ($DB->db_rowcount('journals', 'WHERE `slug` = \'' . mswSQL($fm['slug']) . '\' AND `id` != \'' . $fm['id'] . '\'') > 0) {
              $arr['txt'][1] = $msg_adm_add31;
            } else {
              $JNLS->update($fm);
              $arr['status'] = 'ok';
              $arr['txt'][1] = $msg_adm_add23;
            }
          }
        }
        break;
      case 'manage-del':
        $fm = array(
          'ids' => (!empty($_POST['fm']['id']) ? $_POST['fm']['id'] : array())
        );
        if (!empty($fm['ids'])) {
          $JNLS->delete($fm);
          $arr['status'] = 'ok';
          $arr['tr-ds'] = $fm['ids'];
          $arr['txt'][1] = $msw_adm_manage17;
        } else {
          $arr['txt'][1] = $msw_common8;
        }
        break;
      case 'archived':
        $JNLS->archived($fm);
        $arr['status'] = 'ok';
        break;
    }
    break;

  // Staff..
  case 'staff':
  case 'staff-edit':
  case 'staff-del':
    include(MSW_ADM_LANG . 'staff.php');
    include(PATH . 'control/classes/class.staff.php');
    $STFF           = new staff();
    $STFF->dt       = $DT;
    $STFF->settings = $SETTINGS;
    $STFF->cache    = $CACHE;
    switch($_GET['ajax-ops']) {
      case 'staff':
      case 'staff-edit':
        $fm = array(
          'name' => (isset($_POST['fm']['name']) ? $_POST['fm']['name'] : ''),
          'email' => (isset($_POST['fm']['email']) ? $_POST['fm']['email'] : ''),
          'en' => (isset($_POST['fm']['en']) && in_array($_POST['fm']['en'], array('yes','no')) ? $_POST['fm']['en'] : 'yes'),
          'user' => (isset($_POST['fm']['user']) ? $_POST['fm']['user'] : ''),
          'pass' => (isset($_POST['fm']['pass']) && $_POST['fm']['pass'] ? mswEnc(SECRET_KEY . $_POST['fm']['pass']) : ''),
          'curpass' => (isset($_POST['fm']['curpass']) ? $_POST['fm']['curpass'] : ''),
          'type' => (isset($_POST['fm']['type']) && in_array($_POST['fm']['type'], array('admin','restricted')) ? $_POST['fm']['type'] : 'admin'),
          'perms' => (!empty($_POST['fm']['perms']) ? implode(PERMS_DELIMITER, $_POST['fm']['perms']) : ''),
          'jrest' => (isset($_POST['fm']['jrest']) && in_array($_POST['fm']['jrest'], array('yes','no')) ? $_POST['fm']['jrest'] : 'no'),
          'tweet' => (isset($_POST['fm']['tweet']) && in_array($_POST['fm']['tweet'], array('yes','no')) ? $_POST['fm']['tweet'] : 'no'),
          'delp' => (isset($_POST['fm']['delp']) && in_array($_POST['fm']['delp'], array('yes','no')) ? $_POST['fm']['delp'] : 'no'),
          'notify' => (isset($_POST['fm']['notify']) && in_array($_POST['fm']['notify'], array('yes','no')) ? $_POST['fm']['notify'] : 'no'),
          'notes' => (isset($_POST['fm']['notes']) ? $_POST['fm']['notes'] : ''),
          'id' => (isset($_POST['fm']['id']) ? (int) $_POST['fm']['id'] : '0')
        );
        if ($_GET['ajax-ops'] == 'staff') {
          if ($fm['name'] == '' || mswEmVal($fm['email']) == 'no' || $fm['user'] == '' || $fm['pass'] == '') {
            $arr['txt'][1] = $msw_adm_staff27;
          } else {
            if ($DB->db_rowcount('staff', 'WHERE `email` = \'' . mswSQL($fm['email']) . '\' OR `user` = \'' . mswSQL($fm['user']) . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_staff25;
            } else {
              if (LICENCE_VER == 'locked' && !defined('LIC_DEV') && ($DB->db_rowcount('staff') + 1) > RESTR_STAFF) {
                $arr['txt'][1] = str_replace('{staff}', RESTR_STAFF, $msw_adm_staff29);
              } else {
                $STFF->add($fm);
                $arr['status'] = 'ok';
                $arr['txt'][1] = $msw_adm_staff22;
              }
            }
          }
        } else {
          if ($fm['name'] == '' || mswEmVal($fm['email']) == 'no' || $fm['user'] == '') {
            $arr['txt'][1] = $msw_adm_staff28;
          } else {
            if ($DB->db_rowcount('staff', 'WHERE (`email` = \'' . mswSQL($fm['email']) . '\' OR `user` = \'' . mswSQL($fm['user']) . '\') AND `id` != \'' . $fm['id'] . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_staff25;
            } else {
              $STFF->update($fm);
              $arr['status'] = 'ok';
              $arr['txt'][1] = $msw_adm_staff23;
            }
          }
        }
        break;
      case 'staff-del':
        $fm = array(
          'ids' => (!empty($_POST['fm']['id']) ? $_POST['fm']['id'] : array())
        );
        if (!empty($fm['ids'])) {
          $STFF->delete($fm);
          $arr['status'] = 'ok';
          $arr['tr-ds'] = $fm['ids'];
          $arr['txt'][1] = $msw_adm_staff24;
        } else {
          $arr['txt'][1] = $msw_common8;
        }
        break;
    }
    break;

  // Pages..
  case 'pages':
  case 'pages-edit':
  case 'pages-del':
  case 'pages-sort':
    include(MSW_ADM_LANG . 'pages.php');
    include(PATH . 'control/classes/class.pages.php');
    $PAGS           = new page();
    $PAGS->dt       = $DT;
    $PAGS->settings = $SETTINGS;
    $PAGS->cache    = $CACHE;
    switch($_GET['ajax-ops']) {
      case 'pages':
      case 'pages-edit':
        $fm = array(
          'name' => (isset($_POST['fm']['name']) ? $_POST['fm']['name'] : ''),
          'info' => (isset($_POST['fm']['info']) ? $_POST['fm']['info'] : ''),
          'metat' => (isset($_POST['fm']['metat']) ? $_POST['fm']['metat'] : ''),
          'slug' => (isset($_POST['fm']['slug']) ? mswSlug($_POST['fm']['slug']) : ''),
          'tmp' => (isset($_POST['fm']['tmp']) ? $_POST['fm']['tmp'] : ''),
          'en' => (isset($_POST['fm']['en']) && in_array($_POST['fm']['en'], array('yes','no')) ? $_POST['fm']['en'] : 'yes'),
          'landing' => (isset($_POST['fm']['landing']) && in_array($_POST['fm']['landing'], array('yes','no')) ? $_POST['fm']['landing'] : 'no'),
          'id' => (isset($_POST['fm']['id']) ? (int) $_POST['fm']['id'] : '0')
        );
        if ($fm['name'] == '' || $fm['slug'] == '' || ($fm['info'] == '' && $fm['tmp'] == '')) {
          $arr['txt'][1] = $msw_adm_pages18;
        } else {
          if ($_GET['ajax-ops'] == 'pages') {
            if ($DB->db_rowcount('pages', 'WHERE `name` = \'' . mswSQL($fm['name']) . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_pages17;
            } elseif ($DB->db_rowcount('pages', 'WHERE `slug` = \'' . mswSQL($fm['slug']) . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_pages19;
            } else {
              if (LICENCE_VER == 'locked' && !defined('LIC_DEV') && ($DB->db_rowcount('pages') + 1) > RESTR_PAGES) {
                $arr['txt'][1] = str_replace('{pages}', RESTR_PAGES, $msw_adm_pages20);
              } else {
                $PAGS->add($fm);
                $arr['status'] = 'ok';
                $arr['txt'][1] = $msw_adm_pages14;
              }
            }
          } else {
            if ($DB->db_rowcount('pages', 'WHERE `name` = \'' . mswSQL($fm['name']) . '\' AND `id` != \'' . $fm['id'] . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_pages17;
            } elseif ($DB->db_rowcount('pages', 'WHERE `slug` = \'' . mswSQL($fm['slug']) . '\' AND `id` != \'' . $fm['id'] . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_pages19;
            } else {
              $PAGS->update($fm);
              $arr['status'] = 'ok';
              $arr['txt'][1] = $msw_adm_pages15;
            }
          }
        }
        break;
      case 'pages-del':
        $fm = array(
          'ids' => (!empty($_POST['fm']['id']) ? $_POST['fm']['id'] : array())
        );
        if (!empty($fm['ids'])) {
          $PAGS->delete($fm);
          $arr['status'] = 'ok';
          $arr['tr-ds'] = $fm['ids'];
          $arr['txt'][1] = $msw_adm_pages16;
        } else {
          $arr['txt'][1] = $msw_common8;
        }
        break;
      case 'pages-sort':
        $fm = array(
          'sort' => (!empty($_POST['fm']['sort']) ? $_POST['fm']['sort'] : array())
        );
        if (!empty($fm['sort'])) {
          $PAGS->order($fm);
          $arr['status'] = 'ok';
        }
        break;
    }
    break;

  // Boxes..
  case 'boxes':
  case 'boxes-edit':
  case 'boxes-del':
  case 'boxes-sort':
    include(MSW_ADM_LANG . 'boxes.php');
    include(PATH . 'control/classes/class.boxes.php');
    $BOX           = new box();
    $BOX->dt       = $DT;
    $BOX->settings = $SETTINGS;
    $BOX->cache    = $CACHE;
    switch($_GET['ajax-ops']) {
      case 'boxes':
      case 'boxes-edit':
        $fm = array(
          'title' => (isset($_POST['fm']['title']) ? $_POST['fm']['title'] : ''),
          'info' => (isset($_POST['fm']['info']) ? $_POST['fm']['info'] : ''),
          'tmp' => (isset($_POST['fm']['tmp']) ? $_POST['fm']['tmp'] : ''),
          'icon' => (isset($_POST['fm']['icon']) ? $_POST['fm']['icon'] : 'th'),
          'en' => (isset($_POST['fm']['en']) && in_array($_POST['fm']['en'], array('yes','no')) ? $_POST['fm']['en'] : 'yes'),
          'id' => (isset($_POST['fm']['id']) ? (int) $_POST['fm']['id'] : '0')
        );
        if ($fm['title'] == '' || ($fm['info'] == '' && $fm['tmp'] == '')) {
          $arr['txt'][1] = $msw_adm_boxes14;
        } else {
          if ($_GET['ajax-ops'] == 'boxes') {
            if ($DB->db_rowcount('boxes', 'WHERE `title` = \'' . mswSQL($fm['title']) . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_boxes13;
            } else {
              if (LICENCE_VER == 'locked' && !defined('LIC_DEV') && ($DB->db_rowcount('boxes') + 1) > RESTR_BOXES) {
                $arr['txt'][1] = str_replace('{boxes}', RESTR_BOXES, $msw_adm_boxes16);
              } else {
                $BOX->add($fm);
                $arr['status'] = 'ok';
                $arr['txt'][1] = $msw_adm_boxes10;
              }
            }
          } else {
            if ($DB->db_rowcount('boxes', 'WHERE `title` = \'' . mswSQL($fm['title']) . '\' AND `id` != \'' . $fm['id'] . '\'') > 0) {
              $arr['txt'][1] = $msw_adm_boxes13;
            } else {
              $BOX->update($fm);
              $arr['status'] = 'ok';
              $arr['txt'][1] = $msw_adm_boxes11;
            }
          }
        }
        break;
      case 'boxes-del':
        $fm = array(
          'ids' => (!empty($_POST['fm']['id']) ? $_POST['fm']['id'] : array())
        );
        if (!empty($fm['ids'])) {
          $BOX->delete($fm);
          $arr['status'] = 'ok';
          $arr['tr-ds'] = $fm['ids'];
          $arr['txt'][1] = $msw_adm_boxes12;
        } else {
          $arr['txt'][1] = $msw_common8;
        }
        break;
      case 'boxes-sort':
        $fm = array(
          'sort' => (!empty($_POST['fm']['sort']) ? $_POST['fm']['sort'] : array())
        );
        if (!empty($fm['sort'])) {
          $BOX->order($fm);
          $arr['status'] = 'ok';
        }
        break;
    }
    break;

  // Themes..
  case 'themes':
    include(MSW_ADM_LANG . 'themes.php');
    $fm = array(
      'theme' => (isset($_POST['fm']['theme']) ? $_POST['fm']['theme'] : '_theme_default'),
      'entheme' => (isset($_POST['fm']['entheme']) && in_array($_POST['fm']['entheme'], array('yes','no')) ? $_POST['fm']['entheme'] : 'no'),
      'thm' => (!empty($_POST['fm']['thm']) ? $_POST['fm']['thm'] : array()),
      'from' => (!empty($_POST['fm']['from']) ? $_POST['fm']['from'] : array()),
      'to' => (!empty($_POST['fm']['to']) ? $_POST['fm']['to'] : array())
    );
    $SYS->themes($fm);
    $arr['status'] = 'ok';
    $arr['txt'][1] = $msw_adm_themes7;
    break;

  // Settings..
  case 'settings':
    include(MSW_ADM_LANG . 'settings.php');
    $fm = array(
      'website' => (isset($_POST['fm']['website']) ? $_POST['fm']['website'] : ''),
      'email' => (isset($_POST['fm']['email']) ? $_POST['fm']['email'] : ''),
      'ifolder' => (isset($_POST['fm']['ifolder']) ? $_POST['fm']['ifolder'] : ''),
      'language' => (isset($_POST['fm']['language']) ? $_POST['fm']['language'] : 'english'),
      'dateformat' => (isset($_POST['fm']['dateformat']) ? $_POST['fm']['dateformat'] : 'j M Y'),
      'timeformat' => (isset($_POST['fm']['timeformat']) ? $_POST['fm']['timeformat'] : 'H:iA'),
      'timezone' => (isset($_POST['fm']['timezone']) && in_array($_POST['fm']['timezone'], array_keys($timezones)) ? $_POST['fm']['timezone'] : 'Europe/London'),
      'calformat' => (isset($_POST['fm']['calformat']) && in_array($_POST['fm']['calformat'], $jsCalFormat) ? $_POST['fm']['calformat'] : 'DD/MM/YYYY'),
      'weekstart' => (isset($_POST['fm']['weekstart']) && in_array($_POST['fm']['weekstart'], array('sun','mon')) ? $_POST['fm']['weekstart'] : 'sun'),
      'metad' => (isset($_POST['fm']['metad']) ? $_POST['fm']['metad'] : ''),
      'metak' => (isset($_POST['fm']['metak']) ? $_POST['fm']['metak'] : ''),
      'modr' => (isset($_POST['fm']['modr']) && in_array($_POST['fm']['modr'], array('yes','no')) ? $_POST['fm']['modr'] : 'no'),
      'cats' => (!empty($_POST['fm']['cats']) ? implode(',', $_POST['fm']['cats']) : ''),
      'apikey' => (isset($_POST['fm']['apikey']) ? $_POST['fm']['apikey'] : ''),
      'apilog' => (isset($_POST['fm']['apilog']) && in_array($_POST['fm']['apilog'], array('yes','no')) ? $_POST['fm']['apilog'] : 'no'),
      'cache' => (isset($_POST['fm']['cache']) && in_array($_POST['fm']['cache'], array('yes','no')) ? $_POST['fm']['cache'] : 'no'),
      'cachetime' => (isset($_POST['fm']['cachetime']) ? (int) $_POST['fm']['cachetime'] : '30'),
      'pfoot' => (LICENCE_VER == 'unlocked' && isset($_POST['fm']['pfoot']) ? $_POST['fm']['pfoot'] : ''),
      'afoot' => (LICENCE_VER == 'unlocked' && isset($_POST['fm']['afoot']) ? $_POST['fm']['afoot'] : '')
    );
    if ($fm['website'] == '' || mswEmVal($fm['email']) == 'no' || $fm['ifolder'] == '') {
      $arr['txt'][1] = $msw_adm_settings29;
    } else {
      $SYS->config($fm);
      $arr['status'] = 'ok';
      $arr['txt'][1] = $msw_adm_settings28;
    }
    break;

  // Email settings..
  case 'email':
  case 'mail':
    include(MSW_ADM_LANG . 'email.php');
    switch($_GET['ajax-ops']) {
      case 'email':
        $fm = array(
          'smtp_host' => (isset($_POST['fm']['smtp_host']) ? $_POST['fm']['smtp_host'] : ''),
          'smtp_port' => (isset($_POST['fm']['smtp_port']) ? (int) $_POST['fm']['smtp_port'] : '0'),
          'smtp_user' => (isset($_POST['fm']['smtp_user']) ? $_POST['fm']['smtp_user'] : ''),
          'smtp_pass' => (isset($_POST['fm']['smtp_pass']) ? $_POST['fm']['smtp_pass'] : ''),
          'smtp_from' => (isset($_POST['fm']['smtp_from']) ? $_POST['fm']['smtp_from'] : ''),
          'smtp_email' => (isset($_POST['fm']['smtp_email']) && mswEmVal($_POST['fm']['smtp_email']) == 'yes' ? $_POST['fm']['smtp_email'] : ''),
          'smtp_rfrom' => (isset($_POST['fm']['smtp_rfrom']) ? $_POST['fm']['smtp_rfrom'] : ''),
          'smtp_remail' => (isset($_POST['fm']['smtp_remail']) && mswEmVal($_POST['fm']['smtp_remail']) == 'yes' ? $_POST['fm']['smtp_remail'] : ''),
          'smtp_security' => (isset($_POST['fm']['smtp_security']) && in_array($_POST['fm']['smtp_security'], array('','tls','ssl')) ? $_POST['fm']['smtp_security'] : ''),
          'addemails' => (isset($_POST['fm']['addemails']) ? str_replace(' ', '', $_POST['fm']['addemails']) : ''),
          'smtp_debug' => (isset($_POST['fm']['smtp_debug']) && in_array($_POST['fm']['smtp_debug'], array('yes','no')) ? $_POST['fm']['smtp_debug'] : 'no')
        );
        if ($fm['smtp_host'] == '' || $fm['smtp_port'] == '0') {
          $arr['txt'][1] = $msw_adm_email17;
        } else {
          $SYS->email($fm);
          $arr['status'] = 'ok';
          $arr['txt'][1] = $msw_adm_email16;
        }
        break;
      case 'mail':
        if ($SETTINGS->smtp_host && $SETTINGS->smtp_port) {
          $em = array($SETTINGS->email);
          if ($SETTINGS->addemails) {
            $ot = array_map('trim', explode(',', $SETTINGS->addemails));
            $em = array_merge($em, $ot);
          }
          $ot  = array();
          if (count($em) > 1) {
            $ot = $em;
            unset($ot[0]);
          }
          include(GLOBAL_PATH . 'control/classes/mailer/global-mail-tags.php');
          $msg = mswTmp(MSW_EM_LANG . LANG_FLDR_ADM . '/mail-test.txt');
          $sbj = str_replace('{website}', $SETTINGS->website, $msw_emails);
          $MAILR->sendMail(array(
            'from_email' => ($SETTINGS->smtp_email ? $SETTINGS->smtp_email : $SETTINGS->email),
            'from_name' => ($SETTINGS->smtp_from ? $SETTINGS->smtp_from : $SETTINGS->website),
            'to_email' => $em[0],
            'to_name' => $SETTINGS->website,
            'subject' => $sbj,
            'replyto' => array(
              'name' => ($SETTINGS->smtp_rfrom ? $SETTINGS->smtp_rfrom : $SETTINGS->website),
              'email' => ($SETTINGS->smtp_remail ? $SETTINGS->smtp_remail : $SETTINGS->email)
            ),
            'template' => $msg,
            'add-emails' => (!empty($ot) ? implode(',',$ot) : ''),
            'language' => $SETTINGS->language
          ));
          $MAILR->smtpClose();
          $arr['status'] = 'ok';
          $arr['txt'][1] = str_replace('{emails}',implode('<br>', $em),$msw_ajax3);
        } else {
          $arr['txt'][1] = $msw_adm_email17;
        }
        break;
    }
    break;

  // Social settings..
  case 'social':
    include(MSW_ADM_LANG . 'social.php');
    $SYS->social();
    $arr['status'] = 'ok';
    $arr['txt'][1] = $msw_adm_social16;
    break;

  // Offline settings..
  case 'offline':
    include(MSW_ADM_LANG . 'offline.php');
    $fm = array(
      'sysstatus' => (isset($_POST['fm']['sysstatus']) && in_array($_POST['fm']['sysstatus'], array('yes','no')) ? $_POST['fm']['sysstatus'] : 'yes'),
      'reason' => (isset($_POST['fm']['reason']) ? $_POST['fm']['reason'] : ''),
      'autoenable' => (isset($_POST['fm']['autoenable']) ? $_POST['fm']['autoenable'] : '')
    );
    $SYS->offline($fm);
    $arr['status'] = 'ok';
    $arr['txt'][1] = $msw_adm_offline6;
    break;

  // Export..
  case 'export':
  case 'export-dl':
    include(MSW_ADM_LANG . 'export.php');
    include(PATH . 'control/classes/class.tools.php');
    $TLS           = new tools();
    $TLS->dt       = $DT;
    $TLS->settings = $SETTINGS;
    if ($_GET['ajax-ops'] == 'export-dl') {
      $_POST['fm']['import'] = 'export-dl';
    }
    if (isset($_POST['fm']['import']) && in_array($_POST['fm']['import'], array('staff','journals','export-dl'))) {
      switch($_POST['fm']['import']) {
        case 'staff':
          $fm = array(
            'name' => (isset($_POST['fm']['name']) ? 'yes' : 'no'),
            'email' => (isset($_POST['fm']['email']) ? 'yes' : 'no'),
            'user' => (isset($_POST['fm']['user']) ? 'yes' : 'no'),
            'type' => $_POST['fm']['import']
          );
          if ($fm['name'] == 'no' && $fm['email'] == 'no' && $fm['user'] == 'no') {
            $arr['txt'][1] = $msw_adm_export10;
          } else {
            $f = $TLS->export($fm);
            $arr['status'] = 'rdr';
            $arr['loc'] = 'index.php?ajax-ops=export-dl&f=' . basename($f);
          }
          break;
        case 'journals':
          $fm = array(
            'from' => (isset($_POST['fm']['from']) ? $_POST['fm']['from'] : ''),
            'to' => (isset($_POST['fm']['to']) ? $_POST['fm']['to'] : ''),
            'cats' => (!empty($_POST['fm']['cats']) ? $_POST['fm']['cats'] : array()),
            'type' => $_POST['fm']['import'],
            'lang' => array($msw_adm_export12, $msw_adm_export13)
          );
          if (($fm['from'] == '' && $fm['to'] == '') && empty($fm['cats'])) {
            $arr['txt'][1] = $msw_adm_export11;
          } else {
            $f = $TLS->export($fm);
            $arr['status'] = 'rdr';
            $arr['loc'] = 'index.php?ajax-ops=export-dl&f=' . basename($f);
          }
          break;
        case 'export-dl':
          $_GET['f'] = (isset($_GET['f']) ? preg_replace('/[^0-9a-zA-Z.\-\s]/', '', $_GET['f']) : '');
          if ($_GET['f'] && @file_exists(PATH . 'backup/' . $_GET['f'])) {
            include(REL_PATH . 'control/classes/class.download.php');
            $DL = new download();
            $DL->dl(
              PATH . 'backup/' . $_GET['f'],
              'text/csv',
              'yes'
            );
          }
          break;
      }
    }
    break;

  // Database backup..
  case 'backup':
  case 'backup-dl':
    include(MSW_ADM_LANG . 'backup.php');
    include(MSW_LANG . 'emails.php');
    include(REL_PATH . 'control/classes/class.db-backup.php');
    switch($_GET['ajax-ops']) {
      case 'backup':
        mswTO();
        $fm = array(
          'time' => date('H:i:s'),
          'download' => (isset($_POST['fm']['download']) && in_array($_POST['fm']['download'], array('yes','no')) ? $_POST['fm']['download'] : 'yes'),
          'compress' => (isset($_POST['fm']['compress']) && in_array($_POST['fm']['compress'], array('yes','no')) ? $_POST['fm']['compress'] : 'no'),
          'emails' => (isset($_POST['fm']['emails']) ? $_POST['fm']['emails'] : '')
        );
        // File path..
        if ($fm['compress'] == 'yes') {
          $fpath = PATH . 'backup/db-backup-' . $DT->ts() . '.gz';
        } else {
          $fpath = PATH . 'backup/db-backup-' . $DT->ts() . '.sql';
        }
        $DBB = new backup(array(
          'file' => $fpath,
          'cmp' => $fm['compress'],
          'db' => $DB
        ));
        $DBB->settings = $SETTINGS;
        $DBB->db       = $DB;
        $DBB->doDump();
        // Copy email addresses if set..
        if ($fm['emails'] && file_exists($fpath)) {
          $em  = array_map('trim', explode(',', $fm['emails']));
          $ot  = array();
          if (count($em) > 1) {
            $ot = $em;
            unset($ot[0]);
          }
          include(GLOBAL_PATH . 'control/classes/mailer/global-mail-tags.php');
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
            'to_email' => $em[0],
            'to_name' => $SETTINGS->website,
            'subject' => $sbj,
            'replyto' => array(
              'name' => ($SETTINGS->smtp_rfrom ? $SETTINGS->smtp_rfrom : $SETTINGS->website),
              'email' => ($SETTINGS->smtp_remail ? $SETTINGS->smtp_remail : $SETTINGS->email)
            ),
            'template' => $msg,
            'add-emails' => (!empty($ot) ? implode(',',$ot) : ''),
            'language' => $SETTINGS->language
          ));
          $MAILR->smtpClose();
        }
        if ($fm['download'] == 'yes') {
          $arr['status'] = 'rdr';
          $arr['loc'] = 'index.php?ajax-ops=backup-dl&f=' . basename($fpath) . '&cp=' . $fm['compress'];
        } else {
          if ($fm['emails']) {
            if (file_exists($fpath)) {
              @unlink($fpath);
            }
            $arr['status'] = 'ok';
            $arr['txt'][1] = str_replace('{emails}',implode('<br>', $em),$msw_adm_backup14);
          } else {
            $arr['status'] = 'ok';
            $arr['txt'][1] = str_replace('{file}', basename($fpath),$msw_adm_backup15);
          }
        }
        break;
      case 'backup-dl':
        $_GET['f'] = (isset($_GET['f']) ? preg_replace('/[^0-9a-zA-Z.\-\s]/', '', $_GET['f']) : '');
        if ($_GET['f'] && @file_exists(PATH . 'backup/' . $_GET['f'])) {
          include(REL_PATH . 'control/classes/class.download.php');
          $DL = new download();
          $DL->dl(
            PATH . 'backup/' . $_GET['f'],
            (isset($_GET['cp']) && $_GET['cp'] == 'yes' ? 'application/x-compressed' : 'text/plain'),
            'yes'
          );
        }
        break;
    }
    break;

  // Error log..
  case 'elog-del':
  case 'elog-clear':
  case 'elog-exp':
  case 'elog-exp-dl':
    include(MSW_ADM_LANG . 'elog.php');
    include(PATH . 'control/classes/class.tools.php');
    $TLS           = new tools();
    $TLS->dt       = $DT;
    $TLS->settings = $SETTINGS;
    switch($_GET['ajax-ops']) {
      case 'elog-del':
        $fm = array(
          'ids' => (!empty($_POST['fm']['id']) ? $_POST['fm']['id'] : array())
        );
        if (!empty($fm['ids'])) {
          $TLS->elog($fm);
          if ($DB->db_rowcount('elog') > 0) {
            $arr['tr-ds'] = $fm['ids'];
            $arr['status'] = 'ok';
            $arr['txt'][1] = $msw_adm_elog8;
          } else {
            $arr['status'] = 'rdr';
            $arr['loc'] = 'index.php?p=elog';
          }
        }
        break;
      case 'elog-clear':
        $TLS->elog(array(), 'all');
        $arr['status'] = 'rdr';
        $arr['loc'] = 'index.php?p=elog';
        break;
      case 'elog-exp':
        $f = $TLS->exelog($msw_adm_elog6);
        $arr['status'] = 'rdr';
        $arr['loc'] = 'index.php?ajax-ops=elog-exp-dl&f=' . basename($f);
        break;
      case 'elog-exp-dl':
        $_GET['f'] = (isset($_GET['f']) ? preg_replace('/[^0-9a-zA-Z.\-\s]/', '', $_GET['f']) : '');
        if ($_GET['f'] && @file_exists(PATH . 'backup/' . $_GET['f'])) {
          include(REL_PATH . 'control/classes/class.download.php');
          $DL = new download();
          $DL->dl(
            PATH . 'backup/' . $_GET['f'],
            'text/csv',
            'yes'
          );
        }
        break;
    }
    break;

  // Logout..
  case 'logout':
    $arr['rdr'] = 'index.php?p=login';
    $SSN->delete(array('adm_staff_id','adm_type','adm_staff','adm_user','adm_global'));
    if (isset($_COOKIE[mswEnc(SECRET_KEY . DB_NAME)])) {
      $_COOKIE[mswEnc(SECRET_KEY . DB_NAME)] = '';
      unset($_COOKIE[mswEnc(SECRET_KEY . DB_NAME)]);
      @setcookie(mswEnc(SECRET_KEY . DB_NAME), '');
    }
    break;

  // Login..
  case 'login':
    if (isset($_POST['usr'], $_POST['pw'])) {
      include(MSW_ADM_LANG . 'login.php');
      $arr['txt'][1] = $msw_adm_login5;
      if ($_POST['usr'] && $_POST['pw']) {
        if (defined('RESTRICT_BY_IP') && RESTRICT_BY_IP) {
          $allowed = array_map('trim', explode(',', RESTRICT_BY_IP));
          $current = mswIP(true);
          if (isset($current[0]) && !in_array($current[0], $allowed)) {
            $ipBlock = true;
            $arr['txt'][1] = $msw_adm_login6;
          }
        }
        if (!isset($ipBlock)) {
          // Check global login first..
          if (file_exists(PATH . 'control/access.php') && !in_array(PATH . 'control/access.php', get_included_files())) {
            include_once(PATH . 'control/access.php');
          }
          if (defined('USERNAME') && defined('PASSWORD') && $_POST['usr'] == USERNAME && mswEnc(SECRET_KEY . $_POST['pw']) == mswEnc(SECRET_KEY . PASSWORD)) {
            $SSN->set(array('adm_user' => USERNAME));
            $SSN->set(array('adm_global' => mswEnc(SECRET_KEY . mswEnc('gl0bal'))));
            // Set cookie..
            if (ENABLE_LOGIN_COOKIE && isset($_POST['rm'])) {
              @setcookie(mswEnc(SECRET_KEY . DB_NAME), serialize($_SESSION), time() + 60 * 60 * 24 * LOGIN_COOKIE_DURATION);
            }
            // Entry log..
            $chop = array();
            if (SKIP_ELOG_USRS) {
              $chop = array_map('trim', explode(',', SKIP_ELOG_USRS));
            }
            if (!in_array(0, $chop)) {
              $SYS->elog(0);
            }
            $arr['status'] = 'ok';
          } else {
            $Q = $DB->db_query("SELECT * FROM `" . DB_PREFIX . "staff`
                 WHERE `user` = '" . mswSQL($_POST['usr']) . "'
                 AND `pass` = '" . mswEnc(SECRET_KEY . $_POST['pw']) . "'
                 AND `en` = 'yes'
                 ");
            $U = $DB->db_object($Q);
            if (isset($U->id)) {
              if ($U->type == 'restricted' && in_array($U->perms, array('',null))) {
                $arr['txt'][1] = $msw_adm_login7;
              } else {
                $chop = array();
                if (SKIP_ELOG_USRS) {
                  $chop = array_map('trim', explode(',', SKIP_ELOG_USRS));
                }
                if (!in_array($U->id, $chop)) {
                  $SYS->elog($U->id);
                }
                $SSN->set(array('adm_staff' => $U->user));
                $SSN->set(array('adm_type' => $U->type));
                $SSN->set(array('adm_staff_id' => $U->id));
                // Set cookie..
                if (ENABLE_LOGIN_COOKIE && isset($_POST['rm'])) {
                  @setcookie(mswEnc(SECRET_KEY . DB_NAME), serialize($_SESSION), time() + 60 * 60 * 24 * LOGIN_COOKIE_DURATION);
                }
                $arr['status'] = 'ok';
              }
            }
          }
        }
      }
    }
    break;

  case 'apikey':
    $arr['status'] = 'ok';
    $key = substr(md5(uniqid(rand(),1)), 3, rand(6,15)) . '-' . substr(md5(uniqid(rand(),1)), 3, rand(4,15)) . '-' . substr(md5(uniqid(rand(),1)), 3, rand(5,18));
    $arr['key'] = strtoupper($key);
    break;

  case 'auto-pass':
    $arr['status'] = 'ok';
    $arr['pass'] = $SYS->generate(SECURE_PASS_LENGTH, $addPassChars);
    break;

  case 'menu-panel':
    if (in_array($_GET['pnl'], array_keys($mswSysLinks))) {
      $SSN->set(array('adm_menu_panel' => $_GET['pnl']));
      $arr['status'] = 'ok';
    }
    break;

  case 'slug':
    $fm = array(
      'title' => (isset($_POST['fm']['title']) ? $_POST['fm']['title'] : ''),
      'name' => (isset($_POST['fm']['name']) ? $_POST['fm']['name'] : ''),
      'area' => (isset($_GET['a']) && in_array($_GET['a'], array('cat','page','journal')) ? $_GET['a'] : 'journal'),
      'build' => array()
    );
    $slug = explode(' ', ($fm['title'] ? $fm['title'] : $fm['name']));
    if ($slug) {
      for ($i=0; $i<count($slug); $i++) {
        if (strlen($slug[$i]) > SLUG_WORD_LIMIT) {
          $fm['build'][] = $slug[$i];
        }
      }
      $new_slug = (!empty($fm['build']) ? implode('-', $fm['build']) : mswSlug(($fm['title'] ? $fm['title'] : $fm['name'])));
      switch($fm['area']) {
        case 'journal':
          $cnt = $DB->db_rowcount('journals', 'WHERE `slug` = \'' . mswSQL($new_slug) . '\'');
          if ($cnt > 0) {
            $new_slug = $new_slug . '-' . ($cnt + 1);
          }
          break;
        case 'page':
          $cnt = $DB->db_rowcount('pages', 'WHERE `slug` = \'' . mswSQL($new_slug) . '\'');
          if ($cnt > 0) {
            $new_slug = $new_slug . '-' . ($cnt + 1);
          }
          break;
        case 'cat':
          $cnt = $DB->db_rowcount('categories', 'WHERE `slug` = \'' . mswSQL($new_slug) . '\'');
          if ($cnt > 0) {
            $new_slug = $new_slug . '-' . ($cnt + 1);
          }
          break;
      }
      $arr['slug'] = $new_slug;
    } else {
      $arr['slug'] = '';
    }
    break;

  case 'vc':
    $arr['status'] = 'ok';
    $arr['txt'][1] = mswL2BR($SYS->version());
    break;

}

if ($arr['status'] == 'ok') {
  $arr['txt'][0] = $msw_ajax4;
}
echo $JSON->encode($arr);
exit;

?>