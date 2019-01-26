<?php

/* AJAX OPS
--------------------------------------------------------*/

if (!defined('PARENT') || !isset($_GET['ajax-ops'])) {
  exit;
}

$arr = array('status' => 'err', 'txt' => array($msw_ajax, $msw_ajax2));

switch($_GET['ajax-ops']) {
  case 'private':
    include(LANG_FLDR . 'journal.php');
    $fm = array(
      'user' => (isset($_POST['fm']['usr']) && $_POST['fm']['usr'] ? $_POST['fm']['usr'] : ''),
      'pass' => (isset($_POST['fm']['pwd']) && $_POST['fm']['pwd'] ? mswEnc(SECRET_KEY . $_POST['fm']['pwd']) : ''),
      'journal' => (isset($_POST['fm']['jnl']) && $_POST['fm']['jnl'] > 0 ? (int) $_POST['fm']['jnl'] : '0'),
      'category' => (isset($_POST['fm']['cat']) && $_POST['fm']['cat'] > 0 ? (int) $_POST['fm']['cat'] : '0')
    );
    // Protected Category..
    if ($fm['category'] > 0) {
      if ($DB->db_rowcount('categories', 'WHERE `id` = \'' . $fm['category'] . '\' AND `en` = \'yes\'') > 0) {
        if ($fm['user'] == '' || $fm['pass'] == '') {
          $arr['txt'][1] = $msw_journal9;
        } else {
          $PCAT = $SYS->load(array(
            'section' => 'category',
            'id' => $fm['category'],
            'slug' => ''
          ));
          if (isset($PCAT->id)) {
            if (($PCAT->user == $fm['user']) && ($PCAT->pass == $fm['pass']) && ($PCAT->id == $fm['category'])) {
              $JNLS->jSessions($PCAT->id);
              $SSN->set(array('cat-' . $PCAT->id => mswEnc($PCAT->pass . $DT->ts() . $PCAT->id)));
              $arr['status'] = 'ok';
            } else {
              $arr['txt'][1] = $msw_journal10;
            }
          }
        }
      }
    }
    // Protected Journal..
    elseif ($fm['journal'] > 0) {
      if ($JNLS->privcats($fm['journal']) == 'yes') {
        if ($JNLS->privcatslogin($fm) == 'ok') {
          $SSN->set(array('journal-' . $fm['journal'] => mswEnc($fm['pass'] . $DT->ts() . $fm['journal'])));
          $arr['status'] = 'ok';
        } else {
          $arr['txt'][1] = $msw_journal10;
        }
      }
      elseif ($DB->db_rowcount('journals', 'WHERE `id` = \'' . $fm['journal'] . '\' AND `en` = \'yes\'') > 0) {
        if ($fm['user'] == '' || $fm['pass'] == '') {
          $arr['txt'][1] = $msw_journal9;
        } else {
          $PJNL = $SYS->load(array(
            'section' => 'journal',
            'id' => $fm['journal'],
            'slug' => ''
          ));
          if (isset($PJNL->id)) {
            if (($PJNL->user == $fm['user']) && ($PJNL->pass == $fm['pass']) && ($PJNL->id == $fm['journal'])) {
              $SSN->set(array('journal-' . $PJNL->id => mswEnc($PJNL->pass . $DT->ts() . $PJNL->id)));
              $arr['status'] = 'ok';
            } else {
              $arr['txt'][1] = $msw_journal10;
            }
          }
        }
      }
    }
    break;
  case 'calendar':
    if (isset($_GET['dircn'])) {
      if (strpos($_GET['dircn'], '-') !== false) {
        $chop = explode('-', $_GET['dircn']);
        if (isset($chop[0], $chop[1])) {
          $t = strtotime((int) $chop[1] . '-' . ((int) $chop[0] < 10 ? '0' : '') . (int) $chop[0] . '-01');
          $y = date('Y', $t);
          $m = date('m', $t);
        } else {
          $failed = 'yes';
        }
      } else {
        if ($SSN->active('calendar-ts') == 'yes') {
          $ts = $SSN->get('calendar-ts');
        } else {
          $ts = $DT->ts();
        }
        switch($_GET['dircn']){
          case 'prev':
            $y = date('Y', strtotime('last month', $ts));
            $m = date('m', strtotime('last month', $ts));
            $t = strtotime($y . '-' . $m . '-01');
            break;
          case 'next':
            $y = date('Y', strtotime('next month', $ts));
            $m = date('m', strtotime('next month', $ts));
            $t = strtotime($y . '-' . $m . '-01');
            break;
          case 'reset':
            $y = date('Y', $DT->ts());
            $m = date('m', $DT->ts());
            $ts = $DT->ts();
            $t = $ts;
            break;
        }
      }
      if (!isset($failed)) {
        // Set new timestamp..
        $SSN->set(array('calendar-ts' => $t));
        include(LANG_FLDR . 'archive.php');
        $cal = array(
          'days' => $msw_calendar3,
          'month' => $m,
          'year' => $y,
          'month_long_txt' => $msw_calendar,
          'month_short_txt' => $msw_calendar2,
          'lang' => array(
            $msw_calendar4,
            $msw_calendar5,
            $msw_calendar6
          )
        );
        $arr['calendar'] = $HTML->calendar($cal);
        $arr['today'] = date('dmY', $DT->ts());
        $arr['monthyear'] = $msw_calendar2[($m - 1)] . ' ' . $y;
        $arr['month'] = $m;
        $arr['year'] = $y;
        $arr['reset'] = (date('Y-m', $DT->ts()) != $y . '-' . $m ? 'yes' : 'no');
        $arr['status'] = 'ok';
      }
    }
    break;

  case 'menu-state':
    if (isset($_GET['state'])) {
      $SSN->set(array('panel-state' => (int) $_GET['state']));
    }
    break;
}

if ($arr['status'] == 'ok') {
  $arr['txt'][0] = $msw_ajax4;
}
echo $JSON->encode($arr);
exit;

?>