<?php if(!defined('PARENT')) { exit; }
define('MSWSORT', 1);
?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-pencil fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_cat8; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-file-text-o fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_cat5; ?></span></a></li>
          <li><a href="#three" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_cat10; ?></span></a></li>
          <li><a href="#four" data-toggle="tab"><i class="fa fa-cogs fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_cat19; ?></span></a></li>
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
                  <label><?php echo $msw_adm_cat; ?></label>
                  <input type="text" class="form-control" name="fm[title]" onkeyup="mswSlug('title')" value="<?php echo (isset($ED->title) ? mswSH($ED->title) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_cat2; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[en]" value="yes"<?php echo (isset($ED->en) && $ED->en == 'yes' ? ' checked="checked"' : (!isset($ED->en) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[en]" value="no"<?php echo (isset($ED->en) && $ED->en == 'no' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_cat6; ?></label>
                  <input type="text" class="form-control" name="fm[metat]" value="<?php echo (isset($ED->metat) ? mswSH($ED->metat) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_cat7; ?></label>
                  <input type="text" class="form-control" name="fm[slug]" value="<?php echo (isset($ED->slug) ? mswSH($ED->slug) : ''); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="three">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_cat11; ?></label>
                  <input type="text" class="form-control" name="fm[user]" value="<?php echo (isset($ED->user) ? mswSH($ED->user) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_cat12; ?> <span id="passPreview">&nbsp;</span></label>
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
                <div class="form-group">
                  <label><?php echo $msw_adm_cat25; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[display]" value="yes"<?php echo (isset($ED->display) && $ED->display == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[display]" value="no"<?php echo (isset($ED->display) && $ED->display == 'no' ? ' checked="checked"' : (!isset($ED->display) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="four">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_cat20; ?></label>
                  <input type="text" class="form-control mswdatepicker" name="fm[delts]" value="<?php echo (isset($ED->delts) ? $DT->converter($ED->delts) : ''); ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="act-button">
      <button type="button" class="btn btn-success" onclick="mswAction('<?php echo  $cmd . (isset($ED->id) ? '-edit' : ''); ?>')"><i class="fa fa-<?php echo (isset($ED->id) ? 'check' : 'plus'); ?> fa-fw"></i> <span class="hidden-xs"><?php echo (isset($ED->id) ? $msw_common5 : $msw_adm_cat3); ?></span></button>
      <?php
      if (isset($ED->id)) {
      ?>
      <input type="hidden" name="fm[id]" value="<?php echo $ED->id; ?>">
      <button type="button" class="btn btn-default left_20" onclick="mswWin('<?php echo $cmd; ?>')"><i class="fa fa-arrow-left fa-fw"></i> <span class="hidden-xs"><?php echo $msw_common6; ?></span></button>
      <?php
      }
      ?>
    </div>
    </form>

    <?php
    $Q  = $DB->db_query("SELECT SQL_CALC_FOUND_ROWS
          `id`,
          `title`,
          `user`,
          `pass`,
          `delts`,
          (SELECT count(*) FROM `" . DB_PREFIX . "cat_journal`
           WHERE `" . DB_PREFIX . "cat_journal`.`category` = `" . DB_PREFIX . "categories`.`id`
          ) AS `blogCnt`
          FROM `" . DB_PREFIX . "categories`
          ORDER BY `ordr`
          LIMIT " . $limit . "," . DEF_PER_PAGE);
    $NR = $DB->db_foundrows($Q);
    ?>
    <div class="managepanel">
      <form method="post" action="#">
      <div class="panel panel-default managearea<?php echo (mswOptPerms('delp', $mswUser) == 'no' ? ' nodelperms' : ''); ?>">
        <div class="panel-heading">
          <i class="fa fa-list fa-fw<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' cursorp' : ''); ?>"<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' onclick="mswSC(\'.managearea .table td\',\'delb\')"' : ''); ?>></i> <?php echo $msw_adm_cat4; ?> (<?php echo mswNFM($NR); ?>)
        </div>
        <div class="panel-body">
          <div class="table-responsive">
           <table class="table table-striped table-hover">
             <tbody id="mswsort">
               <?php
               if ($NR > 0) {
                 while ($C = $DB->db_object($Q)) {
                 $icons = '';
                 if ($C->user && $C->pass) {
                   $icons = ' <i class="fa fa-lock fa-fw" title="' . mswSH($msw_adm_cat10) . '"></i>';
                 }
                 if ($C->delts > 0) {
                   $icons .= ' <i class="fa fa-calendar-times-o fa-fw" title="' . mswSH($msw_adm_cat24) . ': ' . date($SETTINGS->dateformat, $C->delts) . ', ' . date($SETTINGS->timeformat, $C->delts) . '"></i>';
                 }
                 ?>
                 <tr id="idr_<?php echo $C->id; ?>">
                   <?php
                   if (mswOptPerms('delp', $mswUser) == 'yes') {
                   ?>
                   <td><input type="hidden" name="fm[sort][]" value="<?php echo $C->id; ?>"><input type="checkbox" name="fm[id][]" value="<?php echo $C->id; ?>" onclick="mswSCG('.managearea .table td','delb')"></td>
                   <?php
                   }
                   ?>
                   <td class="cursorm"><?php echo mswSH($C->title) . $icons; ?></td>
                   <td class="cursorm"><?php echo $msw_adm_cat21 . ': ' . $C->id; ?></td>
                   <td class="cursorm"><b><?php echo mswNFM($C->blogCnt); ?></b> <?php echo $msw_adm_cat13. (mswOptPerms('delp', $mswUser) == 'no' ? '<input type="hidden" name="fm[sort][]" value="' . $C->id . '">' : ''); ?></td>
                   <td><a href="?p=<?php echo $cmd; ?>&amp;id=<?php echo $C->id; ?>" title="<?php echo mswSH($msw_common4); ?>"><i class="fa fa-pencil-square fa-2x fa-fw"></i></a></td>
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