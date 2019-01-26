<?php

/* CLASS FILE
----------------------------------*/

class pages {

  public function __construct($data = array()) {
    $this->total = $data['count'];
    $this->start = 0;
    $this->text  = $data['text'];
    switch($data['admin']) {
      case 'yes':
        $this->query = (isset($_GET['p']) ? '?p=' . $_GET['p'] . '&amp;' : '?') . 'next=';
        break;
      case 'no':
        $this->query = $data['url'];
        break;
    }
    $this->split = (defined('MSW_PLATFORM_DETECTION') && MSW_PLATFORM_DETECTION == 'mobile' ? 3 : 5);
    $this->page  = $data['page'];
    $this->limit = $data['limit'];
    $this->admin = $data['admin'];
    $this->modr  = (isset($data['s']->modr) ? $data['s']->modr : 'no');
    $this->flag  = (isset($data['flag']) && $data['flag'] ? explode(',', $data['flag']) : array());
  }

  public function perpage() {
    return ($this->limit > 0 ? $this->limit : DEF_PER_PAGE);
  }

  public function qstring() {
    $qstring = array();
    if (!empty($_GET)) {
      foreach ($_GET AS $k => $v) {
        if (is_array($v)) {
          foreach ($v AS $v2) {
            $qstring[] = $k . '[]=' . urlencode($v2);
          }
        } else {
          $merge = array_merge($this->flag, array(
            'p',
            'next',
            'deleted'
          ));
          if (!in_array($k, $merge)) {
            $qstring[] = $k . '=' . urlencode($v);
          }
        }
      }
    }
    return (!empty($qstring) ? '&amp;' . implode('&amp;', $qstring) : '');
  }

  public function setUrl($page) {
    switch($this->admin) {
      case 'yes':
        return $this->query . $page . pages::qstring();
        break;
      default:
        switch($this->modr) {
          case 'yes':
            return str_replace('{page}', $page, $this->query);
            break;
          default:
            return $this->query . $page . pages::qstring();
            break;
        }
        break;
    }
  }

  public function tmp($file) {
    if ($this->admin == 'yes') {
      return mswTmp(PATH . 'templates/html/pagination/' . $file);
    }
    return mswTmp(PATH . THEME_FOLDER . '/html/pagination/' . $file);
  }

  public function display() {
    $html = array();
    // How many pages?
    $this->num_pages = ceil($this->total / pages::perpage());
    // If pages less than or equal to 1, display nothing..
    if ($this->num_pages <= 1) {
      return '';
    }
    // Build pages..
    $current_page = $this->page;
    $begin        = $current_page - $this->split;
    $end          = $current_page + $this->split;
    if ($begin < 1) {
      $begin = 1;
      $end   = $this->split * 2;
    }
    if ($end > $this->num_pages) {
      $end   = $this->num_pages;
      $begin = $end - ($this->split * 2);
      $begin++;
      if ($begin < 1) {
        $begin = 1;
      }
    }
    if ($current_page != 1) {
      $html[] = str_replace(array('{text}','{url}'), array(mswSH($this->text[0]),pages::setUrl(1)), pages::tmp('previous-first.htm'));
      $html[] = str_replace(array('{text}','{url}'), array(mswSH($this->text[1]),pages::setUrl(($current_page - 1))), pages::tmp('previous-last.htm'));
    } else {
      $html[] = pages::tmp('previous-first-disabled.htm');
      $html[] = pages::tmp('previous-last-disabled.htm');
    }
    for ($i = $begin; $i <= $end; $i++) {
      $html[] = str_replace(array('{page}','{url}'), array($i,($i != $current_page ? pages::setUrl($i) : '#')), pages::tmp(($i != $current_page ? 'page.htm' : 'page-current.htm')));
    }
    if ($current_page != $this->num_pages) {
      $html[] = str_replace(array('{text}','{url}'), array(mswSH($this->text[2]),pages::setUrl(($current_page + 1))), pages::tmp('next-last.htm'));
      $html[] = str_replace(array('{text}','{url}'), array(mswSH($this->text[3]),pages::setUrl($this->num_pages)), pages::tmp('next-first.htm'));
    } else {
      $html[] = pages::tmp('next-last-disabled.htm');
      $html[] = pages::tmp('next-first-disabled.htm');
    }
    return str_replace('{pages}', implode(mswNL(), $html), pages::tmp('wrapper.htm'));
  }

}

?>