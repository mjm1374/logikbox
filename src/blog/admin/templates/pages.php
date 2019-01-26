<?php if(!defined('PARENT')) { exit; }
define('MSWSORT', 1);
?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-pencil fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_pages; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-file-text-o fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_pages2; ?></span></a></li>
          <li><a href="#three" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_pages3; ?></span></a></li>
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
                  <label><?php echo $msw_adm_pages4; ?></label>
                  <input type="text" class="form-control" name="fm[name]" onkeyup="mswSlug('name')" value="<?php echo (isset($ED->name) ? mswSH($ED->name) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_pages5; ?></label>
                  <?php
                  if (EN_BB) {
                    $box = 'info';
                    include(PATH . 'templates/bbcode-buttons.php');
                  }
                  ?>
                  <textarea class="form-control" id="info" name="fm[info]" rows="5" cols="20"><?php echo (isset($ED->info) ? mswSH($ED->info) : ''); ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_pages6; ?></label>
                  <input type="text" class="form-control" name="fm[metat]" value="<?php echo (isset($ED->metat) ? mswSH($ED->metat) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_pages7; ?></label>
                  <input type="text" class="form-control" name="fm[slug]" value="<?php echo (isset($ED->slug) ? mswSH($ED->slug) : ''); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="three">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_pages12; ?></label>
                  <select name="fm[tmp]" class="form-control">
                    <option value="">- - - - - - - - -</option>
                    <?php
                    if (is_dir(REL_PATH . THEME_FOLDER . '/custom-templates')) {
                      $dir = opendir(REL_PATH . THEME_FOLDER . '/custom-templates');
                      while (false !== ($read = readdir($dir))) {
                        if (substr($read, 0, 7) == 'custom_' && substr($read, -8) == '.tpl.php') {
                        ?>
                        <option value="<?php echo $read; ?>"<?php echo (isset($ED->tmp) && $ED->tmp == $read ? ' selected="selected"' : ''); ?>><?php echo $read; ?></option>
                        <?php
                        }
                      }
                      closedir($dir);
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_pages8; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[en]" value="yes"<?php echo (isset($ED->en) && $ED->en == 'yes' ? ' checked="checked"' : (!isset($ED->en) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[en]" value="no"<?php echo (isset($ED->en) && $ED->en == 'no' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_pages11; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[landing]" value="yes"<?php echo (isset($ED->landing) && $ED->landing == 'yes' ? ' checked="checked"' : (!isset($ED->landing) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[landing]" value="no"<?php echo (isset($ED->landing) && $ED->landing == 'no' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="act-button">
      <button type="button" class="btn btn-success" onclick="mswAction('<?php echo  $cmd . (isset($ED->id) ? '-edit' : ''); ?>')"><i class="fa fa-<?php echo (isset($ED->id) ? 'check' : 'plus'); ?> fa-fw"></i> <span class="hidden-xs"><?php echo (isset($ED->id) ? $msw_common5 : $msw_adm_pages9); ?></span></button>
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
    $Q  = $DB->db_query("SELECT SQL_CALC_FOUND_ROWS `id`,`name` FROM `" . DB_PREFIX . "pages` ORDER BY `ordr` LIMIT $limit," . DEF_PER_PAGE);
    $NR = $DB->db_foundrows($Q);
    ?>
    <div class="managepanel">
      <form method="post" action="#">
      <div class="panel panel-default managearea<?php echo (mswOptPerms('delp', $mswUser) == 'no' ? ' nodelperms' : ''); ?>">
        <div class="panel-heading">
          <i class="fa fa-list fa-fw<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' cursorp' : ''); ?>"<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' onclick="mswSC(\'.managearea .table td\',\'delb\')"' : ''); ?>></i> <?php echo $msw_adm_pages10; ?> (<?php echo mswNFM($NR); ?>)
        </div>
        <div class="panel-body">
          <div class="table-responsive">
           <table class="table table-striped table-hover">
             <tbody id="mswsort">
               <?php
               if ($NR > 0) {
                 while ($PG = $DB->db_object($Q)) {
                 ?>
                 <tr id="idr_<?php echo $PG->id; ?>">
                   <?php
                   if (mswOptPerms('delp', $mswUser) == 'yes') {
                   ?>
                   <td><input type="hidden" name="fm[sort][]" value="<?php echo $PG->id; ?>"><input type="checkbox" name="fm[id][]" value="<?php echo $PG->id; ?>" onclick="mswSCG('.managearea .table td','delb')"></td>
                   <?php
                   }
                   ?>
                   <td class="cursorm"><?php echo mswSH($PG->name). (mswOptPerms('delp', $mswUser) == 'no' ? '<input type="hidden" name="fm[sort][]" value="' . $PG->id . '">' : ''); ?></td>
                   <td><a href="?p=<?php echo $cmd; ?>&amp;id=<?php echo $PG->id; ?>" title="<?php echo mswSH($msw_common4); ?>"><i class="fa fa-pencil-square fa-2x fa-fw"></i></a></td>
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