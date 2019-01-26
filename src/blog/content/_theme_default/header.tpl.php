<?php if(!defined('PARENT')) { exit; }

/* HEADER TEMPLATE
----------------------------------*/

?>
<!DOCTYPE html>
<html lang="<?php echo $this->META['lang']; ?>" dir="<?php echo $this->META['dir']; ?>">

  <head>

    <meta charset="<?php echo $this->META['charset']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo $this->META['basehref']; ?>">

    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/normalize.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/animate.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/msw-base.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/font-awesome/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/msw.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/mobile.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/plugins.css" type="text/css">
    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $this->RSS_LINK; ?>">
    <?php
    // Only include meta keys if they are present..
    if ($this->META['keys']) {
    ?>
    <meta name="keywords" content="<?php echo $this->META['keys']; ?>">
    <?php
    }
    // Only include meta desc if it is present..
    if ($this->META['desc']) {
    ?>
    <meta name="description" content="<?php echo $this->META['desc']; ?>">
    <?php
    }
    ?>
    <title><?php echo $this->META['title']; ?></title>
    <?php
    // Loads page specific CSS files.
    echo $this->MODULES;

    // Structured data..
    // html/social/*
    echo $this->STRUCTURED_DATA;
    ?>
    <link rel="icon" href="<?php echo $this->META['basehref']; ?>favicon.ico">

  </head>

  <body>

    <?php
    // Shows only on extra small screens
    ?>
    <div class="toppagebar hidden-sm hidden-md hidden-lg push">
      <a href="<?php echo $this->META['basehref']; ?>" title="<?php echo mswSH($this->SETTINGS['website']); ?>"><?php echo $this->SETTINGS['website']; ?></a>
    </div>

    <div class="navbar push">
      <div class="navbar-inner">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 leftblock">
              <i class="fa fa-bars fa-fw menu-btn" title="<?php echo mswSH($this->TEXT[1]); ?>"></i><span class="hidden-xs"> <a href="<?php echo $this->META['basehref']; ?>" title="<?php echo mswSH($this->SETTINGS['website']); ?>"><?php echo $this->SETTINGS['website']; ?></a></span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
              <form method="get" action="<?php echo $this->META['basehref']; ?>" id="sform">
              <div class="form-group">
                <div class="form-group input-group">
                  <input type="text" class="form-control" name="q" value="<?php echo (isset($_GET['q']) ? mswSH($_GET['q']) : ''); ?>" placeholder="<?php echo mswSH($this->TEXT[0]); ?>">
                  <span class="input-group-addon"><i class="fa fa-search fa-fw mswcursor_p" onclick="jQuery('#sform').submit()"></i></span>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container mainmswarea push" id="container">