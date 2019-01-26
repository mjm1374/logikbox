<?php

/* MAIL CLASS FILE
----------------------------------*/

define('SYS_ROOT_PATH', substr(dirname(__file__), 0, strpos(dirname(__file__), 'control') - 1) . '/');
include(SYS_ROOT_PATH . 'control/classes/mailer/src/Exception.php');
include(SYS_ROOT_PATH . 'control/classes/mailer/src/SMTP.php');
include(SYS_ROOT_PATH . 'control/classes/mailer/src/PHPMailer.php');
include(SYS_ROOT_PATH . 'control/html-mail-tags.php');

class mailr extends PHPMailer\PHPMailer\PHPMailer {

  // Send type..
  // smtp = SMTP
  // mail = PHP mail function
  private $sendType = 'smtp';

  // Host..
  public $smtp_host = 'localhost';

  // Port..
  public $smtp_port = 587;

  // User/Pass..
  public $smtp_user = '';
  public $smtp_pass = '';

  // Security..
  public $smtp_sec = '';

  // HTML only tags..
  public $htmltags = array();

  // Debug..
  public $debug = 'no';

  // Subject prefix
  public $sbjpref;

  // Mail switch..
  public $mailSwitch = 'yes';

  // Mail tags array...
  public $vars = array();

  // Custom mail headers..
  public $xheaders = array();

  // Attachments..
  public $attachments = array();

  // Settings..
  public $config = array();

  // Parser..
  public $parser;

  // Mail debug log..
  private $debug_log_file = 'mail-debug-log.log';

  // HTML elements
  public $htmlelements = array(
    'lang' => 'en',
    'dir' => 'ltr',
    'charset' => 'utf-8'
  );

  // Allow insecure connections..
  // Use at your own risk..
  // yes or no value
  private $allowInsecure = 'no';

  // Read and parse HTML only tags...
  public function htmlTagParser($data, $plain = 'no') {
    if (!empty($this->htmltags)) {
      foreach ($this->htmltags AS $k => $v) {
        switch($plain) {
          case 'yes':
            $data = str_replace($k, '', $data);
            break;
          case 'no':
            $data = str_replace($k, $v, $data);
            break;
        }
      }
    }
    return trim($data);
  }

  // Converts entities..plain text only..
  public function convertChar($data, $type = 'html') {
    $find = array(
      '&#039;',
      '&quot;',
      '&amp;',
      '&lt;',
      '&gt;'
    );
    $replace = array(
      '\'',
      '"',
      '&',
      '<',
      '>'
    );
    $data = htmlspecialchars_decode($data);
    if ($type == 'plain') {
      return str_replace($find, $replace, mswCD($data));
    } else {
      return mswCD($data);
    }
  }

  // Loads tags into array..
  public function addTag($placeholder, $data, $type = 'none') {
    switch($type) {
      case 'none':
        $this->vars[$placeholder] = mswQT($data);
        break;
      default:
        if (in_array($type, array('plain','html'))) {
          $this->vars[$type][$placeholder] = mswQT($data);
        }
        break;
    }
  }

  // Clears data vars..
  public function clearVars() {
    $this->vars = array();
  }

  // Converts tags..
  public function convertTags($data, $type = 'none') {
    if (!empty($this->vars)) {
      switch($type) {
        case 'none':
          foreach ($this->vars AS $tags => $value) {
            $data = str_replace($tags, $value, $data);
          }
          break;
        default:
          if (in_array($type, array('plain','html'))) {
            foreach ($this->vars[$type] AS $tags => $value) {
              $data = str_replace($tags, $value, $data);
            }
          }
          break;
      }
    }
    return $data;
  }

  // Cleans spam/form injection input..
  public function injectionCleaner($data) {
    $find = array(
      "\r",
      "\n",
      "%0a",
      "%0d",
      "content-type:",
      "Content-Type:",
      "BCC:",
      "CC:",
      "boundary=",
      "TO:",
      "bcc:",
      "to:",
      "cc:"
    );
    $replace = array();
    return str_replace($find, $replace, $data);
  }

  // Loads email template..
  public function template($file) {
    // Is this a template or just text?
    if (substr(strtolower($file), -4) == '.txt') {
      return (file_exists($file) ? trim(file_get_contents($file)) : 'An error occurred opening the "' . $file . '" file. Check that this file exists in the correct "content/language/*/' . LANG_FLDR_EM . '/" folder.');
    }
    return $file;
  }

