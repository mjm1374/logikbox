<?php if(!defined('PARENT')) { exit; } ?>
<!DOCTYPE html>
<html lang="<?php echo $msw_html_lang; ?>" dir="<?php echo $msw_html_dir; ?>">

  <head>

    <meta charset="<?php echo $msw_html_charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="templates/css/normalize.css" type="text/css">
    <link rel="stylesheet" href="templates/css/animate.css" type="text/css">
    <link rel="stylesheet" href="templates/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="templates/css/msw-base.css" type="text/css">
    <link rel="stylesheet" href="templates/css/font-awesome/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="templates/css/msw.css" type="text/css">
    <link rel="stylesheet" href="templates/css/plugins.css" type="text/css">
    <link rel="stylesheet" href="templates/css/mobile.css" type="text/css">
    <?php
    if (in_array('jq-ui', $fjs)) {
    ?>
    <link rel="stylesheet" href="templates/css/jquery-ui.css" type="text/css">
    <?php
    }
    if (in_array('chartist', $fjs)) {
    ?>
    <link rel="stylesheet" href="templates/css/chartist.css" type="text/css">
    <?php
    }
    if (in_array('datepicker', $fjs)) {
    ?>
    <link rel="stylesheet" href="templates/css/datepicker.css" type="text/css">
    <?php
    }
    ?>
    <title><?php echo ($pagePrefix? mswSH($pagePrefix) . ': ' : '') . $pageTitle; ?> - <?php echo mswSH($SETTINGS->website); ?></title>
    <link rel="icon" href="favicon.ico">

  </head>

  <body>

    <?php
    // Shows only on extra small screens
    ?>
    <div class="toppagebar hidden-sm hidden-md hidden-lg push">
      <a href="index.php"><?php echo $msw_adm_header . (defined('DEV_BETA') && DEV_BETA != 'no' ? ' (BETA)' : ''); ?></a>
    </div>

    <div class="navbar push">
      <div class="navbar-inner">
        <div class="container">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td><i class="fa fa-bars fa-fw menu-btn"></i></td>
                  <td class="hidden-xs"><a href="index.php"><?php echo $msw_adm_header . (defined('DEV_BETA') && DEV_BETA != 'no' ? ' (BETA)' : ''); ?></a></td>
                  <td>
                    <?php
                    if ((defined('LICENCE_VER') && LICENCE_VER == 'locked') || defined('LIC_DEV')) {
                    ?>
                    <a href="?p=purchase"><i class="fa fa-shopping-basket fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_header2; ?></span></a>
                    <?php
                    }
                    ?>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_header4; ?></span></a>
                    <?php
                    if (ENABLE_HELP_LINK) {
                    ?>
                    <a href="<?php echo mswHelp($cmd); ?>" onclick="window.open(this);return false"><i class="fa fa-info-circle fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_header3; ?></span></a>
                    <?php
                    }
                    ?>
                    <a href="#" onclick="mswRDR('logout');return false"><i class="fa fa-unlock fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_header5; ?></span></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="container mainmswarea push" id="container">