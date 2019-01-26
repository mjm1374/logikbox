<?php if(!defined('PARENT')) { exit; }

/* OFF CANVAS MENU
-------------------------------------*/

?>

    <nav class="pushy pushy-left">
      <div class="pushy-content">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

          <?php
          /* PANEL ONE - CATEGORIES
          ------------------------------------------------*/
          ?>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" onclick="mswNavState('0')" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-folder fa-fw"></i> <?php echo $this->TEXT[0]; ?>
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse<?php echo $this->NAV_STATE[0]; ?>" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <?php
                // html/nav-link.htm
                echo $this->NAV_CATEGORIES;
                ?>
              </div>
            </div>
          </div>

          <?php
          /* PANEL TWO - PAGES (if enabled)
          ------------------------------------------------*/
          if ($this->NAV_PAGES) {
          ?>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" onclick="mswNavState('1')" aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fa fa-file-text fa-fw"></i> <?php echo $this->TEXT[2]; ?>
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse<?php echo $this->NAV_STATE[1]; ?>" role="tabpanel" aria-labelledby="headingTwo">
              <div class="panel-body">
                <?php
                // html/nav-link.htm
                echo $this->NAV_PAGES;
                ?>
              </div>
            </div>
          </div>
          <?php
          }

          /* PANEL THREE - ARCHIVE
          ------------------------------------------------*/
          ?>

          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" onclick="mswNavState('2')" aria-expanded="false" aria-controls="collapseThree">
                  <i class="fa fa-clock-o fa-fw"></i> <?php echo $this->TEXT[1]; ?>
                </a>
              </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse<?php echo $this->NAV_STATE[2]; ?>" role="tabpanel" aria-labelledby="headingThree">
              <div class="panel-body">
                <?php
                // html/nav-link.htm
                echo $this->NAV_ARCHIVE;
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="site-overlay"></div>