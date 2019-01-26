<?php if (!defined('PARENT')) { exit; } ?>
<!DOCTYPE html>
<html lang="<?php echo $msw_html_lang; ?>" dir="<?php echo $msw_html_dir; ?>">

  <head>

    <meta charset="<?php echo $msw_html_charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="templates/css/normalize.css" type="text/css">
    <link rel="stylesheet" href="templates/css/animate.css" type="text/css">
    <link rel="stylesheet" href="templates/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="templates/css/msw-base.css" type="text/css">
    <link rel="stylesheet" href="templates/css/font-awesome/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="templates/css/msw.css" type="text/css">
    <link rel="stylesheet" href="templates/css/plugins.css" type="text/css">

    <link rel="icon" href="favicon.ico">

  </head>

  <body>

    <div class="container margin-top-container mainmswarea">

      <form method="post" action="#">
      <div class="row">
        <div class="col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <span style="float:right"><i class="fa fa-lock fa-fw"></i></span>
              <h3 class="panel-title">- <?php echo $msw_adm_header; ?> -</h3>
            </div>
            <div class="panel-body">
              <fieldset>
                <div class="form-group">
                  <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                    <input class="form-control" type="text" name="usr" placeholder="<?php echo mswSH($msw_adm_login); ?>" onkeypress="if(mswKC(event)==13){mswEnter()}" value="" autofocus>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                    <input class="form-control" type="password" name="pw" placeholder="<?php echo mswSH($msw_adm_login2); ?>" onkeypress="if(mswKC(event)==13){mswEnter()}" value="" autocomplete="off">
                  </div>
                </div>
                <?php
                // Is cookie set?
                if (ENABLE_LOGIN_COOKIE) {
                ?>
                <div class="form-group">
                  <div class="checkbox">
                    <label>&nbsp;&nbsp;<input type="checkbox" name="rm" value="1"> <?php echo mswSH($msw_adm_login3); ?></label>
                  </div>
                </div>
                <?php
                }
                ?>
                <button class="btn btn-lg btn-success btn-block" type="button" onclick="mswEnter()"><i class="fa fa-sign-in fa-fw"></i> <?php echo $msw_adm_login4; ?></button>
              </fieldset>
            </div>
          </div>
        </div>
      </div>
      </form>

    </div>

    <script src="templates/js/jquery.js"></script>
    <script src="templates/js/bootstrap.js"></script>
    <script src="templates/js/plugins/jquery.bootbox.js"></script>
    <script src="templates/js/functions.js"></script>
    <script src="templates/js/ops.js"></script>

    <?php
    // Action spinner, DO NOT REMOVE
    ?>
    <div class="overlaySpinner" style="display:none"></div>

  </body>

</html>
