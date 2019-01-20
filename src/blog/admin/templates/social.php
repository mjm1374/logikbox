<?php if(!defined('PARENT')) { exit; }
$params = $SOCIAL->params();
?>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-commenting-o fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_social; ?></span></a></li>
          <li><a href="#two" data-toggle="tab"><i class="fa fa-twitter fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_social2; ?></span></a></li>
          <li><a href="#three" data-toggle="tab"><i class="fa fa-link fa-fw"></i> <span class="hidden-xs"><?php echo $msw_adm_social3; ?></span></a></li>
          <li><a href="#four" data-toggle="tab"><i class="fa fa-cog"></i> <span class="hidden-xs"><?php echo $msw_adm_social4; ?></span></a></li>
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
                  <label><?php echo $msw_adm_social5; ?></label>
                  <input type="text" class="form-control" name="fm[disqus][disname]" value="<?php echo (isset($params['disqus']['disname']) ? mswSH($params['disqus']['disname']) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_social6; ?></label>
                  <input type="text" class="form-control" name="fm[disqus][discat]" value="<?php echo (isset($params['disqus']['discat']) ? mswSH($params['disqus']['discat']) : ''); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="two">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_social7; ?></label>
                  <input type="text" class="form-control" name="fm[twitter][conkey]" value="<?php echo (isset($params['twitter']['conkey']) ? mswSH($params['twitter']['conkey']) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_social8; ?></label>
                  <input type="password" class="form-control" name="fm[twitter][consecret]" value="<?php echo (isset($params['twitter']['consecret']) ? mswSH($params['twitter']['consecret']) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_social9; ?></label>
                  <input type="text" class="form-control" name="fm[twitter][token]" value="<?php echo (isset($params['twitter']['token']) ? mswSH($params['twitter']['token']) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_social10; ?></label>
                  <input type="password" class="form-control" name="fm[twitter][key]" value="<?php echo (isset($params['twitter']['key']) ? mswSH($params['twitter']['key']) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_social11; ?></label>
                  <input type="text" class="form-control" name="fm[twitter][username]" value="<?php echo (isset($params['twitter']['username']) ? mswSH($params['twitter']['username']) : ''); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="three">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="bxs">
                  <?php
                  if (!empty($params['links'])) {
                  foreach ($params['links'] AS $lK => $lV) {
                  ?>
                  <div class="form-group">
                    <div class="form-group input-group">
                      <span class="input-group-addon"><i class="fa fa-<?php echo $lK; ?> fa-fw"></i></span>
                      <input type="text" class="form-control" name="fm[links][<?php echo $lK; ?>]" value="<?php echo mswSH($lV); ?>">
                    </div>
                  </div>
                  <?php
                  }
                  } else {
                    echo '<p class="mswitalic"><i class="fa fa-warning fa-fw"></i> ' . $msw_adm_social19 . '</p>';
                  }
                  ?>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group input-group">
                      <span class="input-group-addon"><a href="https://fontawesome.com/v4.7.0/icons/" onclick="window.open(this);return false"><i class="fa fa-font-awesome fa-fw"></i></a></span>
                      <input type="text" class="form-control" name="fawe" value="" placeholder="<?php echo mswSH($msw_adm_social17); ?>">
                   </div>
                  </div>
                  <div class="col-lg-7 col-md-7">
                    <input type="text" class="form-control" name="flink" value="" placeholder="<?php echo mswSH($msw_adm_social18); ?>">
                  </div>
                  <div class="col-lg-1 col-md-1 text-right mobilemargin">
                    <button class="btn btn-success" type="button" onclick="mswLnk()"><i class="fa fa-plus fa-fw"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="four">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label><?php echo $msw_adm_social12; ?></label>
                  <input type="text" class="form-control" name="fm[addthis][code]" value="<?php echo (isset($params['addthis']['code']) ? mswSH($params['addthis']['code']) : ''); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_social13; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[struct][twitter]" value="yes"<?php echo (isset($params['struct']['twitter']) && $params['struct']['twitter'] == 'yes' ? ' checked="checked"' : (!isset($params['struct']['twitter']) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[struct][twitter]" value="no"<?php echo (isset($params['struct']['twitter']) && $params['struct']['twitter'] == 'no' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_social14; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[struct][fb]" value="yes"<?php echo (isset($params['struct']['fb']) && $params['struct']['fb'] == 'yes' ? ' checked="checked"' : (!isset($params['struct']['fb']) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[struct][fb]" value="no"<?php echo (isset($params['struct']['fb']) && $params['struct']['fb'] == 'no' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common2; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $msw_adm_social15; ?></label>
                  <div class="radio">
                    <label><input type="radio" name="fm[struct][google]" value="yes"<?php echo (isset($params['struct']['google']) && $params['struct']['google'] == 'yes' ? ' checked="checked"' : (!isset($params['struct']['google']) ? ' checked="checked"' : '')); ?>> <?php echo $msw_common; ?></label>
                  </div>
                  <div class="radio">
                   <label><input type="radio" name="fm[struct][google]" value="no"<?php echo (isset($params['struct']['google']) && $params['struct']['google'] == 'no' ? ' checked="checked"' : ''); ?>> <?php echo $msw_common2; ?></label>
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
    </div>
    </form>
