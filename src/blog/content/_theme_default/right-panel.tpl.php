<?php if(!defined('PARENT')) { exit; }

/* LOAD BOXES
-----------------------------------------------*/

?>
<div class="right-panel-boxes">
<?php
if (!empty($this->BOXES)) {
  for ($i=0; $i<count($this->BOXES); $i++) {
    switch($this->BOXES[$i]['type']) {
      // Standard template..
      // html/box.htm
      case 'standard':
        echo $this->BOXES[$i]['box'];
        break;
      // Custom template..
      // custom-templates/box_*.tpl.php
      case 'custom':
        include(dirname(__file__) . '/custom-templates/' . $this->BOXES[$i]['box']);
        break;
    }
  }
}

?>
</div>