  // HTML mail wrapper..
  public function htmlWrap($tmp) {
    $msg   = $this->convertTags($this->template($tmp['template']), 'none');
    $parse = explode('<-{separater}->', $msg);
    // Check for 3 slots, eg: 2 separators..
    if (count($parse) == 3) {
      $head = trim($parse[0]);
      $cont = trim($parse[1]);
      $foot = trim($parse[2]);
    } else {
      $head = mswCD($this->config['website']);
      $cont = str_replace('<-{separater}->', '', trim($msg));
      $foot = mswCD($this->config['ifolder']);
    }
    // Auto parse hyperlinks..
    $head = $this->convertChar($this->parser->autoLinkParser($head));
    $cont = $this->convertChar($this->parser->autoLinkParser($cont));
    $foot = $this->convertChar($this->parser->autoLinkParser($foot));
    // Auto parse line breaks..
    $head = mswL2BR($head);
    $cont = mswL2BR($cont);
    $foot = mswL2BR($foot);
    // Parse html message with wrapper..
    $find = array(
      '{LANG}',
      '{DIR}',
      '{CHARSET}',
      '{TITLE}',
      '{HEADER}',
      '{CONTENT}',
      '{FOOTER}'
    );
    $repl = array(
      $this->htmlelements['lang'],
      $this->htmlelements['dir'],
      $this->htmlelements['charset'],
      mswQT($this->config['website']),
      $head,
      $cont,
      $foot . mswL2BR($this->appendFooterToEmails('html'))
    );
    // Language override..
    if (isset($tmp['language']) && is_dir(SYS_ROOT_PATH . 'content/language/' . $tmp['language'])) {
      $this->config['languagePref'] = $tmp['language'];
    }
    $html = str_replace($find, $repl, file_get_contents(SYS_ROOT_PATH . 'content/language/' . $this->config['languagePref'] . '/' . LANG_FLDR_EM . '/html-wrapper.html'));
    return $this->htmlTagParser($html);
  }

  // Plain text separator..
  public function plainTxtSep() {
    return '---------------------------------------------';
  }

  // Plain text mail wrapper..
  public function plainWrap($tmp) {
    $msg   = $this->convertChar($this->convertTags($this->template($tmp['template']), 'none'));
    $parse = explode('<-{separater}->', $msg);
    // Check for 3 slots, eg: 2 separators..
    if (count($parse) == 3) {
      $head = trim(strip_tags($parse[0]));
      $cont = trim(strip_tags($parse[1]));
      $foot = trim(strip_tags($parse[2]));
    } else {
      $head = mswCD(strip_tags($this->config['website']));
      $cont = trim(strip_tags($msg));
      $foot = mswCD(strip_tags($this->config['ifolder']));
    }
    if (isset($tmp['no-footer'])) {
      $foot = '';
    }
    $html = $head . mswNL() . $this->plainTxtSep() . mswNL() . mswNL() . $cont . mswNL() . mswNL() . $this->plainTxtSep() . mswNL() . $foot . $this->appendFooterToEmails();
    return $this->htmlTagParser($html, 'yes');
  }

  // Footer for free version..
  // Please don`t remove the footer unless you have purchased a licence..
  public function appendFooterToEmails($type = 'plain') {
    if (LICENCE_VER == 'unlocked') {
      return '';
    }
    switch($type) {
      case 'plain':
        $string  = mswNL() . mswNL();
        $string .= 'Free ' . SCRIPT_DESC . ' Powered by ' . SCRIPT_NAME . mswNL();
        $string .= 'https://www.' . SCRIPT_URL;
        break;
      case 'html':
        $string  = mswNL() . mswNL();
        $string .= 'Free ' . SCRIPT_DESC . ' Powered by ' . SCRIPT_NAME . mswNL();
        $string .= '<a href="https://www.' . SCRIPT_URL . '">https://www.' . SCRIPT_URL . '</a>';
        break;
    }
    return $string;
  }

