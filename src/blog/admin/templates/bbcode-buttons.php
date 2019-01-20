<?php if (!defined('PARENT')) { exit; }
if (defined('BB_BOX2')) {
  $box = BB_BOX2;
}
if (defined('BB_BOX')) {
  $box = BB_BOX;
}
?>
<div class="bbButtons">
  <button class="btn btn-info btn-sm" type="button" onclick="mswBB('bold','<?php echo $box; ?>')"><i class="fa fa-bold fa-fw"></i></button>
  <button class="btn btn-info btn-sm" type="button" onclick="mswBB('italic','<?php echo $box; ?>')"><i class="fa fa-italic fa-fw"></i></button>
  <button class="btn btn-info btn-sm" type="button" onclick="mswBB('underline','<?php echo $box; ?>')"><i class="fa fa-underline fa-fw"></i></button>
  <button class="btn btn-info btn-sm" type="button" onclick="mswBB('url','<?php echo $box; ?>')"><i class="fa fa-link fa-fw"></i></button>
  <button class="btn btn-info btn-sm" type="button" onclick="mswBB('email','<?php echo $box; ?>')"><i class="fa fa-envelope-o fa-fw"></i></button>
  <div class="mobilebreakpoint">
   <button class="btn btn-info btn-sm" type="button" onclick="mswBB('img','<?php echo $box; ?>')"><i class="fa fa-picture-o fa-fw"></i></button>
   <button class="btn btn-info btn-sm" type="button" onclick="mswBB('youtube','<?php echo $box; ?>')"><i class="fa fa-youtube fa-fw"></i></button>
   <button class="btn btn-info btn-sm" type="button" onclick="mswBB('vimeo','<?php echo $box; ?>')"><i class="fa fa-play fa-fw"></i></button>
   <button class="btn btn-success btn-sm" type="button" onclick="window.open('index.php?p=bb','_blank')"><i class="fa fa-question fa-fw"></i></button>
  </div>
</div>