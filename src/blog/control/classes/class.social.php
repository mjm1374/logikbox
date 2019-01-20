<?php

/* CLASS FILE
----------------------------------*/

class social extends db {

  public $json;
  public $settings;
  public $cache;
  public $rwr;

  private $apiurl = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name={user}&count={count}';

  public $twitter = array(
    'user' => '',
    'limit' => 5,
    'consumerkey' => '',
    'consumersecret' => '',
    'accesstoken' => '',
    'accesstokensecret' => ''
  );

  public function disqus($d = array()) {
    $tmp = mswTmp(PATH . THEME_FOLDER . '/html/disqus.htm');
    $params = social::params('disqus');
    if (isset($params['disqus']['disname']) && $params['disqus']['disname']) {
      if ($d['slug']) {
        $url = $this->rwr->url(array(
          $this->rwr->config['slugs']['jnl'] . '/' . $d['slug'],
          'j=' . $d['id']
        ));
      } else {
        $url = $this->settings->ifolder . '?j=' . $d['id'];
      }
      return str_replace(array(
        '{short_name}',
        '{id}',
        '{url}',
        '{category}',
        '{theme_folder}'
      ), array(
        $params['disqus']['disname'],
        mswEnc('livej' . SECRET_KEY) . '_' . $d['id'],
        $url,
        (isset($params['disqus']['discat']) ? $params['disqus']['discat'] : 0),
        THEME_FOLDER
      ), $tmp);
    }
  }

  public function structured($data = array()) {
    $html = '';
    $prs = social::params('struct');
    $ar = array(
      'fb' => array(
        '{name}' => (isset($data['fb']['site']) ? $data['fb']['site'] : ''),
        '{url}' => (isset($data['fb']['url']) ? $data['fb']['url'] : ''),
        '{title}' => (isset($data['fb']['title']) ? $data['fb']['title'] : ''),
        '{desc}' => (isset($data['fb']['desc']) ? $data['fb']['desc'] : ''),
        '{image}' => (isset($data['fb']['image']) ? $data['fb']['image'] : '')
      ),
      'tw' => array(
        '{user}' => (isset($data['tw']['user']) ? $data['tw']['user'] : ''),
        '{title}' => (isset($data['tw']['title']) ? $data['tw']['title'] : ''),
        '{desc}' => (isset($data['tw']['desc']) ? $data['tw']['desc'] : ''),
        '{image}' => (isset($data['tw']['image']) ? $data['tw']['image'] : '')
      ),
      'gg' => array(
        '{title}' => (isset($data['gg']['title']) ? $data['gg']['title'] : ''),
        '{desc}' => (isset($data['gg']['desc']) ? $data['gg']['desc'] : ''),
        '{image}' => (isset($data['gg']['image']) ? $data['gg']['image'] : '')
      )
    );
    if (isset($prs['struct']['fb']) && $prs['struct']['fb'] == 'yes') {
      if (isset($data['fb']['img-path']) && file_exists($data['fb']['img-path'])) {
        $dims = getimagesize($data['fb']['img-path']);
      }
      $ar['fb']['{height}'] = (isset($dims[1]) ? $dims[1] : '0');
      $ar['fb']['{width}'] = (isset($dims[0]) ? $dims[0] : '0');
      $html = strtr(mswTmp(PATH . THEME_FOLDER . '/html/social/social-meta-facebook' . (mswSSL() == 'yes' ? '-ssl' : '') . '.htm'), $ar['fb']) . mswNL();
    }
    if (isset($prs['struct']['twitter']) && $prs['struct']['twitter'] == 'yes' && isset($data['tw']['user']) && $data['tw']['user']) {
      $html .= strtr(mswTmp(PATH . THEME_FOLDER . '/html/social/social-meta-twitter.htm'), $ar['tw']) . mswNL();
    }
    if (isset($prs['struct']['google']) && $prs['struct']['google'] == 'yes') {
      $html .= strtr(mswTmp(PATH . THEME_FOLDER . '/html/social/social-meta-google.htm'), $ar['gg']) . mswNL();
    }
    return ltrim($html);
  }

  public function tweets() {
    $tweets = array();
    include(GLOBAL_PATH . 'control/system/api/twitter/twitteroauth.php');
    try {
      $tapi = new TwitterOAuth(
        $this->twitter['consumerkey'],
        $this->twitter['consumersecret'],
        $this->twitter['accesstoken'],
        $this->twitter['accesstokensecret']
      );
      $tweets = $tapi->get(str_replace(array('{user}','{count}'),array($this->twitter['user'],$this->twitter['limit']),$this->apiurl));
    }
    catch(Exception $e) {
      return $e->getMessage();
    }
    return $this->json->encode($tweets);
  }

  public function params($flag = 'all') {
    $arr = array();
    switch($flag) {
      case 'all':
        $Q   = db::db_query("SELECT `desc`, `param`, `value` FROM `" . DB_PREFIX . "social`");
        break;
      default:
        $Q   = db::db_query("SELECT `desc`, `param`, `value` FROM `" . DB_PREFIX . "social` WHERE `desc` = '{$flag}'");
        break;
    }
    while ($PAR = db::db_object($Q)) {
      $arr[$PAR->desc][$PAR->param] = $PAR->value;
    }
    return $arr;
  }
}

?>