  // Sends mail..
  public function sendMail($mail = array()) {
    if ($this->mailSwitch == 'yes') {
      switch($this->sendType) {
        case 'mail':
          $this->isMail();
          break;
        default:
          $this->IsSMTP();
          break;
      }
      $this->Port       = $this->smtp_port;
      $this->Host       = $this->smtp_host;
      $this->SMTPAuth   = ($this->smtp_user && $this->smtp_pass ? true : false);
      $this->SMTPSecure = (in_array($this->smtp_sec, array(
        '',
        'tls',
        'ssl'
      )) ? $this->smtp_sec : '');
      // Allow insecure connections?
      if ($this->allowInsecure == 'yes') {
        $this->SMTPOptions = array(
          'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
          )
        );
      }
      // Keep connection alive..
      if (isset($mail['alive'])) {
        $this->SMTPKeepAlive = true;
      }
      $this->Username = $this->smtp_user;
      $this->Password = $this->smtp_pass;
      $this->CharSet  = ($this->htmlelements['charset'] ? $this->htmlelements['charset'] : 'utf-8');
      // Enable debug..
      if ($this->debug == 'yes') {
        $this->SMTPDebug = 2;
        $this->Debugoutput = function($str, $level) {
          file_put_contents(SYS_ROOT_PATH . 'logs/' . $this->debug_log_file, $str . (function_exists('mswNL') ? mswNL() : PHP_EOL), FILE_APPEND);
        };
      }
      // Custom mail headers..
      if (!empty($this->xheaders)) {
        foreach ($this->xheaders AS $k => $v) {
          $this->AddCustomHeader($k . ':' . $v);
        }
      }
      // From/to headers..
      $this->From     = (defined('MAIL_FROM_EMAIL_HEADER') && MAIL_FROM_EMAIL_HEADER ? MAIL_FROM_EMAIL_HEADER : $this->injectionCleaner($mail['from_email']));
      $this->FromName = (defined('MAIL_FROM_NAME_HEADER') && MAIL_FROM_NAME_HEADER ? MAIL_FROM_NAME_HEADER : $this->injectionCleaner($this->convertChar($mail['from_name'])));
      $this->AddAddress($this->injectionCleaner($mail['to_email']), $this->injectionCleaner($this->convertChar($mail['to_name'])));
      // Reply to..
      if (!empty($mail['replyto'])) {
        $this->AddReplyTo($mail['replyto']['email'], $mail['replyto']['name']);
      }
      // Additional standard addresses..
      if (isset($mail['add-emails']) && $mail['add-emails']) {
        $addEmails = array_map('trim', explode(',', $mail['add-emails']));
        if (!empty($addEmails)) {
          foreach ($addEmails AS $aAddresses) {
            $this->AddAddress($this->injectionCleaner($aAddresses), $this->injectionCleaner($this->convertChar($mail['to_name'])));
          }
        }
      }
      // Carbon copy addresses..
      if (!empty($mail['cc'])) {
        foreach ($mail['cc'] AS $cc_email => $cc_name) {
          $this->AddCC($cc_email, $cc_name);
        }
      }
      // Blind carbon copy addresses..
      if (!empty($mail['bcc'])) {
        foreach ($mail['bcc'] AS $bcc_email => $bcc_name) {
          $this->AddBCC($bcc_email, $bcc_name);
        }
      }
      $this->WordWrap = 1000;
      // Subject..
      $this->Subject  = $this->convertChar($this->sbjpref . $mail['subject']);
      // X Mailer..
      if (defined('MAIL_X_MAIL_HEADER') && MAIL_X_MAIL_HEADER) {
        $this->XMailer = MAIL_X_MAIL_HEADER;
      }
      // Message body..
      $this->MsgHTML((isset($mail['template']['html']) ? $mail['template']['html'] : $this->htmlWrap($mail)));
      $this->AltBody = (isset($mail['template']['plain']) ? $mail['template']['plain'] : $this->plainWrap($mail));
      // Attachments..
      if (!empty($this->attachments)) {
        foreach ($this->attachments AS $f => $n) {
          $this->AddAttachment($f, $n);
        }
      }
      // Send mail..
      $this->Send();
      // Clear all recipient data..
      $this->ClearReplyTos();
      $this->ClearAllRecipients();
    }
  }

}

//---------------------------------------------------
// Check licence ver - please do not alter or change
//---------------------------------------------------

if (!defined('LICENCE_VER') || !class_exists('mswLic')) {
  die(@base64_decode('U3lzdGVtIGVycm9yLCBwbGVhc2UgY29udGFjdCBNUyBXb3JsZCBAIDxhIGhyZWY9Im1haWx0bzpzdXBwb3J0QG1haWFuc2NyaXB0d29ybGQuY28udWsiPnN1cHBvcnRAbWFpYW5zY3JpcHR3b3JsZC5jby51azwvYT48YnI+PGJyPlNvcnJ5IGZvciB0aGUgaW5jb252ZW5pZW5jZS4='));
}

?>