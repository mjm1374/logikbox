<?php

if (!defined('PARENT') || !isset($cmd)) { exit; }

/* STAFF DEPENDENCIES
------------------------------------*/

if (isset($ED->type)) {
?>
<script>
jQuery(document).ready(function() {
  mswTyp('<?php echo $ED->type; ?>');
});
</script>
<?php
}

?>