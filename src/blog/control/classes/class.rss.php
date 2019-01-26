<?php

/* CLASS FILE
----------------------------------*/

class rss {

  private $config = array(
    'xmlv' => '1.0',
    'enc' => 'utf-8',
    'rssv' => '2.0',
    'lang' => 'en-us'
  );

  public $settings;
  public $rwr;

  public function open() {
    $xml   = '<rss version="' . $this->config['rssv'] . '" xmlns:atom="http://www.w3.org/2005/Atom">' . mswNL() . '<channel>';
    $xml2  = '<?xml version="' . $this->config['xmlv'] . '" encoding="' . $this->config['enc'] . '" ?>' . mswNL();
    return trim($xml2 . $xml);
  }

  public function add($d = array()) {
    return mswNL() . '<item>
     <title>' . rss::clean(array('data' => $d['title'])) . '</title>
     <link>' . $d['link'] . '</link>
     <pubDate>' . $d['date'] . '</pubDate>
     <guid>' . $d['link'] . '</guid>
     <description><![CDATA[' . rss::remove(array('data' => $d['desc'])) . '<br><br><b>' . rss::remove(array('data' => $d['footer'])) . '</b>]]></description>
    </item>';
  }

  public function info($d = array()) {
    $url = $this->rwr->url(array(
      $this->rwr->config['slugs']['rss'],
      'rss=yes'
    ));
    return mswNL() . '<title>' . rss::clean(array('data' => $d['title'])) . '</title>
    <link>' . $d['link'] . '</link>
    <description>' . rss::clean(array('data' => $d['desc'])) . '</description>
    <lastBuildDate>' . $d['date'] . '</lastBuildDate>
    <language>' . $this->config['lang'] . '</language>
    <generator>' . rss::clean(array('data' => $d['site'])) . '</generator>
    <atom:link href="' . $url . '" rel="self" type="application/rss+xml" />';
  }

  public function close() {
    return mswNL() . '</channel></rss>';
  }

  public function clean($d = array()) {
    if (isset($d['tags'])) {
      $data = rss::remove(array('data' => $d['data']));
    }
    return '<![CDATA[' . mswCD($d['data']) . ']]>';
  }

  public function remove($d = array()) {
    // Clean foreign characters..
    return $d['data'];
  }

}

?>