<?php if (!defined('PARENT')) { exit; } ?>

<div class="container mainmswarea">

  <div class="row">

    <div class="col-lg-12">

      <h1><i class="fa fa-cog fa-fw"></i><span class="hidden-xs"> <?php echo SCRIPT_NAME; ?></span> Installer</h1>

      <hr>

    </div>

  </div>

</div>

<div id="formarea">

  <form method="post" action="#">
  <div class="container ops">

    <div class="row">

      <div class="col-lg-12">

        <?php
        if (!defined('DB_HOST') || !defined('DB_USER') || !defined('DB_PASS') || !defined('DB_NAME') || !defined('DB_PREFIX')
           || !defined('DB_CHAR_SET') || !defined('DB_LOCALE') || !defined('SECRET_KEY')) {
        ?>
        <div class="panel panel-danger">
          <div class="panel-heading">
            <i class="fa fa-warning fa-fw"></i> Database Connection File - Fatal Error
          </div>
          <div class="panel-body">
          One or more constants have been edited incorrectly in the following file:<br><br>
          <b>control/connect.php</b><br><br>
          Please try again using the notes in that file as a reference. Once you have corrected the errors, refresh page.
          </div>
        </div>
        <?php
        } elseif (phpVersion() < MSW_PHP_MIN_VER) {
        ?>
        <div class="panel panel-danger">
          <div class="panel-heading">
            <i class="fa fa-warning fa-fw"></i> PHP Version Error
          </div>
          <div class="panel-body">
          Your PHP version is too old and <?php echo SCRIPT_NAME; ?> cannot run on this server.<br><br>
          The required minimum version is <b>PHP<?php echo MSW_PHP_MIN_VER; ?></b>, your version is <b>PHP<?php echo phpVersion(); ?></b><br><br>
          Please update your PHP installation to continue.<br><br>
          Thank you.
          </div>
        </div>
        <?php
        } elseif (!defined('LIC_DEV') && SECRET_KEY == 'maian-blog-system') {
        ?>
        <div class="panel panel-danger">
          <div class="panel-heading">
            <i class="fa fa-warning fa-fw"></i> Error
          </div>
          <div class="panel-body">
          This is important!!<br><br>
          As per the installation instructions, you <b>MUST</b> rename the <b>SECRET_KEY</b> value in the 'control/connect.php' file for security.<br><br>
          This is used as a security key / salt to help protect your system. Try and make the key as difficult as possible for better security.<br><br>
          Once you are done, refresh this page.<br><br>
          Thank you.
          </div>
        </div>
        <?php
        } else {
        ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-chevron-right fa-fw"></i> Database Connection
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>DB Host</th>
                  <th>DB User</th>
                  <th>DB Pass</th>
                  <th>DB Name</th>
                  <th>Table Prefix</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo DB_HOST; ?></td>
                  <td><?php echo DB_USER; ?></td>
                  <td><?php echo DB_PASS; ?></td>
                  <td><?php echo DB_NAME; ?></td>
                  <td><?php echo DB_PREFIX; ?></td>
                </tr>
              </tbody>
              </table>
            </div>
            Connection File: <b>control/connect.php</b>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-chevron-right fa-fw"></i> Required Modules
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
              <tbody>
                <?php
                for ($i=0; $i<count($modules); $i++) {
                ?>
                <tr>
                  <td style="border:0"><?php echo $modules[$i][0]; ?></td>
                  <td style="border:0">
                  <?php
                  switch($modules[$i][2]) {
                    case 'function':
                      if (function_exists($modules[$i][1])) {
                        echo '<i class="fa fa-check fa-fw msw_green"></i>';
                      } else {
                        echo '<i class="fa fa-times fa-fw msw_red"></i>';
                        ++$count;
                      }
                      break;
                    case 'class':
                      if (class_exists($modules[$i][1])) {
                        echo '<i class="fa fa-check fa-fw msw_green"></i>';
                      } else {
                        echo '<i class="fa fa-times fa-fw msw_red"></i>';
                        ++$count;
                      }
                      break;
                  }
                  ?>
                  </td>
                  <td style="border:0" class="text-right"><a href="<?php echo $modules[$i][3]; ?>" onclick="window.open(this);return false"><i class="fa fa-info-circle fa-fw"></i></a></td>
                </tr>
                <?php
                }
                ?>
              </tbody>
              </table>
            </div>
            Missing modules must be installed before you can continue.
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-chevron-right fa-fw"></i> Permissions
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
              <tbody>
                <?php
                for ($i=0; $i<count($permissions); $i++) {
                ?>
                <tr>
                  <td style="border:0"><?php echo $permissions[$i]; ?></td>
                  <td style="border:0" class="text-right">
                  <?php
                  if (is_writeable(REL_PATH . $permissions[$i])) {
                    echo '<i class="fa fa-check fa-fw msw_green"></i>';
                  } else {
                    echo '<i class="fa fa-times fa-fw msw_red"></i>';
                    ++$count;
                  }
                  ?>
                  </td>
                </tr>
                <?php
                }
                ?>
              </tbody>
              </table>
            </div>
            Above directories must have read/write permissions. Example: 0755 or 0777.
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-chevron-right fa-fw"></i> Collation / Character Set / Engine
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
              <tbody>
                <tr>
                  <td style="border:0">
                  <select name="charset" class="form-control">
                  <?php
                  if (!empty($cSets)) {
                    foreach ($cSets AS $set) {
                    ?>
                    <option value="<?php echo $set; ?>"<?php echo ($set == $defChar ? ' selected="selected"' : ''); ?>><?php echo $set; ?></option>
                    <?php
                    }
                  } else {
                    ?>
                    <option value="<?php echo $defChar; ?>" selected="selected"><?php echo $defChar; ?></option>
                    <?php
                  }
                  ?>
                  </select>
                  </td>
                </tr>
                <tr>
                  <td style="border:0">
                  <select name="engine" class="form-control">
                    <option value="MyISAM">MyISAM</option>
                    <option value="InnoDB">InnoDB</option>
                  </select>
                  </td>
                </tr>
              </tbody>
              </table>
            </div>
            MySQL Version: <b><?php echo $sqlVer; ?></b> / If you aren`t sure of this, leave as default.
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-chevron-right fa-fw"></i> Timezone
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
              <tbody>
                <tr>
                  <td style="border:0">
                  <select name="timezone" class="form-control">
                  <?php
                  foreach ($timezones AS $tzk => $tz) {
                  ?>
                  <option value="<?php echo $tzk; ?>"<?php echo (function_exists('date_default_timezone_get') && @date_default_timezone_get() == $tzk ? ' selected="selected"' : ($tzk == 'Europe/London' ? ' selected="selected"' : '')); ?>><?php echo $tz; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                  </td>
                </tr>
              </tbody>
              </table>
            </div>
            Can be changed later via admin control panel.
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-chevron-right fa-fw"></i> Demo
          </div>
          <div class="panel-body">
            Do you want to install the demo system?<br><br>
            <input type="checkbox" name="demo" value="yes">
          </div>
        </div>

        <div class="text-center buttonarea">
          <button class="btn btn-success" type="button" onclick="mswIns()"><i class="fa fa-check fa-fw"></i> Install</button>
        </div>
        <?php
        }
        ?>

      </div>

    </div>

  </div>
  </form>

</div>