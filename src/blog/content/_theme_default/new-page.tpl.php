<?php if(!defined('PARENT')) { exit; }

/* PAGE TEMPLATE
----------------------------------*/

?>

    <div class="row">
      <div class="col-lg-9 col-md-8">
        <div class="panel panel-default newpagearea">
          <div class="panel-heading">
            <i class="fa fa-file-text-o fa-fw"></i> <?php echo $this->PDATA['name']; ?>
          </div>
          <div class="panel-body">
            <?php
            echo $this->PDATA['info'];
            ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4">
        <?php
        include(dirname(__file__) . '/right-panel.tpl.php');
        ?>
      </div>
    </div>


