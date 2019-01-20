<?php if(!defined('PARENT')) { exit; } ?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_themes; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-picture-o fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_themes2; ?></span></a></li>
        </ul>
      </div>
    </div>

    <form method="post" action="#">
    <div class="row formarea">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="tab-content">
          <div class="tab-pane active in" id="one">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_themes3; ?></label>
                  <select name="fm[theme]" class="form-control">
                    <?php
                    if (is_dir(REL_PATH . 'content')) {
                      $dir = opendir(REL_PATH . 'content');
                      while (false !== ($read = readdir($dir))) {
                        if (is_dir(REL_PATH . 'content/' . $read) && substr($read, 0, 6) == '_theme') {
                        ?>
                        <option value="<?php echo $read; ?>"<?php echo ($SETTINGS->theme == $read ? ' selected="selected"' : ''); ?>><?php echo $read; ?></option>
                        <?php
                        }
                      }
                      closedir($dir);
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_themes8; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[entheme]" value="yes"<?php echo ($SETTINGS->entheme == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="fm[entheme]" value="no"<?php echo ($SETTINGS->entheme == 'no' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body themearea">
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th><b><?php echo $msw_adm_themes4; ?></b></th>
                      <th><b><?php echo $msw_adm_themes5; ?></b></th>
                      <th><b><?php echo $msw_adm_themes6; ?></b></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $Q  = $DB->db_query("SELECT * FROM `" . DB_PREFIX . "themes` ORDER BY `id`");
                    $NR = $DB->db_rows($Q);
                    if ($NR > 0) {
                    while ($TH = $DB->db_object($Q)) {
                    ?>
                    <tr>
                      <td><input type="text" class="form-control mswdatepicker" name="fm[from][]" value="<?php echo $DT->converter($TH->from); ?>"></td>
                      <td><input type="text" class="form-control mswdatepicker" name="fm[to][]" value="<?php echo $DT->converter($TH->to); ?>"></td>
                      <td>
                      <select name="fm[thm][]" class="form-control">
                        <option value="">- - - - - - - -</option>
                        <?php
                        if (is_dir(REL_PATH . 'content')) {
                          $dir = opendir(REL_PATH . 'content');
                          while (false !== ($read = readdir($dir))) {
                            if (is_dir(REL_PATH . 'content/' . $read) && substr($read, 0, 6) == '_theme' && $read != $SETTINGS->theme) {
                            ?>
                            <option value="<?php echo $read; ?>"<?php echo ($TH->theme == $read ? ' selected="selected"' : ''); ?>><?php echo $read; ?></option>
                            <?php
                            }
                          }
                          closedir($dir);
                        }
                        ?>
                      </select>
                      </td>
                    </tr>
                    <?php
                    }
                    } else {
                    ?>
                    <tr>
                      <td><input type="text" class="form-control mswdatepicker" name="fm[from][]" value=""></td>
                      <td><input type="text" class="form-control mswdatepicker" name="fm[to][]" value=""></td>
                      <td>
                      <select name="fm[thm][]" class="form-control">
                        <option value="none">- - - - - - - -</option>
                        <?php
                        if (is_dir(REL_PATH . 'content')) {
                          $dir = opendir(REL_PATH . 'content');
                          while (false !== ($read = readdir($dir))) {
                            if (is_dir(REL_PATH . 'content/' . $read) && substr($read, 0, 6) == '_theme' && $read != $SETTINGS->theme) {
                            ?>
                            <option value="<?php echo $read; ?>"><?php echo $read; ?></option>
                            <?php
                            }
                          }
                          closedir($dir);
                        }
                        ?>
                      </select>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                  </table>
                </div>
                <hr style="margin:0 0 10px 0">
                <div class="text-right">
                  <button class="btn btn-xs btn-success" type="button" onclick="mswThmBox('true','<?php echo $SETTINGS->calformat; ?>','<?php echo ($SETTINGS->weekstart == 'sun' ? 0 : 1); ?>','<?php echo $mswPick['lang']; ?>','<?php echo $mswPick['time']; ?>','hh:ii')"><i class="fa fa-plus fa-fw"></i></button>
                  <button class="btn btn-xs btn-info" type="button" onclick="mswRemBox('theme')"><i class="fa fa-minus fa-fw"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="act-button">
      <button type="button" class="btn btn-success" onclick="mswAction('<?php echo  $cmd; ?>')"><i class="fa fa-check fa-fw"></i> <span class="hidden-xs"><?php echo $msw_common5; ?></span></button>
    </div>
    </form>