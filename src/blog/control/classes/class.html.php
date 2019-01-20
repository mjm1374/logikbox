<?php

/* CLASS FILE
----------------------------------*/

class html extends db {

  public $settings;
  public $cache;
  public $bb;
  public $rwr;
  public $dt;
  public $sys;
  public $ssn;
  public $journals;

  public function social($d = array()) {
    // Check cache..
    $mCache = $this->cache->cache_link('social');
    if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
      if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
        return mswTmp($mCache);
      }
    }
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/social/social-link.htm');
    $rss = mswTmp(PATH . THEME_FOLDER . '/html/social/rss-link.htm');
    $soc = array();
    $Q  = db::db_query("SELECT * FROM `" . DB_PREFIX . "social`
          WHERE `desc` = 'links'
          ORDER BY `param`
          ");
    while ($SCL = db::db_object($Q)) {
      $soc[] = str_replace(array(
        '{url}',
        '{title}',
        '{icon}'
      ), array(
        mswSH($SCL->value),
        mswSH(ucwords($SCL->param)),
        $SCL->param
      ), $tmp);
    }
    // Rss..
    $url = $this->rwr->url(array(
      $this->rwr->config['slugs']['rss'],
      'rss=yes'
    ));
    $soc[] = str_replace(array(
      '{url}',
      '{title}'
    ), array(
      $url,
      mswSH($d['lang'][0])
    ), $rss);
    $data = (!empty($soc) ? implode(mswNL(),$soc) : '');
    // Update cache if enabled..
    $this->cache->cache_file($mCache, $data);
    return $data;
  }

  public function categories() {
    // Check cache..
    $mCache = $this->cache->cache_link('nav-cats');
    if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
      if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
        return mswTmp($mCache);
      }
    }
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/nav-link.htm');
    $cats = array();
    $Q  = db::db_query("SELECT `id`,`title`,`slug` FROM `" . DB_PREFIX . "categories`
          WHERE `en` = 'yes'
          ORDER BY `ordr`
          ");
    while ($C = db::db_object($Q)) {
      if ($C->slug) {
        $url = $this->rwr->url(array(
          $this->rwr->config['slugs']['cat'] . '/' . $C->slug,
          'c=' . $C->id
        ));
      } else {
        $url = $this->settings->ifolder . '?c=' . $C->id;
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
    $data = (!empty($cats) ? implode(mswNL(),$cats) : '');
    // Update cache if enabled..
    $this->cache->cache_file($mCache, $data);
    return $data;
  }

  public function pages() {
    // Check cache..
    $mCache = $this->cache->cache_link('new-pages');
    if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
      if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
        return mswTmp($mCache);
      }
    }
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/nav-link.htm');
    $pgs = array();
    $Q  = db::db_query("SELECT `id`,`name`,`slug` FROM `" . DB_PREFIX . "pages`
          WHERE `en` = 'yes'
          AND `landing` = 'no'
          ORDER BY `ordr`
          ");
    while ($PG = db::db_object($Q)) {
      $url = $this->rwr->url(array(
        $this->rwr->config['slugs']['npg'] . '/' . $PG->slug,
        'pg=' . $PG->id
      ));
      $pgs[] = str_replace(array(
        '{url}',
        '{title}',
        '{text}'
      ), array(
        $url,
        mswCD(mswSH($PG->name)),
        mswCD($PG->name)
      ), $tmp);
    }
    $data = (!empty($pgs) ? implode(mswNL(),$pgs) : '');
    // Update cache if enabled..
    $this->cache->cache_file($mCache, $data);
    return $data;
  }

  public function archive($d = array()) {
    // Check cache..
    $mCache = $this->cache->cache_link('nav-archive');
    if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
      if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
        return mswTmp($mCache);
      }
    }
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/nav-link.htm');
    $jns = array();
    $hidj = $this->journals->hidden('journal');
    $Q  = db::db_query("SELECT `id`,MONTH(FROM_UNIXTIME(`pubts`)) AS `m`, YEAR(FROM_UNIXTIME(`pubts`)) AS `y` FROM `" . DB_PREFIX . "journals`
          WHERE `en` = 'yes'
          AND `pubts` > 0
          AND `pubts` <= '" . $this->dt->ts() . "'
          AND `published` = 'yes'
          AND `slug` != ''
          " . (!empty($hidj) ? 'AND (`id` NOT IN(' . implode(',', $hidj) . '))' : '') . "
          GROUP BY MONTH(FROM_UNIXTIME(`pubts`)), YEAR(FROM_UNIXTIME(`pubts`))
          ORDER BY FIELD(`stick`,'yes','no'),`pubts` DESC
          ");
    while ($J = db::db_object($Q)) {
      $url = $this->rwr->url(array(
        $this->rwr->config['slugs']['arc'] . '/' . ($J->m < 10 ? '0' : '') . $J->m . '/' . $J->y,
        'a=' . ($J->m < 10 ? '0' : '') . $J->m . '-' . $J->y
      ));
      if (isset($d['c'][($J->m - 1)])) {
        $jns[] = str_replace(array(
          '{url}',
          '{title}',
          '{text}'
        ), array(
          $url,
          mswSH($d['c'][($J->m - 1)] . ' ' . $J->y),
          $d['c'][($J->m - 1)] . ' ' . $J->y
        ), $tmp);
      }
    }
    $data = (!empty($jns) ? implode(mswNL(),$jns) : '');
    // Update cache if enabled..
    $this->cache->cache_file($mCache, $data);
    return $data;
  }

  public function boxes() {
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/box.htm');
    $boxes = array();
    $Q  = db::db_query("SELECT * FROM `" . DB_PREFIX . "boxes` WHERE `en` = 'yes' ORDER BY `ordr`");
    while ($B = db::db_object($Q)) {
      if ($B->tmp && file_exists(PATH . THEME_FOLDER . '/custom-templates/' . $B->tmp)) {
        $boxes[] = array(
          'type' => 'custom',
          'box' => $B->tmp,
          'title' => mswCD($B->title),
          'info' => ($B->info ? mswBB($B->info, $this->settings, $this->bb) : ''),
          'icon' => mswCD(mswSH($B->icon))
        );
      } else {
        $boxes[] = array(
          'type' => 'standard',
          'box' => str_replace(array(
            '{text}',
            '{information}',
            '{icon}'
          ), array(
            mswCD($B->title),
            mswBB($B->info, $this->settings, $this->bb),
            mswCD(mswSH($B->icon))
          ), $tmp)
        );
      }
    }
    return $boxes;
  }

  public function calendar($d = array()) {
    // Set session..
    if (RETAIN_CAL_MONTH_ON_LOAD) {
      $this->ssn->set(array('mswcal' => $d['month'] . ',' . $d['year']));
    }
    // Check cache..
    $mCache = $this->cache->cache_link('calendar-' . $d['month'] . '-' . $d['year']);
    if ($this->cache->cache_options['cache_enable'] == 'yes' && file_exists($mCache)) {
      if ($this->cache->cache_exp($this->cache->cache_time($mCache)) == 'load') {
        return mswTmp($mCache);
      }
    }
    $wrap   = mswTmp(PATH . THEME_FOLDER . '/html/calendar-wrapper.htm');
    $tdcell = mswTmp(PATH . THEME_FOLDER . '/html/calendar-cell.htm');
    $tdrow  = mswTmp(PATH . THEME_FOLDER . '/html/calendar-row.htm');
    // Params..
    if (function_exists('cal_days_in_month')) {
      $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $d['month'], $d['year']);
    } else {
      $daysInMonth = date('t', strtotime($d['year'] . '-' . $d['month'] . '-01'));
    }
    $monthDayStart = date('w', strtotime($d['year'] . '-' . $d['month'] . '-01'));
    $monthDayEnd = date('w', strtotime($d['year'] . '-' . $d['month'] . '-' . $daysInMonth));
    $daysInLastMonth = date('t', strtotime('last month', strtotime($d['year'] . '-' . $d['month'] . '-01')));
    $startBlanks = 0;
    $endBlanks = 0;
    switch($this->settings->weekstart) {
      case 'sun':
        if ($monthDayStart != 0) {
          $startBlanks = -$monthDayStart;
        }
        if ($monthDayEnd != 6) {
          $endBlanks = (6 - $monthDayEnd);
        }
        break;
      case 'mon':
        if ($monthDayStart != 1) {
          $startBlanks = ($monthDayStart == 0 ? -6 : -($monthDayStart - 1));
        }
        if ($monthDayEnd != 0) {
          $endBlanks = ($monthDayStart == 0 ? (6 - $monthDayEnd) : (7 - $monthDayEnd));
        }
        break;
    }
    // Get days for month..
    $days = array();
    $rows = array();
    $dstr = '';
    for ($i=$startBlanks; $i<($daysInMonth + 1); $i++) {
      $dclass = ($i > 0 ? 'd' . (strlen($i < 10) ? '0' : '') . $i . $d['month'] . $d['year'] : 'skipday');
      $dys = array(
        '{c}' => ($i < 1 ? ' class="last_month_day"' : (date('Y-m-d', $this->dt->ts()) == $d['year'] . '-' . $d['month'] . '-' . (strlen($i < 10) ? '0' : '') . $i ? ' class="' . $dclass . ' today"' : ' class="' . $dclass . '"')),
        '{d}' => html::events($d, ($i > 0 ? $i : ($daysInLastMonth + $i)), ($i > 0 ? 'yes' : 'no'))
      );
      $days[] = strtr($tdcell, $dys) . mswNL();
    }
    // Append blanks..
    if ($endBlanks > 0) {
      for ($b=0; $b<$endBlanks+($this->settings->weekstart == 'mon' ? 3 : ($endBlanks < 3 ? 4 : 5)); $b++) {
        $dys = array(
          '{c}' => ' class="next_month_day"',
          '{d}' => ($b+1)
        );
        $days[] = strtr($tdcell, $dys) . mswNL();
      }
    }
    for ($x=1; $x<(count($days) + 1); $x++) {
      $dstr .= (isset($days[$x]) ? $days[$x] : '');
      if (in_array($x, array(7, 14, 21, 28, 35, ($this->settings->weekstart == 'mon' ? 43 : 42)))) {
        $rows[] = str_replace('{cells}', $dstr, $tdrow);
        $dstr = '';
      }
    }
    // Move sunday to the end and rebuild indexes..
    if ($this->settings->weekstart == 'mon') {
      $sn = $d['days'][0];
      unset($d['days'][0]);
      array_push($d['days'], $sn);
      $d['days'] = array_values($d['days']);
    }
    // Get header row..
    $hd = array(
      '{c1}' => ($this->settings->weekstart == 'sun' ? ' class="head_weekend"' : ''),
      '{c2}' => '',
      '{c3}' => '',
      '{c4}' => '',
      '{c5}' => '',
      '{c6}' => ($this->settings->weekstart == 'mon' ? ' class="head_weekend"' : ''),
      '{c7}' => ' class="head_weekend"',
      '{h1}' => $d['days'][0],
      '{h2}' => $d['days'][1],
      '{h3}' => $d['days'][2],
      '{h4}' => $d['days'][3],
      '{h5}' => $d['days'][4],
      '{h6}' => $d['days'][5],
      '{h7}' => $d['days'][6],
      '{last_month}' => $d['lang'][0],
      '{next_month}' => $d['lang'][1],
      '{month}' => $d['month_short_txt'][($d['month'] - 1)],
      '{year}' => $d['year']
    );
    $data = str_replace('{rows}', implode(mswNL(), $rows), strtr($wrap, $hd));
    // Update cache if enabled..
    $this->cache->cache_file($mCache, $data);
    return $data;
  }

  public function events($d = array(), $day, $show = 'yes') {
    if ($show == 'no') {
      return $day;
    }
    $hidj = $this->journals->hidden('journal');
    $tdlnk  = mswTmp(PATH . THEME_FOLDER . '/html/calendar-link.htm');
    $Q = db::db_query("SELECT count(*) AS `jcnt` FROM `" . DB_PREFIX . "journals`
          WHERE `en` = 'yes'
          AND `pubts` <= '" . $this->dt->ts() . "'
          AND `published` = 'yes'
          AND MONTH(FROM_UNIXTIME(`pubts`)) = '{$d['month']}'
          AND YEAR(FROM_UNIXTIME(`pubts`)) = '{$d['year']}'
          AND DAY(FROM_UNIXTIME(`pubts`)) = '{$day}'
          " . (!empty($hidj) ? 'AND (`id` NOT IN(' . implode(',', $hidj) . '))' : '') . "
          ");
    $J = db::db_object($Q);
    $url = $this->rwr->url(array(
      $this->rwr->config['slugs']['cal'] . '/' . $this->dt->calLinkFormat(($day < 10 ? '0' : '') . $day . '/' . $d['month'] . '/' . $d['year'], '/'),
      'cl=' . $this->dt->calLinkFormat(($day < 10 ? '0' : '') . $day . '-' . $d['month'] . '-' . $d['year'], '-')
    ));
    return (isset($J->jcnt) && $J->jcnt > 0 ? str_replace(array('{url}', '{title}', '{day}'), array($url, str_replace('{count}',mswNFM($J->jcnt),$d['lang'][2]), $day), $tdlnk) : $day);
  }

  public function select($d = array()) {
    $tmp  = mswTmp(PATH . THEME_FOLDER . '/html/option.htm');
    $str = array();
    switch($d['area']) {
      case 'months':
        if (!empty($d['months'])) {
          for ($i=0; $i<count($d['months']); $i++) {
            $slot = ($i < 9 ? '0' : '') . ($i + 1);
            $str[] = str_replace(array(
            '{val}',
            '{text}',
            '{selected}'
            ), array(
            $slot,
            $d['months'][$i],
            (isset($d['m']) && $d['m'] == $slot ? ' selected="selected"' : '')
            ), $tmp);
          }
        }
        break;
      case 'years':
        // Get year for oldest journal..
        $Q  = db::db_query("SELECT YEAR(FROM_UNIXTIME(`pubts`)) AS `Y` FROM `" . DB_PREFIX . "journals`
              WHERE `en` = 'yes'
              AND `pubts` <= '" . $this->dt->ts() . "'
              AND `published` = 'yes'
              ORDER BY `id` ASC
              LIMIT 1
              ");
        $J = db::db_object($Q);
        $start = (isset($J->Y) ? $J->Y : date('Y', $this->dt->ts()));
        for ($i=$start; $i<(date('Y', $this->dt->ts()) + 1); $i++) {
          $str[] = str_replace(array(
            '{val}',
            '{text}',
            '{selected}'
            ), array(
            $i,
            $i,
            (isset($d['y']) && $d['y'] == $i ? ' selected="selected"' : '')
            ), $tmp);
        }
        break;
    }
    return (!empty($str) ? implode(mswNL(), $str) : '');
  }

}

?>