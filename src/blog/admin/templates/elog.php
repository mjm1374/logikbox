<?php if(!defined('PARENT')) { exit; }

    $QE  = $DB->db_query("SELECT SQL_CALC_FOUND_ROWS *,
          `" . DB_PREFIX . "elog`.`user` AS `usrID`,
          `" . DB_PREFIX . "elog`.`id` AS `elogID`
          FROM `" . DB_PREFIX . "elog`
          LEFT JOIN `" . DB_PREFIX . "staff`
          ON `" . DB_PREFIX . "elog`.`user` = `" . DB_PREFIX . "staff`.`id`
          " . (isset($_GET['u']) ? 'WHERE `' . DB_PREFIX . 'elog`.`user` = \'' . (int) $_GET['u'] . '\'' : '') . "
          ORDER BY `" . DB_PREFIX . "elog`.`ts` DESC
          LIMIT $limit," . DEF_PER_PAGE);
    $NR = $DB->db_foundrows($QE);

    if ($NR > 0) {
    ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-chevron-down fa-fw"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="#" onclick="mswAction('elog-exp<?php echo (isset($_GET['u']) ? '&amp;u=' . (int) $_GET['u'] : ''); ?>');return false"><i class="fa fa-download fa-fw"></i> <?php echo $msw_adm_elog2; ?></a></li>
            <?php
            if (mswOptPerms('delp', $mswUser) == 'yes') {
            ?>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="mswAction('elog-clear','.managepanel','no','yes');return false"><i class="fa fa-trash fa-fw"></i> <?php echo $msw_adm_elog5; ?></a></li>
            <?php
            }
            ?>
            <li role="separator" class="divider"></li>
            <li<?php echo (!isset($_GET['u']) ? ' class="active"' : ''); ?>><a href="?p=<?php echo $cmd; ?>"><i class="fa fa-refresh fa-fw"></i> <?php echo $msw_adm_elog7; ?></a></li>
            <?php
            if (defined('USERNAME')) {
            ?>
            <li<?php echo (isset($_GET['u']) && $_GET['u'] == 0 ? ' class="active"' : ''); ?>><a href="?p=<?php echo $cmd; ?>&amp;u=0"><i class="fa fa-user fa-fw"></i> <?php echo mswSH(USERNAME); ?></a></li>
            <?php
            }
            $Q  = $DB->db_query("SELECT `id`,`name` FROM `" . DB_PREFIX . "staff` ORDER BY `name`");
            while ($S = $DB->db_object($Q)) {
            ?>
            <li<?php echo (isset($_GET['u']) && $_GET['u'] == $S->id ? ' class="active"' : ''); ?>><a href="?p=<?php echo $cmd; ?>&amp;u=<?php echo $S->id; ?>"><i class="fa fa-user fa-fw"></i> <?php echo mswSH($S->name); ?></a></li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
    <?php
    }
    ?>

    <div class="managepanel" style="margin-top: 10px">
      <form method="post" action="#">
      <div class="panel panel-default managearea<?php echo (mswOptPerms('delp', $mswUser) == 'no' ? ' nodelperms' : ''); ?>">
        <div class="panel-heading">
          <i class="fa fa-list fa-fw<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' cursorp' : ''); ?>"<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' onclick="mswSC(\'.managearea .table td\',\'delb\')"' : ''); ?>></i> <?php echo $msw_adm_elog; ?> (<?php echo mswNFM($NR); ?>)
        </div>
        <div class="panel-body">
          <div class="table-responsive">
           <table class="table table-striped table-hover">
             <tbody>
               <?php
               if ($NR > 0) {
                 while ($L = $DB->db_object($QE)) {
                 ?>
                 <tr id="idr_<?php echo $L->elogID; ?>">
                   <?php
                   if (mswOptPerms('delp', $mswUser) == 'yes') {
                   ?>
                   <td><input type="checkbox" name="fm[id][]" value="<?php echo $L->elogID; ?>" onclick="mswSCG('.managearea .table td','delb')"></td>
                   <?php
                   }
                   ?>
                   <td><?php echo mswSH(($L->usrID == 0 ? (defined('USERNAME') ? USERNAME : $msw_adm_elog6) : $L->name)); ?></td>
                   <td><?php echo mswIPList($L->ip); ?></td>
                   <td><?php echo $DT->display($SETTINGS, $L->ts, DT_DIVIDER); ?></td>
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
         <?php
         // Pagination..
         if ($NR > DEF_PER_PAGE) {
           $PGS = new pages(array(
             'count' => $NR,
             'text' => $msw_pages,
             'page' => $page,
             'admin' => 'yes',
             'flag' => '',
             'limit' => 0,
             's' => $SETTINGS
           ));
           echo $PGS->display();
         }
         ?>
        </div>
      </div>
      <?php
      if (mswOptPerms('delp', $mswUser) == 'yes' && $NR > 0) {
      ?>
      <div class="act-button">
        <button type="button" class="btn btn-danger disabled" id="delb" onclick="if(jQuery(this).attr('class')!='btn btn-danger disabled'){mswAction('<?php echo $cmd; ?>-del','.managepanel','no','yes')}"><i class="fa fa-times fa-fw"></i> <span class="hidden-xs"><?php echo $msw_common3; ?></span></button>
      </div>
      <?php
      }
      ?>
      </form>
    </div>
