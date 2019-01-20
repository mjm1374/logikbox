<?php if(!defined('PARENT')) { exit; }

/* DASHBOARD TEMPLATE
----------------------------------*/

?>

    <div class="row">
      <div class="col-lg-9 col-md-8">

        <?php
        // JOURNALS
        // html/journal.htm
        // html/private-journal.htm
        if ($this->JOURNALS) {
          echo $this->JOURNALS;
        } else {
        ?>
        <div class="panel panel-default">
          <div class="panel-body">
            <i class="fa fa-warning fa-fw"></i> <?php echo $this->TEXT[0]; ?>
          </div>
        </div>
        <?php
        }

        ?>

      </div>
      <div class="col-lg-3 col-md-4">
        <?php
        include(dirname(__file__) . '/right-panel.tpl.php');
        ?>
      </div>
    </div>


