<?php if(!defined('PARENT')) { exit; }
$catProtected = mswCTPR($DB);
$lastYear = $DT->totime('last year');
include(PATH . 'control/classes/class.graph.php');
$G = new graph();
$G->years = array(date('Y', $lastYear), date('Y', $DT->ts()));
$G->dt = $DT;
$gDisplay = $G->display();
?>

    <div class="row">
      <div class="col-lg-8 col-md-7">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-bar-chart fa-fw"></i> <?php echo str_replace(array('{lastyear}','{year}'),array(date('Y', $lastYear),date('Y', $DT->ts())),$msw_adm_dashboard2); ?>
          </div>
          <div class="panel-body msw-graph">
            <div class="ct-chart"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-5">
        <div class="form-group">
          <form method="get" action="index.php" id="sform">
          <input type="hidden" name="p" value="manage">
          <div class="form-group">
            <div class="form-group input-group">
             <input type="text" class="form-control" name="q" placeholder="<?php echo mswSH($msw_adm_dashboard4); ?>">
             <span class="input-group-addon"><i class="fa fa-search fa-fw cursorp" onclick="mswSubmit('sform','q');return false"></i></span>
            </div>
          </div>
          </form>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <?php echo $msw_adm_dashboard3; ?>
            <span class="logged"><i class="fa fa-user fa-fw"></i> <?php echo mswSH($mswUser[0]); ?></span>
            <?php
            if (defined('DEV_BETA') && DEV_BETA != 'no') {
              $betaActive = 'yes';
            }
            if (ENABLE_VERSION_CHECK && !isset($betaActive) && in_array($mswUser[1], array('global','admin'))) {
            ?>
            <hr>
            <i class="fa fa-check fa-fw"></i> <?php echo $msw_adm_dashboard5; ?> v<?php echo $SETTINGS->version; ?><br>
            <i class="fa fa-refresh fa-fw"></i> <a href="#" onclick="mswAction('vc');return false" title="<?php echo mswSH($msw_adm_dashboard6); ?>"><?php echo $msw_adm_dashboard6; ?></a>
            <?php
            }
            ?>
          </div>
        </div>
        <?php
        // Show for beta ONLY..
        if (defined('DEV_BETA') && DEV_BETA != 'no') {
        ?>
        <div class="alert alert-warning" style="border-width:2px">
          <span class="pull-right"><i class="fa fa-flask fa-fw"></i></span>
          <b>BETA VERSION</b>
          <hr>
          <i class="fa fa-hourglass fa-fw"></i> Currently at beta: <?php echo DEV_BETA; ?><br>
          <i class="fa fa-calendar fa-fw"></i> Beta Expiry: <?php echo date('j M Y', strtotime(DEV_BETA_EXP)); ?>
          <hr>
          <i class="fa fa-arrow-right fa-fw"></i> <a href="https://www.maianbeta.com/weblog/" onclick="window.open(this);return false">View Beta Forum</a>
        </div>
        <?php
        }

        if (mswPagePerms('add', $mswUser) == 'yes') {
        ?>
        <div style="margin-bottom: 20px" class="dashbuttons">
          <button class="btn btn-info btn-lg btn-block" type="button" onclick="mswWin('add')"><i class="fa fa-plus-circle fa-fw"></i> <?php echo $msw_adm_dashboard7; ?></button>
        </div>
        <?php
        }
        ?>
     </div>
    </div>

    <?php
    // Check permissions to add/edit journals..
    // If no, don`t show edit link..
    $perms = 'yes';
    if (!in_array($mswUser[1], array('global','admin'))) {
      if (mswPagePerms('add', $mswUser) == 'no') {
        $perms = 'no';
      }
    }
    // Can logged in user only view his own journals?
    $where = '';
    if ($mswUser[1] != 'global' && isset($mswUser[2]['id']) && mswOptPerms('jrest', $mswUser) == 'yes') {
      $where = 'WHERE `staff` = \'' . (int) $mswUser[2]['id'] . '\'';
    }
    $Q  = $DB->db_query("SELECT * FROM `" . DB_PREFIX . "journals` $where ORDER BY `addts` DESC LIMIT " . LATEST_DASHBOARD_JOURNALS);
    $NR = $DB->db_foundrows($Q);
    ?>
    <div class="panel panel-default managearea nodelperms">
      <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> <?php echo str_replace('{count}',LATEST_DASHBOARD_JOURNALS,$msw_adm_dashboard); ?>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <tbody>
              <?php
              if ($NR > 0) {
                while ($J = $DB->db_object($Q)) {
                ?>
                <tr>
                  <td><?php echo mswSH($J->title); ?></td>
                  <?php
                  if ($perms == 'yes') {
                  ?>
                  <td><a href="?p=add&amp;id=<?php echo $J->id; ?>&amp;rdr=dashboard" title="<?php echo mswSH($msw_common4); ?>"><i class="fa fa-pencil-square fa-2x fa-fw"></i></a></td>
                  <?php
                  }
                  ?>
                </tr>
                <tr>
                  <td colspan="4" class="smallbar">
                    <span class="pull-left">
                      <?php
                      if ($J->user && $J->pass) {
                      ?>
                      <span class="setopt" title="<?php echo mswSH($msw_adm_manage13); ?>">
                        <i class="fa fa-lock fa-fw"></i>
                      </span>
                      <?php
                      } else {
                        if (in_array($J->id, $catProtected)) {
                        ?>
                        <span class="setopt" title="<?php echo mswSH($msw_adm_manage16); ?>">
                          <i class="fa fa-lock fa-fw privatecat"></i>
                        </span>
                        <?php
                        }
                      }
                      if ($J->stick == 'yes') {
                      ?>
                      <span class="setopt" title="<?php echo mswSH($msw_adm_manage14); ?>">
                        <i class="fa fa-thumb-tack fa-fw"></i>
                      </span>
                      <?php
                      }
                      if ($J->encomms == 'yes') {
                      ?>
                      <span class="setopt" title="<?php echo mswSH($msw_adm_manage15); ?>">
                        <i class="fa fa-commenting fa-fw"></i>
                      </span>
                      <?php
                      }
                      ?>
                    </span>
                    <?php
                    if ($J->delts > 0) {
                    ?>
                    <span class="info"><i class="fa fa-minus-circle fa-fw" title="<?php echo mswSH($msw_adm_manage4); ?>"></i> <?php echo $DT->display($SETTINGS, $J->delts, DT_DIVIDER); ?></span>
                    <?php
                    }
                    ?>
                    <span class="info"><i class="fa fa-calendar fa-fw" title="<?php echo mswSH($msw_adm_manage3); ?>"></i> <?php echo $DT->display($SETTINGS, $J->pubts, DT_DIVIDER); ?></span>
                    <span class="info"><i class="fa fa-check fa-fw" title="<?php echo mswSH($msw_adm_manage2); ?>"></i> <?php echo $DT->display($SETTINGS, $J->addts, DT_DIVIDER); ?></span>
                  </td>
                </tr>
                <?php
                }
              } else {
                include(PATH . 'templates/no-data.php');
              }
              ?>
             </tbody>
           </table>
         </div>
        </div>
    </div>


