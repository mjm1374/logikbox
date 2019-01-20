<?php

/* CLASS FILE
----------------------------------*/

class bbcode {

  public $settings;

  // User input cleaner to prevent validation errors..
  public function clean($data) {
    if (EN_BB) {
      $find = array(
        '[img] ',
        ' [/img]',
        '[url] ',
        ' [/url]',
        '[email] ',
        ' [/email]',
        '[IMG] ',
        ' [/IMG]',
        '[URL] ',
        ' [/URL]',
        '[EMAIL] ',
        ' [/EMAIL]'
      );
      $repl = array(
        '[img]',
        '[/img]',
        '[url]',
        '[/url]',
        '[email]',
        '[/email]',
        '[IMG]',
        '[/IMG]',
        '[URL]',
        '[/URL]',
        '[EMAIL]',
        '[/EMAIL]'
      );
      $data = str_replace($find, $repl, $data);
    }
    return $data;
  }

  // General parser..
  public function bbParser($text) {
    // Check for square brackets. If not found, no bb code exists..
    if (strpos($text, '[') === false && strpos($text, ']') === false) {
      return (AUTO_PARSE_LINE_BREAKS ? mswL2BR(htmlspecialchars($text)) : htmlspecialchars($text));
    }
    $tagList = array(
      '[b]' => '<span class="bbBold">',
      '[u]' => '<span class="bbUnderline">',
      '[i]' => '<span class="bbItalics">',
      '[s]' => '<span class="bbStrike">',
      '[del]' => '<span class="bbDel">',
      '[ins]' => '<span class="bbIns">',
      '[em]' => '<span class="bbEm">',
      '[h1]' => '<span class="bbH1">',
      '[h2]' => '<span class="bbH2">',
      '[h3]' => '<span class="bbH3">',
      '[h4]' => '<span class="bbH4">',
      '[center]' => '<span class="bbCentre">',
      '[list]' => '<ul class="bbUl">',
      '[list=n]' => '<ul class="bbUlNumbered">',
      '[list=a]' => '<ul class="bbUlAlpha">',
      '[list=ua]' => '<ul class="bbUlUpperAlpha">',
      '[*]' => '<li class="bbLi">',
      '[B]' => '<span class="bbBold">',
      '[U]' => '<span class="bbUnderline">',
      '[I]' => '<span class="bbItalics">',
      '[S]' => '<span class="bbStrike">',
      '[DEL]' => '<span class="bbDel">',
      '[INS]' => '<span class="bbIns">',
      '[EM]' => '<span class="bbEm">',
      '[H1]' => '<span class="bbH1">',
      '[H2]' => '<span class="bbH2">',
      '[H3]' => '<span class="bbH3">',
      '[H4]' => '<span class="bbH4">',
      '[CENTER]' => '<span class="bbCentre">',
      '[LIST]' => '<ul class="bbUl">',
      '[LIST=N]' => '<ul class="bbUlNumbered">',
      '[LIST=A]' => '<ul class="bbUlAlpha">',
      '[/b]' => '</span>',
      '[/u]' => '</span>',
      '[/i]' => '</span>',
      '[/s]' => '</span>',
      '[/del]' => '</span>',
      '[/ins]' => '</span>',
      '[/em]' => '</span>',
      '[/h1]' => '</span>',
      '[/h2]' => '</span>',
      '[/h3]' => '</span>',
      '[/h4]' => '</span>',
      '[/center]' => '</span>',
      '[/list]' => '</ul>',
      '[/list]' => '</ul>',
      '[/list]' => '</ul>',
      '[/B]' => '</span>',
      '[/U]' => '</span>',
      '[/I]' => '</span>',
      '[/S]' => '</span>',
      '[/DEL]' => '</span>',
      '[/INS]' => '</span>',
      '[/EM]' => '</span>',
      '[/H1]' => '</span>',
      '[/H2]' => '</span>',
      '[/H3]' => '</span>',
      '[/H4]' => '</span>',
      '[/CENTER]' => '</span>',
      '[/LIST]' => '</ul>',
      '[/LIST]' => '</ul>',
      '[/LIST]' => '</ul>',
      '[/*]' => '</li>'
    );
    // Deal with potential slashes..
    $text    = mswCD($text);
    // Kill html..
    $text    = htmlspecialchars($text);
    // Parse colors..
    $text    = bbcode::colorParser($text);
    // Parse urls..
    $text    = bbcode::urlParser($text);
    // Parse youtube videos..
    $text    = bbcode::youTubeParser($text);
    // Parse vimeo videos..
    $text    = bbcode::vimeoParser($text);
    // Parse daily motion videos..
    $text    = bbcode::dailyMotionParser($text);
    // Parse soundcloud videos..
    $text    = bbcode::soundCloudParser($text);
    // Parse mp3 files..
    $text    = bbcode::mp3Parser($text);
    // Parse emails..
    $text    = bbcode::emailParser($text);
    // Parse images..
    $text    = bbcode::imageParser($text);
    // Deal with other tags and return..
    $text    = strtr($text, $tagList);
    $text    = (AUTO_PARSE_LINE_BREAKS ? mswL2BR(trim($text)) : trim($text));
    // Clean up <ul> & <li> tags which have invalid linebreaks..
    $find    = array(
      '<ul><br>',
      '</ul><br>',
      '<li><br>',
      '</li><br>',
      '<ul class="bbUl"><br>',
      '<ul class="bbUlNumbered"><br>',
      '<ul class="bbUlAlpha"><br>',
      '<ul class="bbUlUpperAlpha"><br>'
    );
    $repl    = array(
      '<ul>',
      '</ul>',
      '<li>',
      '</li>',
      '<ul class="bbUl">',
      '<ul class="bbUlNumbered">',
      '<ul class="bbUlAlpha">',
      '<ul class="bbUlUpperAlpha">'
    );
    return str_replace($find, $repl, $text);
  }

