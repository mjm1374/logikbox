<?php if(!defined('PARENT')) { exit; }
$catProtected = mswCTPR($DB);
$where = '';
$orderBy = 'ORDER BY FIELD(`stick`,\'yes\',\'no\'),`pubts`';
if (isset($_GET['f'])) {
  switch($_GET['f']) {
    case 'deleting':
      $where = 'WHERE `delts` > 0 ';
      break;
    case 'unpublished':
      $where = 'WHERE (`pubts` > `addts`) AND (`pubts` > \'' . $DT->ts() . '\') ';
      break;
    case 'private':
      $where = 'WHERE ((`user` != \'\' AND `pass` != \'\') OR `id` IN (' . implode(',', $catProtected) . ')) ';
      break;
    case 'disabled':
      $where = 'WHERE `en` = \'no\' ';
      break;
  }
}
if (isset($_GET['q']) && $_GET['q']) {
  // Fix for fulltext search 3 character limitation..
  if (strlen($_GET['q']) > 3 && FULLTEXT_SEARCH) {
    $where .= ($where ? ' AND (' : 'WHERE ('). 'MATCH(`title`) AGAINST(\'' . mswSQL($_GET['q'])  . '*\' IN BOOLEAN MODE) OR MATCH(`comms`) AGAINST(\'' . mswSQL($_GET['q'])  . '*\' IN BOOLEAN MODE)) ';
  } else {
    $where .= ($where ? ' AND (' : 'WHERE ('). '`title` LIKE \'%' . mswSQL($_GET['q'])  . '%\' OR `comms` LIKE \'' . mswSQL($_GET['q'])  . '\') ';
  }
}
if (isset($_GET['fd'], $_GET['td']) && $_GET['fd'] && $_GET['td']) {
  $f_ts = $DT->jstots($_GET['fd']);
  $t_ts = $DT->jstots($_GET['td']);
  if ($f_ts > 0 && $t_ts > 0) {
    $where .= ($where ? ' AND (' : 'WHERE ('). '`pubts` >= \'' . $f_ts . '\' AND `pubts` <= \'' . $t_ts . '\') ';
  }
}
if ($mswUser[1] != 'global' && isset($mswUser[2]['id']) && mswOptPerms('jrest', $mswUser) == 'yes') {
  $where .= ($where ? ' AND (' : 'WHERE ('). '`staff` = \'' . (int) $mswUser[2]['id'] . '\')';
}
$Q  = $DB->db_query("SELECT SQL_CALC_FOUND_ROWS * FROM `" . DB_PREFIX . "journals` $where $orderBy DESC LIMIT " . $limit . "," . DEF_PER_PAGE);
$NR = $DB->db_foundrows($Q);
?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-chevron-down fa-fw"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="?p=add"><i class="fa fa-plus fa-fw"></i> <?php echo $msw_adm_manage7; ?></a></li>
            <li><a href="#" onclick="mswSB('.searchpanel','show');mswSB('.arcpanel','hide');return false"><i class="fa fa-search fa-fw"></i> <?php echo $msw_adm_manage5; ?></a></li>
            <li><a href="#" onclick="mswSB('.arcpanel','show');mswSB('.searchpanel','hide');return false"><i class="fa fa-calendar fa-fw"></i> <?php echo $msw_adm_manage9; ?></a></li>
            <li role="separator" class="divider"></li>
            <li<?php echo (isset($_GET['f']) && $_GET['f'] == 'deleting' ? ' class="active"' : ''); ?>><a href="?p=<?php echo $cmd; ?>&amp;f=deleting"><i class="fa fa-angle-right fa-fw"></i> <?php echo $msw_adm_manage10; ?></a></li>
            <li<?php echo (isset($_GET['f']) && $_GET['f'] == 'unpublished' ? ' class="active"' : ''); ?>><a href="?p=<?php echo $cmd; ?>&amp;f=unpublished"><i class="fa fa-angle-right fa-fw"></i> <?php echo $msw_adm_manage11; ?></a></li>
            <li<?php echo (isset($_GET['f']) && $_GET['f'] == 'private' ? ' class="active"' : ''); ?>><a href="?p=<?php echo $cmd; ?>&amp;f=private"><i class="fa fa-angle-right fa-fw"></i> <?php echo $msw_adm_manage12; ?></a></li>
            <li<?php echo (isset($_GET['f']) && $_GET['f'] == 'disabled' ? ' class="active"' : ''); ?>><a href="?p=<?php echo $cmd; ?>&amp;f=disabled"><i class="fa fa-angle-right fa-fw"></i> <?php echo $msw_adm_manage21; ?></a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="managepanel arcpanel" style="margin-top:10px;display:none">
      <form method="get" action="index.php">
      <div class="panel panel-default managearea">
        <input type="hidden" name="p" value="<?php echo $cmd; ?>">
        <div class="panel-heading">
          <i class="fa fa-calendar fa-fw"></i> <?php echo $msw_adm_manage9; ?>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-calendar-check-o fa-fw"></i></span>
              <input type="text" class="form-control mswdatepicker" name="fd" value="<?php echo (isset($_GET['fd']) ? mswSH($_GET['fd']) : ''); ?>" placeholder="<?php echo mswSH($msw_adm_manage18); ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-calendar-check-o fa-fw"></i></span>
              <input type="text" class="form-control mswdatepicker" name="td" value="<?php echo (isset($_GET['td']) ? mswSH($_GET['fd']) : ''); ?>" placeholder="<?php echo mswSH($msw_adm_manage19); ?>">
            </div>
          </div>
          <div class="text-center" style="padding-bottom:20px">
            <button class="btn btn-success" type="submit"><i class="fa fa-check fa-fw"></i><span class="hidden-xs"> <?php echo $msw_adm_manage20; ?></span></button>
            <button class="btn btn-default" type="button" onclick="mswSB('.arcpanel','hide')"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">  <?php echo $msw_adm_manage8; ?></span></button>
          </div>
        </div>
      </div>
      </form>
    </div>

    <div class="managepanel searchpanel" style="margin-top:10px;display:none">
      <form method="get" action="index.php">
      <div class="panel panel-default managearea">
        <input type="hidden" name="p" value="<?php echo $cmd; ?>">
        <div class="panel-heading">
          <i class="fa fa-search fa-fw"></i> <?php echo $msw_adm_manage5; ?>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <div class="form-group input-group">
              <input type="text" class="form-control" name="q" value="<?php echo (isset($_GET['q']) ? mswSH($_GET['q']) : ''); ?>" placeholder="<?php echo mswSH($msw_adm_manage6); ?>">
              <span class="input-group-addon"><i class="fa fa-times fa-fw cursorp" onclick="mswSB('.searchpanel','hide')" title="<?php echo mswSH($msw_adm_manage8); ?>"></i></span>
            </div>
          </div>
          <div class="text-center" style="padding-bottom:20px">
            <button class="btn btn-success" type="submit"><i class="fa fa-check fa-fw"></i><span class="hidden-xs"> <?php echo $msw_adm_manage20; ?></span></button>
            <button class="btn btn-default" type="button" onclick="mswSB('.searchpanel','hide')"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">  <?php echo $msw_adm_manage8; ?></span></button>
          </div>
        </div>
      </div>
      </form>
    </div>

    <div class="managepanel" style="margin-top:10px">
      <form method="post" action="#">
      <div class="panel panel-default managearea<?php echo (mswOptPerms('delp', $mswUser) == 'no' ? ' nodelperms' : ''); ?>">
        <div class="panel-heading">
          <i class="fa fa-list fa-fw<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' cursorp' : ''); ?>"<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' onclick="mswSC(\'.managearea .table td\',\'delb\')"' : ''); ?>></i> <?php echo $msw_adm_manage; ?> (<?php echo mswNFM($NR); ?>)
        </div>
        <div class="panel-body">
          <div class="table-responsive">
           <table class="table table-striped table-hover">
             <tbody>
               <?php
               if ($NR > 0) {
                 while ($J = $DB->db_object($Q)) {
                 ?>
                 <tr id="idr_<?php echo $J->id; ?>">
                   <?php
                   if (mswOptPerms('delp', $mswUser) == 'yes') {
                   ?>
                   <td><input type="checkbox" name="fm[id][]" value="<?php echo $J->id; ?>" onclick="mswSCG('.managearea .table td','delb')"></td>
                   <?php
                   }
                   ?>
                   <td><?php echo mswSH($J->title); ?></td>
                   <td><a href="?p=add&amp;id=<?php echo $J->id; ?>" title="<?php echo mswSH($msw_common4); ?>"><i class="fa fa-pencil-square fa-2x fa-fw"></i></a></td>
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
                     <span class="info"><i class="fa fa-calendar-times-o fa-fw" title="<?php echo mswSH($msw_adm_manage4); ?>"></i> <?php echo $DT->display($SETTINGS, $J->delts, DT_DIVIDER); ?></span>
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
