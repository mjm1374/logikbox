<?php

/* CLASS FILE
----------------------------------*/

class journals extends db {

  public $settings;
  public $cache;
  public $bb;
  public $rwr;
  public $dt;
  public $sys;
  public $ssn;

  private $tag_divider = ', ';
  private $cat_divider = ', ';

  public function jcats($id) {
    // Check cache..
    $mCache = $this->cache->cache_link('journal-categories-' . $id);
    if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
      if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
        return mswTmp($mCache);
      }
    }
    $cats = array();
    $hidden = journals::hidden('category');
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/journal-category-link.htm');
    $Q  = db::db_query("SELECT `" . DB_PREFIX . "categories`.`id` AS `catID`,`title`,`slug` FROM `" . DB_PREFIX . "categories`
          LEFT JOIN `" . DB_PREFIX . "cat_journal`
          ON `" . DB_PREFIX . "categories`.`id` = `" . DB_PREFIX . "cat_journal`.`category`
          WHERE `" . DB_PREFIX . "cat_journal`.`journal` = '{$id}'
          AND `" . DB_PREFIX . "categories`.`en` = 'yes'
          " . (!empty($hidden) ? 'AND (`' . DB_PREFIX . 'categories`.`id` NOT IN(' . implode(',', $hidden) . '))' : '') . "
          GROUP BY `" . DB_PREFIX . "cat_journal`.`journal`
          ORDER BY `" . DB_PREFIX . "categories`.`ordr`
          ");
    while ($C = db::db_object($Q)) {
      if ($C->slug) {
        $url = $this->rwr->url(array(
          $this->rwr->config['slugs']['cat'] . '/' . $C->slug,
          'c=' . $C->catID
        ));
      } else {
        $url = $this->settings->ifolder . '?c=' . $C->catID;
      }
      $cats[] = str_replace(array(
      '{url}',
      '{title}',
      '{text}'
      ), array(
      $url,
      mswSH(mswCD($C->title)),
      mswCD($C->title)
      ), $tmp);
    }
    $data = (!empty($cats) ? implode($this->cat_divider, $cats) : '');
    // Update cache if enabled..
    $this->cache->cache_file($mCache, $data);
    return $data;
  }

  public function cronjobs($d = array()) {
    $report = array();
    switch($d['op']) {
      case 'cats':
        $del = array();
        $j = array();
        $Q  = db::db_query("SELECT `id`,`title` FROM `" . DB_PREFIX . "categories`
              WHERE `en` = 'yes'
              AND `delts` > 0
              AND `delts` <= '" . $this->dt->ts() . "'
              ORDER BY `title`
              ");
        while ($C = db::db_object($Q)) {
          $del[] = $C->id;
          $report[] = mswCD($C->title) . ' > ' . $d['lang'][0];
        }
        if (!empty($del)) {
          $q2 = db::db_query("SELECT `journal`,`category` FROM `" . DB_PREFIX . "cat_journal` WHERE `category` IN(" . mswSQL(implode(',', $del)) . ")");
          while ($CJ = db::db_object($q2)) {
            if (db::db_rowcount('cat_journal','WHERE `journal` = \'' . $CJ->journal . '\' AND `category` != \'' . $CJ->category . '\'') == 0) {
              $j[] = $CJ->journal;
            }
          }
          db::db_query("DELETE FROM `" . DB_PREFIX . "cat_journal` WHERE `category` IN(" . mswSQL(implode(',', $del)) . ")");
          db::db_query("DELETE FROM `" . DB_PREFIX . "categories` WHERE `id` IN(" . mswSQL(implode(',', $del)) . ")");
          if (!empty($j)) {
            db::db_query("DELETE FROM `" . DB_PREFIX . "journals` WHERE `id` IN(" . mswSQL(implode(',', $j)) . ")");
          }
          db::db_truncate(array('categories','journals','cat_journal'));
        }
        break;
      case 'journals':
        $del = array();
        $Q  = db::db_query("SELECT `id`,`title` FROM `" . DB_PREFIX . "journals`
              WHERE `en` = 'yes'
              AND `delts` > 0
              AND `delts` <= '" . $this->dt->ts() . "'
              ORDER BY `title`
              ");
        while ($J = db::db_object($Q)) {
          $del[] = $J->id;
          $report[] = mswCD($J->title) . ' > ' . $d['lang'][1];
        }
        if (!empty($del)) {
          db::db_query("DELETE FROM `" . DB_PREFIX . "journals` WHERE `id` IN(" . mswSQL(implode(',', $del)) . ")");
          db::db_query("DELETE FROM `" . DB_PREFIX . "cat_journal` WHERE `journal` IN(" . mswSQL(implode(',', $del)) . ")");
          db::db_truncate(array('cat_journal','journals'));
        }
        break;
      case 'publish':
        $act = array();
        $Q  = db::db_query("SELECT `id`,`title` FROM `" . DB_PREFIX . "journals`
              WHERE `en` = 'yes'
              AND `pubts` > 0
              AND `pubts` <= '" . $this->dt->ts() . "'
              AND `published` = 'no'
              ORDER BY `title`
              ");
        while ($J = db::db_object($Q)) {
          $act[] = $J->id;
          $report[] = mswCD($J->title) . ' > ' . $d['lang'][2];
        }
        if (!empty($act)) {
          db::db_query("UPDATE `" . DB_PREFIX . "journals` SET `published` = 'yes' WHERE `id` IN(" . mswSQL(implode(',', $act)) . ")");
        }
        break;
    }
    return (!empty($report) ? implode(mswNL(), $report) : '');
  }

  public function getjournals($d = array()) {
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/journal.htm');
    $ptmp = mswTmp(PATH . THEME_FOLDER . '/html/private-journal.htm');
    $clnk = mswTmp(PATH . THEME_FOLDER . '/html/journal-comment-link.htm');
    $tack = mswTmp(PATH . THEME_FOLDER . '/html/journal-pinned.htm');
    $prlk = mswTmp(PATH . THEME_FOLDER . '/html/journal-private.htm');
    $data = array();
    $hidc = journals::hidden('category');
    $hidj = journals::hidden('journal');
    switch($d['area']) {
      case 'rss':
        $jns = array();
        $Q  = db::db_query("SELECT `id`,`title`,`slug`,`comms`,`staff`,`rss`,`pubts`,`user`,`pass` FROM `" . DB_PREFIX . "journals`
              WHERE `en` = 'yes'
              AND `pubts` <= '" . $this->dt->ts() . "'
              AND `published` = 'yes'
              " . (!RSS_PRIVATE_SHOW ? 'AND (`user` = \'\' AND `pass` = \'\')' : '') . "
              " . (!empty($hidj) ? 'AND (`id` NOT IN(' . implode(',', $hidj) . '))' : '') . "
              ORDER BY FIELD(`stick`,'yes','no'),`pubts` DESC
              LIMIT " . RSS_JOURNALS);
        while ($J = db::db_object($Q)) {
          $jns[] = $J;
        }
        return $jns;
        break;
      case 'search':
        $keys = array_map('trim', explode(' ', urldecode($_GET['q'])));
        $str = '';
        $loop = 0;
        for ($i=0; $i<count($keys); $i++) {
          // Clean keyword, strip harmful characters..
          $keys[$i] = mswKeys($keys[$i]);
          if (strlen($keys[$i]) > SEARCH_SKIP_WORD_LENGTH) {
            // Fix for fulltext search 3 character limitation..
            if (strlen($keys[$i]) > 3 && FULLTEXT_SEARCH) {
              journals::log($keys[$i]);
              $str .= ($i > 0 ? 'OR (' : 'AND ((') . 'MATCH(`' . DB_PREFIX . 'journals`.`title`) AGAINST(\'' . mswSQL($keys[$i]) . '*\' IN BOOLEAN MODE) OR MATCH(`' . DB_PREFIX . 'journals`.`comms`) AGAINST(\'' . mswSQL($keys[$i]) . '*\' IN BOOLEAN MODE)) ';
            } else {
              journals::log($keys[$i]);
              $str .= ($i > 0 ? 'OR (' : 'AND ((') . '`' . DB_PREFIX . 'journals`.`title` LIKE \'%' . mswSQL($keys[$i]) . '%\' OR `' . DB_PREFIX . 'journals`.`comms` LIKE \'%' . mswSQL($keys[$i]) . '%\') ';
            }
            ++$loop;
          }
        }
        if ($str) {
          $str .= ')';
        } else {
           // Set empty string to find no results..
           $str = 'AND `' . DB_PREFIX . 'journals`.`title` = \'\'';
        }
        $Q = db::db_query("SELECT SQL_CALC_FOUND_ROWS *,
             `" . DB_PREFIX . "journals`.`user` AS `jUser`,
             `" . DB_PREFIX . "journals`.`pass` AS `jPass`,
             `" . DB_PREFIX . "journals`.`title` AS `jTitle`,
             `" . DB_PREFIX . "journals`.`slug` AS `jSlug`,
             `" . DB_PREFIX . "journals`.`id` AS `jID`
             FROM `" . DB_PREFIX . "cat_journal`
             LEFT JOIN `" . DB_PREFIX . "journals`
             ON `" . DB_PREFIX . "journals`.`id` = `" . DB_PREFIX . "cat_journal`.`journal`
             LEFT JOIN `" . DB_PREFIX . "categories`
             ON `" . DB_PREFIX . "categories`.`id` = `" . DB_PREFIX . "cat_journal`.`category`
             WHERE `" . DB_PREFIX . "journals`.`en` = 'yes'
             AND `" . DB_PREFIX . "journals`.`pubts` <= '" . $this->dt->ts() . "'
             AND `" . DB_PREFIX . "journals`.`published` = 'yes'
             " . (!empty($hidj) ? 'AND (`' . DB_PREFIX . 'journals`.`id` NOT IN(' . implode(',', $hidj) . '))' : '') . "
             $str
             GROUP BY `" . DB_PREFIX . "cat_journal`.`journal`
             ORDER BY FIELD(`" . DB_PREFIX . "journals`.`stick`,'yes','no'),`" . DB_PREFIX . "journals`.`pubts` DESC
             LIMIT " . $d['limit'] . "," . JNLS_PER_PAGE
             );
        break;
      case 'category':
        // Check cache..
        if (!isset($d['count'])) {
          $mCache = $this->cache->cache_link('category-' . $d['id'] . '-' . $d['page']);
          if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
            if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
              return mswTmp($mCache);
            }
          }
        }
        $Q = db::db_query("SELECT SQL_CALC_FOUND_ROWS *,
             `" . DB_PREFIX . "journals`.`user` AS `jUser`,
             `" . DB_PREFIX . "journals`.`pass` AS `jPass`,
             `" . DB_PREFIX . "journals`.`title` AS `jTitle`,
             `" . DB_PREFIX . "journals`.`slug` AS `jSlug`,
             `" . DB_PREFIX . "journals`.`id` AS `jID`
             FROM `" . DB_PREFIX . "cat_journal`
             LEFT JOIN `" . DB_PREFIX . "journals`
             ON `" . DB_PREFIX . "journals`.`id` = `" . DB_PREFIX . "cat_journal`.`journal`
             LEFT JOIN `" . DB_PREFIX . "categories`
             ON `" . DB_PREFIX . "categories`.`id` = `" . DB_PREFIX . "cat_journal`.`category`
             WHERE `" . DB_PREFIX . "journals`.`en` = 'yes'
             AND `" . DB_PREFIX . "journals`.`pubts` <= '" . $this->dt->ts() . "'
             AND `" . DB_PREFIX . "categories`.`id` = '{$d['id']}'
             AND `" . DB_PREFIX . "journals`.`published` = 'yes'
             GROUP BY `" . DB_PREFIX . "cat_journal`.`journal`
             ORDER BY FIELD(`" . DB_PREFIX . "journals`.`stick`,'yes','no'),`" . DB_PREFIX . "journals`.`pubts` DESC
             LIMIT " . $d['limit'] . "," . JNLS_PER_PAGE
             );
        break;
      case 'dashboard':
        // Check cache..
        $mCache = $this->cache->cache_link('journal-dashboard');
        if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
          if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
            return mswTmp($mCache);
          }
        }
        $Q = db::db_query("SELECT *,
             `" . DB_PREFIX . "journals`.`user` AS `jUser`,
             `" . DB_PREFIX . "journals`.`pass` AS `jPass`,
             `" . DB_PREFIX . "journals`.`title` AS `jTitle`,
             `" . DB_PREFIX . "journals`.`slug` AS `jSlug`,
             `" . DB_PREFIX . "journals`.`id` AS `jID`
             FROM `" . DB_PREFIX . "cat_journal`
             LEFT JOIN `" . DB_PREFIX . "journals`
             ON `" . DB_PREFIX . "journals`.`id` = `" . DB_PREFIX . "cat_journal`.`journal`
             LEFT JOIN `" . DB_PREFIX . "categories`
             ON `" . DB_PREFIX . "categories`.`id` = `" . DB_PREFIX . "cat_journal`.`category`
             WHERE `" . DB_PREFIX . "journals`.`en` = 'yes'
             AND `" . DB_PREFIX . "journals`.`pubts` <= '" . $this->dt->ts() . "'
             AND `" . DB_PREFIX . "journals`.`published` = 'yes'
             " . (!empty($hidj) ? 'AND (`' . DB_PREFIX . 'journals`.`id` NOT IN(' . implode(',', $hidj) . '))' : '') . "
             GROUP BY `" . DB_PREFIX . "cat_journal`.`journal`
             ORDER BY FIELD(`" . DB_PREFIX . "journals`.`stick`,'yes','no'),`" . DB_PREFIX . "journals`.`pubts` DESC
             LIMIT " . HOMEPAGE_LATEST
             );
        break;
      case 'archive':
      case 'archive-cal':
        // Check cache..
        if (!isset($d['count'])) {
          switch($d['area']){
            case 'archive':
              $mCache = $this->cache->cache_link('journal-archive-' . $d['dates'][0] . '-' . $d['dates'][1]);
              break;
            case 'archive-cal':
              $mCache = $this->cache->cache_link('journal-archivec-' . $d['dates'][0] . '-' . $d['dates'][1] . '-' . $d['dates'][2]);
              $sql = '';
              break;
          }
          if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
            if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
              return mswTmp($mCache);
            }
          }
        }
        switch($d['area']){
          case 'archive':
            $sql  = 'AND MONTH(FROM_UNIXTIME(`' . DB_PREFIX . 'journals`.`pubts`)) = \'' . $d['dates'][0] . '\' ' . mswNL();
            $sql .= 'AND YEAR(FROM_UNIXTIME(`' . DB_PREFIX . 'journals`.`pubts`)) = \'' . $d['dates'][1] . '\'';
            break;
          case 'archive-cal':
            $sql  = 'AND DAY(FROM_UNIXTIME(`' . DB_PREFIX . 'journals`.`pubts`)) = \'' . $d['dates'][0] . '\' ' . mswNL();
            $sql .= 'AND MONTH(FROM_UNIXTIME(`' . DB_PREFIX . 'journals`.`pubts`)) = \'' . $d['dates'][1] . '\' ' . mswNL();
            $sql .= 'AND YEAR(FROM_UNIXTIME(`' . DB_PREFIX . 'journals`.`pubts`)) = \'' . $d['dates'][2] . '\'';
            break;
        }
        $Q = db::db_query("SELECT SQL_CALC_FOUND_ROWS *,
             `" . DB_PREFIX . "journals`.`user` AS `jUser`,
             `" . DB_PREFIX . "journals`.`pass` AS `jPass`,
             `" . DB_PREFIX . "journals`.`title` AS `jTitle`,
             `" . DB_PREFIX . "journals`.`slug` AS `jSlug`,
             `" . DB_PREFIX . "journals`.`id` AS `jID`
             FROM `" . DB_PREFIX . "cat_journal`
             LEFT JOIN `" . DB_PREFIX . "journals`
             ON `" . DB_PREFIX . "journals`.`id` = `" . DB_PREFIX . "cat_journal`.`journal`
             LEFT JOIN `" . DB_PREFIX . "categories`
             ON `" . DB_PREFIX . "categories`.`id` = `" . DB_PREFIX . "cat_journal`.`category`
             WHERE `" . DB_PREFIX . "journals`.`en` = 'yes'
             AND `" . DB_PREFIX . "journals`.`published` = 'yes'
             AND `" . DB_PREFIX . "journals`.`pubts` <= '" . $this->dt->ts() . "'
             $sql
             " . (!empty($hidj) ? 'AND (`' . DB_PREFIX . 'journals`.`id` NOT IN(' . implode(',', $hidj) . '))' : '') . "
             GROUP BY `" . DB_PREFIX . "cat_journal`.`journal`
             ORDER BY FIELD(`" . DB_PREFIX . "journals`.`stick`,'yes','no'),`" . DB_PREFIX . "journals`.`pubts` DESC
             LIMIT " . $d['limit'] . "," . JNLS_PER_PAGE
             );
        break;
    }
    // Just get count of rows..
    if (isset($d['count'])) {
      return db::db_foundrows($Q);
    }
    while ($J = db::db_object($Q)) {
      $comments = '';
      if ($J->jSlug) {
        $url = $this->rwr->url(array(
          $this->rwr->config['slugs']['jnl'] . '/' . $J->jSlug,
          'j=' . $J->jID
        ));
      } else {
        $url = $this->settings->ifolder . '?j=' . $J->jID;
      }
      // Comments enabled?
      if ($J->encomms == 'yes') {
        $comments = str_replace(array(
        '{url}',
        '{title}',
        '{text}'
        ), array(
        $url,
        mswSH($d['lang'][6]),
        $d['lang'][1]
        ), $clnk);
      }
      // Is journal private?
      $private = ($J->jUser && $J->jPass ? 'yes' : 'no');
      // Is journal private via category?
      if ($private == 'no') {
        if (journals::privcats($J->jID) == 'yes') {
          $private = 'yes';
          $privCat = 'yes';
        }
      }
      // For icon..
      $privateIcon = $private;
      // If session var set, we can see private journal ok..
      if ($this->ssn->active('journal-' . $J->jID) == 'yes') {
        $private = 'no';
      }
      $data[] = str_replace(array(
      '{url}',
      '{url_text}',
      '{title}',
      '{information}',
      '{date}',
      '{time}',
      '{user}',
      '{comments}',
      '{pinned}',
      '{private}'
      ), array(
      $url,
      mswSH(mswCD($J->jTitle)),
      mswCD($J->jTitle),
      ($private == 'yes' ? str_replace('{url}', $url, $d['lang'][(isset($privCat) ? 4 : 0)]) : ($J->comms ? mswBB($J->comms, $this->settings, $this->bb) : '')),
      date($this->settings->dateformat, $J->pubts),
      date($this->settings->timeformat, $J->pubts),
      journals::staff(array('staff' => $J->staff, 'lang' => array($d['lang'][2]))),
      $comments,
      ($J->stick == 'yes' ? str_replace('{title}',mswSH($d['lang'][3]),$tack) : ''),
      ($privateIcon == 'yes' ? str_replace('{title}',mswSH($d['lang'][5]),$prlk) : '')
      ), ($private == 'yes' ? $ptmp : $tmp));
    }
    $data = (!empty($data) ? implode(mswNL(), $data) : '');
    // Update cache if enabled..
    if (isset($mCache)) {
      $this->cache->cache_file($mCache, $data);
    }
    return $data;
  }

  public function staff($d = array()) {
    switch($d['staff']) {
      case '0':
        return $d['lang'][0];
        break;
      default:
        $Q = db::db_query("SELECT `name` FROM `" . DB_PREFIX . "staff` WHERE `id` = '{$d['staff']}'");
        $STF = db::db_object($Q);
        return (isset($STF->name) ? mswCD($STF->name) : 'N/A');
        break;
    }
  }

  public function tags($d = array()) {
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/tag-link.htm');
    $str = array();
    if ($d['tags']) {
      foreach (array_map('trim', explode(',', $d['tags'])) AS $t) {
        $url = $this->rwr->url(array(
          $this->rwr->config['slugs']['sch'] . '/' . urlencode($t),
          'q=' . $t
        ));
        $str[] = str_replace(array(
        '{url}',
        '{title}',
        '{text}'
        ), array(
        $url,
        mswSH(mswCD($t)),
        mswCD($t)
        ),$tmp);
      }
    }
    return (!empty($str) ? implode($this->tag_divider, $str) : '');
  }

  public function privcats($id) {
    $Q = db::db_query("SELECT count(*) AS `cnt` FROM `" . DB_PREFIX . "cat_journal`
         WHERE `private` = 'yes'
         AND `journal` = '{$id}'
         ");
    $C = db::db_object($Q);
    return (isset($C->cnt) && $C->cnt > 0 ? 'yes' : 'no');
  }

  public function privcatslogin($fm) {
    $arr = array();
    $sss = array();
    $Q = db::db_query("SELECT `" . DB_PREFIX . "categories`.`user` AS `cUsr`,
         `" . DB_PREFIX . "categories`.`pass` AS `cPass`,
         `" . DB_PREFIX . "cat_journal`.`journal` AS `jID`,
         `" . DB_PREFIX . "categories`.`id` AS `cID`
         FROM `" . DB_PREFIX . "categories`
         LEFT JOIN `" . DB_PREFIX . "cat_journal`
         ON `" . DB_PREFIX . "categories`.`id` = `" . DB_PREFIX . "cat_journal`.`category`
         WHERE `" . DB_PREFIX . "cat_journal`.`private` = 'yes'
         AND `" . DB_PREFIX . "cat_journal`.`journal` = '{$fm['journal']}'
         AND `" . DB_PREFIX . "categories`.`en` = 'yes'
         ORDER BY `" . DB_PREFIX . "categories`.`title`
         ");
    while ($C = db::db_object($Q)) {
      if (($C->cUsr == $fm['user']) && ($C->cPass == $fm['pass']) && ($C->jID == $fm['journal'])) {
        $sss['cat-' . $id] = mswEnc($id . $this->dt->ts());
      }
    }
    if (!empty($sss)) {
      $this->ssn->set($sss);
      return 'ok';
    }
    return 'err';
  }

  public function recent($d = array()) {
    // Check cache..
    $mCache = $this->cache->cache_link('journal-recent' . ($d['loaded'] ? '-' . $d['loaded'] : ''));
    if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
      if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
        return mswTmp($mCache);
      }
    }
    $hidj = journals::hidden('journal');
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/journal-link.htm');
    $jns = array();
    $Q  = db::db_query("SELECT `id`,`title`,`slug` FROM `" . DB_PREFIX . "journals`
          WHERE `en` = 'yes'
          AND `pubts` <= '" . $this->dt->ts() . "'
          AND `published` = 'yes'
          " . (!empty($hidj) ? 'AND (`id` NOT IN(' . implode(',', $hidj) . '))' : '') . "
          ORDER BY FIELD(`stick`,'yes','no'),`pubts` DESC
          LIMIT
          " . ($d['limit'] > 0 ? $d['limit'] : RECENT_JOURNALS_MENU));
    while ($J = db::db_object($Q)) {
      if ($J->slug) {
        $url = $this->rwr->url(array(
          $this->rwr->config['slugs']['jnl'] . '/' . $J->slug,
          'j=' . $J->id
        ));
      } else {
        $url = $this->settings->ifolder . '?j=' . $J->id;
      }
      $jns[] = str_replace(array(
        '{url}',
        '{title}',
        '{text}'
      ), array(
        $url,
        mswSH(mswCD($J->title)),
        mswCD($J->title)
      ), $tmp);
    }
    $data = (!empty($jns) ? implode(mswNL(),$jns) : '');
    // Update cache if enabled..
    $this->cache->cache_file($mCache, $data);
    return $data;
  }

  public function jSessions($cat) {
    $arr = array();
    $q = db::db_query("SELECT `journal` FROM `" . DB_PREFIX . "cat_journal` WHERE `category` = '{$cat}' GROUP BY `journal`");
    while ($C = db::db_object($q)) {
      $arr['journal-' . $C->journal] = mswEnc($this->dt->ts() . $C->journal);
    }
    if (!empty($arr)) {
      $this->ssn->set($arr);
    }
  }

  public function hidden($field = 'journal') {
    $arr = array();
    $q = db::db_query("SELECT `" . $field . "` FROM `" . DB_PREFIX . "cat_journal` WHERE `hidden` = 'yes' GROUP BY `" . $field . "`");
    while ($C = db::db_object($q)) {
      $arr[] = $C->$field;
    }
    return $arr;
  }

  public function log($kw) {
    if (LOG_SEARCH_KEYWORDS && LOG_SEARCH_FILE) {
      file_put_contents(PATH . 'logs/' . LOG_SEARCH_FILE, $kw . ',' . date(LOG_SEARCH_DATE_FORMAT, $this->dt->ts()) . mswNL(), FILE_APPEND);
    }
  }

}

?>