  // For colour tags..
  public function colorParser($text) {
    $pattern[] = '#\[colou?r=([a-zA-Z]{3,20}|\#[0-9a-fA-F]{6}|\#[0-9a-fA-F]{3})](.*?)\[/colou?r\]#ms';
    $replace[] = '<span style="color: $1">$2</span>';
    return preg_replace($pattern, $replace, $text);
  }

  // For url tags..
  public function urlParser($text) {
    $text = preg_replace('#\[urlnew\=(.+)\](.+)\[\/urlnew\]#iUs', '<a href="$1" onclick="window.open(this);return false">$2</a>', $text);
    $text = preg_replace('#\[urlnew\](.+)\[/urlnew\]#iUs', '<a href="$1" onclick="window.open(this);return false">$1</a>', $text);
    $text = preg_replace('#\[url\=(.+)\](.+)\[\/url\]#iUs', '<a href="$1">$2</a>', $text);
    $text = preg_replace('#\[url\](.+)\[/url\]#iUs', '<a href="$1">$1</a>', $text);
    return $text;
  }

  // For YouTube tags..
  public function youTubeParser($text) {
    $wrap = '<div class="youtube-container">' . YOU_TUBE_EMBED_CODE . '</div>';
    $text = preg_replace('#\[youtube\](.+)\[/youtube\]#iUs', str_replace('{CODE}', '$1', $wrap), $text);
    return $text;
  }

  // For Vimeo tags..
  public function vimeoParser($text) {
    $wrap = '<div class="vimeo-container">' . VIMEO_EMBED_CODE . '</div>';
    $text = preg_replace('#\[vimeo\](.+)\[/vimeo\]#iUs', str_replace('{CODE}', '$1', $wrap), $text);
    return $text;
  }

  // For Daily motion tags..
  public function dailyMotionParser($text) {
    $wrap = '<div class="dailymotion-container">' . DAILY_MOTION_EMBED_CODE . '</div>';
    $text = preg_replace('#\[dailymotion\](.+)\[/dailymotion\]#iUs', str_replace('{CODE}', '$1', $wrap), $text);
    return $text;
  }

  // For Soundcloud tags..
  public function soundCloudParser($text) {
    $text = preg_replace('#\[soundcloud\](.+)\[/soundcloud\]#iUs', str_replace('{CODE}', '$1', SOUNDCLOUD_EMBED_CODE), $text);
    return $text;
  }

  // For MP3 tags..
  public function mp3Parser($text) {
    $text = preg_replace('#\[mp3\](.+)\[/mp3\]#iUs', str_replace(
      array(
        '{MP3}',
        '{BASE}'
      ),
      array(
        '$1',
        $this->settings->ifolder.'/' . THEME_FOLDER
      ),MP3_EMBED_CODE),
      $text
    );
  return $text;
  }

  // For mailto tags..
  public function emailParser($text) {
    $pattern[] = '#\[email\]([^\[]*?)\[/email\]#';
    $pattern[] = '#\[email=([^\[]+?)\](.*?)\[/email\]#';
    $replace[] = '<a class="bbMailto" href="mailto:$1">$1</a>';
    $replace[] = '<a class="bbMailto" href="mailto:$1">$2</a>';
    return preg_replace($pattern, $replace, $text);
  }

  // For img tags..
  public function imageParser($text) {
    return preg_replace('#\[img\](.+)\[\/img\]#iUs', '<img class="img-responsive" src="$1" alt="">', $text);
  }

}

?>