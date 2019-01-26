<?php

if (!defined('PARENT') || !isset($cmd)) { exit; }

/* SORTING
   Only enabled for more than 1 tr row
------------------------------------------*/

?>
<script src="templates/js/plugins/sortable.js"></script>
<script>
//<![CDATA[
jQuery(document).ready(function() {
  var el = document.getElementById('mswsort');
  var tr = jQuery('#mswsort tr').length;
  if (tr > 1) {
    Sortable.create(el, {
      onEnd : function (evt) {
        mswAction('<?php echo $cmd; ?>-sort', '.managepanel', 'yes');
      }
    });
  }
});
//]]>
</script>