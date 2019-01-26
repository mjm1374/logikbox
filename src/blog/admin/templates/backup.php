<?php if(!defined('PARENT')) { exit; }
$backupSize = 0;
$mswDB = $DB->db_schema();
?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-database fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_backup; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_backup2; ?></span></a></li>
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
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th><?php echo $msw_adm_backup3; ?></th>
                      <th><?php echo $msw_adm_backup4; ?></th>
                      <th><?php echo $msw_adm_backup5; ?></th>
                      <th><?php echo $msw_adm_backup7; ?></th>
                      <th><?php echo $msw_adm_backup8; ?></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $q = $DB->db_query("SHOW TABLE STATUS FROM `" . DB_NAME . "`");
                  while ($SCHEMA = $DB->db_fetch_assoc($q)) {
                    if (in_array($SCHEMA['Name'], $mswDB)) {
                      $size   = ($SCHEMA['Rows'] > 0 ? $SCHEMA['Data_length'] + $SCHEMA['Index_length'] : '0');
                      $utTS   = strtotime($SCHEMA['Update_time']);
                      ?>
                      <tr>
                       <td><?php echo $SCHEMA['Name']; ?></td>
                       <td><?php echo $SCHEMA['Rows']; ?></td>
                       <td><?php echo ($SCHEMA['Rows'] > 0 ? mswFCNV($size) : '0'); ?></td>
                       <td><?php echo $DT->display($SETTINGS, $utTS); ?></td>
                       <td><?php echo $SCHEMA['Engine']; ?></td>
                      </tr>
                      <?php
                      $backupSize = ($backupSize + $size);
                    }
                  }
                  ?>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_backup10; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[download]" value="yes" checked="checked"> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[download]" value="no"> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_backup12; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[compress]" value="yes" checked="checked"> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[compress]" value="no"> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_backup11; ?></label>
                  <input type="text" class="form-control" name="fm[emails]" value="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="act-button">
      <button type="button" class="btn btn-success" onclick="mswAction('<?php echo  $cmd; ?>')"><i class="fa fa-download fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_backup13; ?> (<?php echo $msw_adm_backup9; ?>: <?php echo mswFCNV($backupSize); ?>)</span></button>
    </div>
    </form>
