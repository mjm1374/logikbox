<?php if(!defined('PARENT')) { exit; }
$jCats = ($SETTINGS->defcats ? explode(',', $SETTINGS->defcats) : array());
?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab" onclick="mswINP('staff', 'fm[import]')"><i class="fa fa-users fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_export; ?></span></a></li>
          <li><a href="#two" data-toggle="tab" onclick="mswINP('journals', 'fm[import]')"><i class="fa fa-pencil fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_export2; ?></span></a></li>
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
                  <div class="checkbox">
                    <label><input type="checkbox" name="fm[name]" value="yes" checked="checked"> <?php echo $msw_adm_export4; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="checkbox">
                    <label><input type="checkbox" name="fm[email]" value="yes" checked="checked"> <?php echo $msw_adm_export5; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="checkbox">
                    <label><input type="checkbox" name="fm[user]" value="yes" checked="checked"> <?php echo $msw_adm_export6; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_export7; ?></label>
                  <input type="text" class="form-control mswdatepicker" name="fm[from]" value="">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_export8; ?></label>
                  <input type="text" class="form-control mswdatepicker" name="fm[to]" value="">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_export9; ?></label>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="act-button">
      <input type="hidden" name="fm[import]" value="staff">
      <button type="button" class="btn btn-success" onclick="mswAction('<?php echo  $cmd; ?>')"><i class="fa fa-download fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_export3; ?></span></button>
    </div>
    </form>
