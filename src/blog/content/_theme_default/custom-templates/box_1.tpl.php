<?php if(!defined('PARENT')) { exit; }

/* CUSTOM BOX TEMPLATE - EXAMPLE
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
            Lorem ipsum dolor sit amet consectetuer quis est at felis dui.<br><br>Dictum vitae sollicitudin condimentum condimentum Vivamus.
            <?php
            // Code added via admin..
            echo $this->BOXES[$i]['info'];
            ?>
          </div>
        </div>