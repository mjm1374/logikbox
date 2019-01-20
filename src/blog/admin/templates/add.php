<?php if(!defined('PARENT')) { exit; }
$sociallive = 'yes';
$params = $SOCIAL->params();
if (!isset($ID) && isset($params['twitter']['conkey'],$params['twitter']['consecret'],$params['twitter']['token'],$params['twitter']['key'])) {
  if ($params['twitter']['conkey'] == '' || $params['twitter']['consecret'] == '' || $params['twitter']['token'] == '' || $params['twitter']['key'] == '') {
    $sociallive = 'no';
  }
}
if (isset($ED->id)) {
  include(PATH . 'control/classes/class.journals.php');
  $JNLS  = new journal();
  $jCats = $JNLS->cats($ED->id);
} else {
  $jCats = ($SETTINGS->defcats ? explode(',', $SETTINGS->defcats) : array());
}
?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-pencil fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_add; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-file-text-o fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_add6; ?></span></a></li>
          <li><a href="#three" data-toggle="tab"><i class="fa fa-calendar fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_add7; ?></span></a></li>
          <li><a href="#four" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_add16; ?></span></a></li>
          <li><a href="#five" data-toggle="tab"><i class="fa fa-cogs fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_add8; ?></span></a></li>
          <?php
          if (mswOptPerms('tweet', $mswUser) == 'yes' && $sociallive == 'yes' && !isset($ID)) {
          ?>
          <li><a href="#six" data-toggle="tab"><i class="fa fa-twitter fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_add20; ?></span></a></li>
          <?php
          } else {
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
                  <label><?php echo $msw_adm_add2; ?></label>
                  <input type="text" class="form-control" name="fm[title]" onkeyup="mswSlug('title')" value="<?php echo (isset($ED->title) ? mswSH($ED->title) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_add3; ?></label>
                  <?php
                  if (EN_BB) {
                    $box = 'comms';
                    include(PATH . 'templates/bbcode-buttons.php');
                  }
                  ?>
                  <textarea class="form-control" id="comms" name="fm[comms]" rows="5" cols="20"><?php echo (isset($ED->comms) ? mswSH($ED->comms) : ''); ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_add11; ?></label>
                  <select name="fm[cats][]" class="form-control" multiple="multiple">
                  <?php
                  $Q  = $DB->db_query("SELECT `id`,`title` FROM `" . DB_PREFIX . "categories` WHERE `en` = 'yes' ORDER BY `ordr`");
                  while ($C = $DB->db_object($Q)) {
                  ?>
                  <option value="<?php echo $C->id; ?>"<?php echo (in_array($C->id, $jCats) ? ' selected="selected"' : ''); ?>><?php echo mswSH($C->title); ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_add9; ?></label>
                  <input type="text" class="form-control" name="fm[metat]" value="<?php echo (isset($ED->metat) ? mswSH($ED->metat) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_add10; ?></label>
                  <input type="text" class="form-control" name="fm[slug]" value="<?php echo (isset($ED->slug) ? mswSH($ED->slug) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msg_adm_add25; ?></label>
                  <input type="text" class="form-control" name="fm[tags]" value="<?php echo (isset($ED->tags) ? mswSH($ED->tags) : ''); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="three">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_add5; ?></label>
                  <input type="text" class="form-control mswdatepicker" name="fm[pubts]" value="<?php echo (isset($ED->pubts) ? $DT->converter($ED->pubts, true) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_add12; ?></label>
                  <input type="text" class="form-control mswdatepicker" name="fm[delts]" value="<?php echo (isset($ED->delts) ? $DT->converter($ED->delts, true) : ''); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="four">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_add17; ?></label>
                  <input type="text" class="form-control" name="fm[user]" value="<?php echo (isset($ED->user) ? mswSH($ED->user) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_add18; ?> <span id="passPreview">&nbsp;</span></label>
                  <div class="form-group input-group">
                    <span class="input-group-addon"><a href="#" onclick="mswPass();return false"><i class="fa fa-key fa-fw"></i></a></span>
                    <input type="password" class="form-control" name="fm[pass]" onkeyup="mswClr()" value="">
                    <?php
                    if (isset($ED->pass)) {
                    ?>
                    <input type="hidden" name="fm[curpass]" value="<?php echo (isset($ED->pass) ? mswSH($ED->pass) : ''); ?>">
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="five">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_add13; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[en]" value="yes"<?php echo (isset($ED->en) && $ED->en == 'yes' ? ' checked="checked"' : (!isset($ED->en) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="fm[en]" value="no"<?php echo (isset($ED->en) && $ED->en == 'no' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_add14; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[encomms]" value="yes"<?php echo (isset($ED->encomms) && $ED->encomms == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="fm[encomms]" value="no"<?php echo (isset($ED->encomms) && $ED->encomms == 'no' ? ' checked="checked"' : (!isset($ED->encomms) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_add15; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[stick]" value="yes"<?php echo (isset($ED->stick) && $ED->stick == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="fm[stick]" value="no"<?php echo (isset($ED->stick) && $ED->stick == 'no' ? ' checked="checked"' : (!isset($ED->stick) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
          if (mswOptPerms('tweet', $mswUser) == 'yes' && $sociallive == 'yes' && !isset($ID)) {
          ?>
          <div class="tab-pane fade" id="six">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msg_adm_add21; ?></label>
                  <textarea class="form-control" name="fm[tweet]" rows="5" cols="20"></textarea>
                  <?php
                  if (isset($params['twitter']['username']) && $params['twitter']['username']) {
                  ?>
                  <span class="help-block"><a href="<?php echo str_replace('{user}',mswSH($params['twitter']['username']),TWITTER_LNK); ?>" onclick="window.open(this);return false"><i class="fa fa-twitter fa-fw"></i></a></span>
                  <?php
                  }
                  ?>
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
      <button type="button" class="btn btn-success" onclick="mswAction('<?php echo $cmd . (isset($ED->id) ? '-edit' : ''); ?>')"><i class="fa fa-<?php echo (isset($ED->id) ? 'check' : 'plus'); ?> fa-fw"></i> <span class="hidden-xs"><?php echo (isset($ED->id) ? $msw_common5 : $msw_adm_add4); ?></span></button>
      <?php
      if (isset($ED->id)) {
      ?>
      <input type="hidden" name="fm[id]" value="<?php echo $ED->id; ?>">
      <button type="button" class="btn btn-default left_20" onclick="mswWin('<?php echo (isset($_GET['rdr']) ? mswSH($_GET['rdr']) : $cmd); ?>')"><i class="fa fa-arrow-left fa-fw"></i> <span class="hidden-xs"><?php echo $msw_common6; ?></span></button>
      <?php
      }
      ?>
    </div>
    </form>
