<?php if(!defined('PARENT')) { exit; } ?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-pencil fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_offline; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-calendar fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_offline2; ?></span></a></li>
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
                  <label><?php echo $msw_adm_offline3; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[sysstatus]" value="yes"<?php echo ($SETTINGS->sysstatus == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[sysstatus]" value="no"<?php echo ($SETTINGS->sysstatus == 'no' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_offline4; ?></label>
                  <?php
                  if (EN_BB) {
                    $box = 'reason';
                    include(PATH . 'templates/bbcode-buttons.php');
                  }
                  ?>
                  <textarea class="form-control" id="reason" name="fm[reason]" rows="5" cols="20"><?php echo (isset($SETTINGS->reason) ? mswSH($SETTINGS->reason) : ''); ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_offline5; ?></label>
                  <input type="text" class="form-control mswdatepicker" name="fm[autoenable]" value="<?php echo $DT->converter($SETTINGS->autoenable, true); ?>">
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