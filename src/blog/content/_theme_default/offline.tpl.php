<?php if(!defined('PARENT')) { exit; }

/* OFFLINE TEMPLATE
----------------------------------*/

?>
<!DOCTYPE html>
<html lang="<?php echo $this->META['lang']; ?>" dir="<?php echo $this->META['dir']; ?>">

  <head>

    <meta charset="<?php echo $this->META['charset']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo $this->META['basehref']; ?>">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/msw-base.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/animate.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/font-awesome/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/msw.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/mobile.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/plugins.css" type="text/css">
    <title><?php echo $this->META['title']; ?></title>
    <link rel="icon" href="<?php echo $this->META['basehref']; ?>favicon.ico">

  </head>

  <body>

    <div class="container offlinearea">
      <div class="row">
        <div class="col-lg-12">

          <h1><i class="fa fa-warning fa-fw"></i> <?php echo mswSH($this->SETTINGS['website']) . ': ' . $this->TEXT[0]; ?></h1>

          <div class="panel panel-default">
            <div class="panel-body">
              <?php echo $this->REASON; ?>
            </div>
          </div>

        </div>
      </div>
    </div>

  </body>

</html>