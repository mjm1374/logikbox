<?php if(!defined('PARENT')) { exit; } ?>

    <nav class="pushy pushy-left">
      <div class="pushy-content">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <?php
          $defMenuPanel = DEF_OPEN_MENU_PANEL;
          // Main panels..
          // array = name, font awesome icon name
          foreach (array_keys($mswSysLinks) AS $pK) {
            $hasSub = 0;
            if (in_array($mswUser[1], array('global','admin'))) {
              $hasSub = 2;
            } else {
              if (!empty($mswSysLinks[$pK]['links'])) {
                foreach ($mswSysLinks[$pK]['links'] AS $lK => $lV) {
                  if (mswPagePerms($lK, $mswUser) == 'yes') {
                    ++$hasSub;
                  }
                  if ($hasSub > 0) {
                    continue;
                  }
                }
              }
            }
            if ($SSN->active('adm_menu_panel') == 'yes') {
              $defMenuPanel = $SSN->get('adm_menu_panel');
            }
            if ($hasSub > 0) {
            ?>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="heading<?php echo $pK; ?>">
                <h4 class="panel-title">
                  <a<?php echo ($pK != $defMenuPanel ? ' class="collapsed" ' : ' '); ?>role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $pK; ?>" aria-expanded="<?php echo ($pK == $defMenuPanel ? 'true' : 'false'); ?>" onclick="mswPanel('<?php echo $pK; ?>')" aria-controls="collapse<?php echo $pK; ?>" title="<?php echo mswSH($mswSysLinks[$pK]['txt']); ?>">
                    <i class="fa fa-<?php echo $mswSysLinks[$pK]['icon']; ?> fa-fw"></i> <?php echo $mswSysLinks[$pK]['txt']; ?>
                  </a>
                </h4>
              </div>
              <div id="collapse<?php echo $pK; ?>" class="panel-collapse collapse<?php echo ($pK == $defMenuPanel ? ' in' : ''); ?>" role="tabpanel" aria-labelledby="heading<?php echo $pK; ?>">
                <div class="panel-body">
                  <?php
                  if (!empty($mswSysLinks[$pK]['links'])) {
                    foreach ($mswSysLinks[$pK]['links'] AS $lK => $lV) {
                      if (in_array($mswUser[1], array('global','admin')) || mswPagePerms($lK, $mswUser) == 'yes') {
                      ?>
                      <div><a href="?p=<?php echo $lK; ?>" title="<?php echo mswSH($lV); ?>"><i class="fa fa-angle-right"></i> <?php echo $lV; ?></a></div>
                      <?php
                      }
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
            <?php
            }
          }

          ?>
        </div>
      </div>
    </nav>

    <div class="site-overlay"></div>