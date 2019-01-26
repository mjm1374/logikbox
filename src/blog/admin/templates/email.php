<?php if(!defined('PARENT')) { exit; } ?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-pencil fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_email; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-envelope-o fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_email2; ?></span></a></li>
          <li><a href="#three" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_email3; ?></span></a></li>
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
                  <label><?php echo $msw_adm_email4; ?></label>
                  <input type="text" class="form-control" name="fm[smtp_host]" value="<?php echo (isset($SETTINGS->smtp_host) ? mswSH($SETTINGS->smtp_host) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_email5; ?></label>
                  <input type="text" class="form-control" name="fm[smtp_port]" value="<?php echo (isset($SETTINGS->smtp_port) ? mswSH($SETTINGS->smtp_port) : '587'); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_email6; ?></label>
                  <input type="text" class="form-control" name="fm[smtp_user]" value="<?php echo (isset($SETTINGS->smtp_user) ? mswSH($SETTINGS->smtp_user) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_email7; ?></label>
                  <input type="password" class="form-control" name="fm[smtp_pass]" value="<?php echo (isset($SETTINGS->smtp_pass) ? mswSH($SETTINGS->smtp_pass) : ''); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_email8; ?></label>
                  <input type="text" class="form-control" name="fm[smtp_from]" value="<?php echo (isset($SETTINGS->smtp_from) ? mswSH($SETTINGS->smtp_from) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_email9; ?></label>
                  <input type="text" class="form-control" name="fm[smtp_email]" value="<?php echo (isset($SETTINGS->smtp_email) ? mswSH($SETTINGS->smtp_email) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_email10; ?></label>
                  <input type="text" class="form-control" name="fm[smtp_rfrom]" value="<?php echo (isset($SETTINGS->smtp_rfrom) ? mswSH($SETTINGS->smtp_rfrom) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_email11; ?></label>
                  <input type="text" class="form-control" name="fm[smtp_remail]" value="<?php echo (isset($SETTINGS->smtp_remail) ? mswSH($SETTINGS->smtp_remail) : ''); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="three">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_email12; ?></label>
                  <select class="form-control" name="fm[smtp_security]">
                  <?php
                  foreach (array('','tls','ssl') AS $smsc){
                  ?>
                  <option value="<?php echo $smsc; ?>"<?php echo ($SETTINGS->smtp_security == $smsc ? ' selected="selected"' : ''); ?>><?php echo ($smsc ? strtoupper($smsc) : '&nbsp;'); ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_email15; ?></label>
                  <input type="text" class="form-control" name="fm[addemails]" value="<?php echo (isset($SETTINGS->addemails) ? mswSH($SETTINGS->addemails) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_email13; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[smtp_debug]" value="yes"<?php echo (isset($SETTINGS->smtp_debug) && $SETTINGS->smtp_debug == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[smtp_debug]" value="no"<?php echo (isset($SETTINGS->smtp_debug) && $SETTINGS->smtp_debug == 'no' ? ' checked="checked"' : (!isset($SETTINGS->smtp_debug) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="act-button">
      <button type="button" class="btn btn-success" onclick="mswAction('<?php echo  $cmd; ?>')"><i class="fa fa-check fa-fw"></i> <span class="hidden-xs"><?php echo $msw_common5; ?></span></button>
      <button class="btn btn-info left_20" onclick="mswMail()" type="button"><i class="fa fa-envelope fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_email14; ?></span></button>
    </div>
    </form>
