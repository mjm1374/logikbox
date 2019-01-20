<?php if(!defined('PARENT')) { exit; } ?>
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
    <link rel="stylesheet" href="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>css/plugins.css" type="text/css">
    <title>401 - <?php echo $this->TEXT['401']; ?></title>
    <link rel="icon" href="<?php echo $this->META['basehref']; ?>favicon.ico">

  </head>

  <body>

  <div class="container errcontainer">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-danger">
          <div class="panel-heading errheader">
            401 - <?php echo $this->TEXT['401']; ?>
          </div>
          <div class="panel-body">
            <?php echo $this->TEXT['msg'][0]; ?>
          </div>
          <div class="panel-footer errfooter">
            <a href="<?php echo $this->META['basehref']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left fa-fw"></i> <span class="hidden-xs"><?php echo str_replace('{website}',mswCD($this->SETTINGS['website']),$this->TEXT['msg'][1]); ?></span></a>
            <a href="mailto:<?php echo $this->SETTINGS['email']; ?>" class="btn btn-default btn-sm"><i class="fa fa-envelope fa-fw"></i> <?php echo $this->TEXT['msg'][2]; ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  </body>

</html>