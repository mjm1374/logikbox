<?php if(!defined('PARENT')) { exit; } ?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-pencil fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_staff; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-user fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_staff11; ?></span></a></li>
          <li><a href="#three" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_staff2; ?></span></a></li>
          <li><a href="#four" data-toggle="tab"><i class="fa fa-cogs fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_staff16; ?></span></a></li>
          <li><a href="#five" data-toggle="tab"><i class="fa fa-file-text-o fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_staff19; ?></span></a></li>
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
                  <label><?php echo $msw_adm_staff4; ?></label>
                  <input type="text" class="form-control" name="fm[name]" value="<?php echo (isset($ED->name) ? mswSH($ED->name) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_staff5; ?></label>
                  <input type="text" class="form-control" name="fm[email]" value="<?php echo (isset($ED->email) ? mswSH($ED->email) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_staff10; ?></label>
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
                  <label><?php echo $msw_adm_staff9; ?></label>
                  <input type="text" class="form-control" name="fm[user]" value="<?php echo (isset($ED->user) ? mswSH($ED->user) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_staff7; ?> <span id="passPreview">&nbsp;</span></label>
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
          <div class="tab-pane fade" id="three">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_staff12; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[type]" onclick="mswTyp('admin')" value="admin"<?php echo (isset($ED->type) && $ED->type == 'admin' ? ' checked="checked"' : (!isset($ED->type) ? ' checked="checked"' : '')); ?>> <?php echo $msw_adm_staff14; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[type]" onclick="mswTyp('restricted')" value="restricted"<?php echo (isset($ED->type) && $ED->type == 'restricted' ? ' checked="checked"' : ''); ?>> <?php echo $msw_adm_staff15; ?></label>
                  </div>
                </div>
                <div class="form-group" id="paccess"<?php echo (isset($ED->type) && $ED->type == 'admin' ? ' style="display:none"' : (!isset($ED->type) ? ' style="display:none"' : '')); ?>>
                  <label><?php echo $msw_adm_staff13; ?></label>
                  <select class="form-control" name="fm[perms][]" multiple="multiple">
                  <?php
                  foreach (array_keys($mswSysLinks) AS $pAK) {
                  ?>
                  <optgroup label="<?php echo mswSH($mswSysLinks[$pAK]['txt']); ?>">
                  <?php
                  foreach ($mswSysLinks[$pAK]['links'] AS $pAKL => $pAKV) {
                  ?>
                  <option value="<?php echo $pAKL; ?>"<?php echo (isset($ePerms) && in_array($pAKL, $ePerms) ? ' selected="selected"' : ''); ?>><?php echo mswSH($pAKV); ?></option>
                  <?php
                  }
                  ?>
                  </optgroup>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_staff21; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[jrest]" value="yes"<?php echo (isset($ED->jrest) && $ED->jrest == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[jrest]" value="no"<?php echo (isset($ED->jrest) && $ED->jrest == 'no' ? ' checked="checked"' : (!isset($ED->jrest) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="four">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_staff17; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[tweet]" value="yes"<?php echo (isset($ED->tweet) && $ED->tweet == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="fm[tweet]" value="no"<?php echo (isset($ED->tweet) && $ED->tweet == 'no' ? ' checked="checked"' : (!isset($ED->tweet) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_staff18; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[delp]" value="yes"<?php echo (isset($ED->delp) && $ED->delp == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="fm[delp]" value="no"<?php echo (isset($ED->delp) && $ED->delp == 'no' ? ' checked="checked"' : (!isset($ED->delp) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_staff26; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[notify]" value="yes"<?php echo (isset($ED->notify) && $ED->notify == 'yes' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="fm[notify]" value="no"<?php echo (isset($ED->notify) && $ED->notify == 'no' ? ' checked="checked"' : (!isset($ED->notify) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="five">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <textarea class="form-control" name="fm[notes]" rows="5" cols="20"><?php echo (isset($ED->notes) ? mswSH($ED->notes) : ''); ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="act-button">
      <button type="button" class="btn btn-success" onclick="mswAction('<?php echo  $cmd . (isset($ED->id) ? '-edit' : ''); ?>')"><i class="fa fa-<?php echo (isset($ED->id) ? 'check' : 'plus'); ?> fa-fw"></i> <span class="hidden-xs"><?php echo (isset($ED->id) ? $msw_common5 : $msw_adm_staff3); ?></span></button>
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
    $Q  = $DB->db_query("SELECT SQL_CALC_FOUND_ROWS `id`,`name`,`email` FROM `" . DB_PREFIX . "staff` ORDER BY `name` LIMIT " . $limit . "," . DEF_PER_PAGE);
    $NR = $DB->db_foundrows($Q);
    ?>
    <div class="managepanel">
      <form method="post" action="#">
      <div class="panel panel-default managearea<?php echo (mswOptPerms('delp', $mswUser) == 'no' ? ' nodelperms' : ''); ?>">
        <div class="panel-heading">
          <i class="fa fa-list fa-fw<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' cursorp' : ''); ?>"<?php echo (mswOptPerms('delp', $mswUser) == 'yes' ? ' onclick="mswSC(\'.managearea .table td\',\'delb\')"' : ''); ?>></i> <?php echo $msw_adm_staff6; ?> (<?php echo mswNFM($NR); ?>)
        </div>
        <div class="panel-body">
          <div class="table-responsive">
           <table class="table table-striped table-hover">
             <tbody>
               <?php
               if ($NR > 0) {
                 while ($S = $DB->db_object($Q)) {
                 ?>
                 <tr id="idr_<?php echo $S->id; ?>">
                   <?php
                   if (mswOptPerms('delp', $mswUser) == 'yes') {
                   ?>
                   <td><input type="checkbox" name="fm[id][]" value="<?php echo $S->id; ?>" onclick="mswSCG('.managearea .table td','delb')"></td>
                   <?php
                   }
                   ?>
                   <td><?php echo mswSH($S->name); ?><span class="smalldata"><?php echo mswSH($S->email); ?></span></td>
                   <td><?php echo $msw_adm_staff20 . ': ' . $S->id; ?></td>
                   <td><a href="?p=<?php echo $cmd; ?>&amp;id=<?php echo $S->id; ?>" title="<?php echo mswSH($msw_common4); ?>"><i class="fa fa-pencil-square fa-2x fa-fw"></i></a></td>
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