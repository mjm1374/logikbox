<?php if(!defined('PARENT') || empty($this->BOXES)) { exit; }

/* CUSTOM TEMPLATE - RECENT JOURNALS
   You can use any element from the box array:

   print_r($this->BOXES[$i])

   Or manually add your own code.
-----------------------------------------------*/

?>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-<?php echo $this->BOXES[$i]['icon']; ?> fa-fw"></i> <?php echo $this->BOXES[$i]['title']; ?>
          </div>
          <div class="panel-body">
            <?php
            // html/journal-link.htm
            echo $this->RECENT_JOURNALS;
            ?>
          </div>
        </div>