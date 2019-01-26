<?php if(!defined('PARENT')) { exit; } ?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-pencil fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_settings; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-calendar fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_settings6; ?></span></a></li>
          <li><a href="#three" data-toggle="tab"><i class="fa fa-file-text-o fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_settings8; ?></span></a></li>
          <li><a href="#four" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_settings7; ?></span></a></li>
          <?php
          if (defined('LICENCE_VER') && LICENCE_VER == 'unlocked') {
          ?>
          <li><a href="#five" data-toggle="tab"><i class="fa fa-code fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_settings9; ?></span></a></li>
          <?php
          }
          ?>
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
                  <label><?php echo $msw_adm_settings2; ?></label>
                  <input type="text" class="form-control" name="fm[website]" value="<?php echo (isset($SETTINGS->website) ? mswSH($SETTINGS->website) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings3; ?></label>
                  <input type="text" class="form-control" name="fm[email]" value="<?php echo (isset($SETTINGS->email) ? mswSH($SETTINGS->email) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings5; ?></label>
                  <input type="text" class="form-control" name="fm[ifolder]" value="<?php echo (isset($SETTINGS->ifolder) ? mswSH($SETTINGS->ifolder) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings4; ?></label>
                  <select class="form-control" name="fm[language]">
                  <?php
                  if (is_dir(REL_PATH . 'content/language')) {
                    $dir = opendir(REL_PATH . 'content/language');
                    while (false!==($read=readdir($dir))) {
                      if (!in_array($read,array('.','..')) && is_dir(REL_PATH . 'content/language/' . $read)) {
                      ?>
                      <option value="<?php echo $read; ?>"<?php echo ($SETTINGS->language == $read ? ' selected="selected"' : ''); ?>><?php echo ucfirst($read); ?></option>
                      <?php
                      }
                    }
                    closedir($dir);
                  }
                  ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_settings10; ?></label>
                  <input type="text" class="form-control" name="fm[dateformat]" value="<?php echo (isset($SETTINGS->dateformat) ? mswSH($SETTINGS->dateformat) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings11; ?></label>
                  <input type="text" class="form-control" name="fm[timeformat]" value="<?php echo (isset($SETTINGS->timeformat) ? mswSH($SETTINGS->timeformat) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings12; ?></label>
                  <select class="form-control" name="fm[timezone]">
                  <?php
                  foreach ($timezones AS $tK => $tV) {
                  ?>
                  <option value="<?php echo $tK; ?>"<?php echo ($SETTINGS->timezone == $tK ? ' selected="selected"' : ''); ?>><?php echo $tV; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings13; ?></label>
                  <select class="form-control" name="fm[calformat]">
                  <?php
                  foreach ($jsCalFormat AS $jsV) {
                  ?>
                  <option value="<?php echo $jsV; ?>"<?php echo ($SETTINGS->calformat == $jsV ? ' selected="selected"' : ''); ?>><?php echo $jsV; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings14; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[weekstart]" value="sun"<?php echo (isset($SETTINGS->weekstart) && $SETTINGS->weekstart == 'sun' ? ' checked="checked"' : (!isset($SETTINGS->weekstart) ? ' checked="checked"' : '')); ?>> <?php echo $msw_adm_settings15; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[weekstart]" value="mon"<?php echo (isset($SETTINGS->weekstart) && $SETTINGS->weekstart == 'mon' ? ' checked="checked"' : ''); ?>> <?php echo $msw_adm_settings16; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="three">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_settings17; ?></label>
                  <input type="text" class="form-control" name="fm[metad]" value="<?php echo (isset($SETTINGS->metad) ? mswSH($SETTINGS->metad) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings18; ?></label>
                  <input type="text" class="form-control" name="fm[metak]" value="<?php echo (isset($SETTINGS->metak) ? mswSH($SETTINGS->metak) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings19; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[modr]" value="yes"<?php echo (isset($SETTINGS->modr) && $SETTINGS->modr == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[modr]" value="no"<?php echo (isset($SETTINGS->modr) && $SETTINGS->modr == 'no' ? ' checked="checked"' : (!isset($SETTINGS->modr) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="four">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_settings30; ?></label>
                  <select name="fm[cats][]" class="form-control" multiple="multiple">
                  <?php
                  $defCats = explode(',', $SETTINGS->defcats);
                  $Q  = $DB->db_query("SELECT `id`,`title` FROM `" . DB_PREFIX . "categories` WHERE `en` = 'yes' ORDER BY `ordr`");
                  while ($C = $DB->db_object($Q)) {
                  ?>
                  <option value="<?php echo $C->id; ?>"<?php echo (in_array($C->id, $defCats) ? ' selected="selected"' : ''); ?>><?php echo mswSH($C->title); ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings31; ?></label>
                  <div class="form-group input-group">
                    <span class="input-group-addon"><a href="#" onclick="mswKey();return false"><i class="fa fa-key fa-fw"></i></a></span>
                    <input type="text" class="form-control" name="fm[apikey]" maxlength="100" value="<?php echo (isset($SETTINGS->apikey) ? mswSH($SETTINGS->apikey) : ''); ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings32; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[apilog]" value="yes"<?php echo (isset($SETTINGS->apilog) && $SETTINGS->apilog == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[apilog]" value="no"<?php echo (isset($SETTINGS->apilog) && $SETTINGS->apilog == 'no' ? ' checked="checked"' : (!isset($SETTINGS->apilog) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings20; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[cache]" value="yes"<?php echo (isset($SETTINGS->cache) && $SETTINGS->cache == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[cache]" value="no"<?php echo (isset($SETTINGS->cache) && $SETTINGS->cache == 'no' ? ' checked="checked"' : (!isset($SETTINGS->cache) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings21; ?></label>
                  <select name="fm[cachetime]" class="form-control">
                  <?php
                  foreach (
                    array(
                      0 => $msw_adm_settings22,
                      30 => '30 ' . $msw_adm_settings23,
                      60 => '1 ' . $msw_adm_settings25,
                      120 => '2 ' . $msw_adm_settings33,
                      240 => '4 ' . $msw_adm_settings33,
                      360 => '6 ' . $msw_adm_settings33,
                      1440 => $msw_adm_settings24,
                      4320 => $msw_adm_settings34,
                      10080 => $msw_adm_settings35
                    ) AS $ctk => $ctv) {
                  ?>
                  <option value="<?php echo $ctk; ?>"<?php echo ($SETTINGS->cachetime == $ctk ? ' selected="selected"' : ''); ?>><?php echo $ctv; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <?php
          if (defined('LICENCE_VER') && LICENCE_VER == 'unlocked') {
          ?>
          <div class="tab-pane fade" id="five">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_settings26; ?></label>
                  <textarea class="form-control" name="fm[pfoot]" rows="5" cols="20"><?php echo (isset($SETTINGS->pfoot) ? mswSH($SETTINGS->pfoot) : ''); ?></textarea>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_settings27; ?></label>
                  <textarea class="form-control" name="fm[afoot]" rows="5" cols="20"><?php echo (isset($SETTINGS->afoot) ? mswSH($SETTINGS->afoot) : ''); ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <div class="act-button">
      <button type="button" class="btn btn-success" onclick="mswAction('<?php echo  $cmd; ?>')"><i class="fa fa-check fa-fw"></i> <span class="hidden-xs"><?php echo $msw_common5; ?></span></button>
    </div>
    </form>
