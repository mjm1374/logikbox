<?php if (!defined('PARENT')) { exit; } ?>

  <footer>
    <hr>
    <p class="text-center">
      <a href="https://www.<?php echo SCRIPT_URL; ?>" onclick="window.open(this);return false"><?php echo SCRIPT_NAME . '</a> v' . SCRIPT_VERSION; ?> &copy; <?php echo SCRIPT_RELEASE_YR . '-' . date('Y'); ?> <a href="https://www.maianscriptworld.co.uk" title="Maian Script World" onclick="window.open(this);return false">Maian Script World</a>. All Rights Reserved
    </p>
  </footer>

  <?php
  // Action spinner, DO NOT REMOVE
  ?>
  <div class="overlaySpinner" style="display:none"></div>

  <script src="content/js/jquery.js"></script>
  <script src="content/js/bootstrap.js"></script>
  <script src="content/js/js.js"></script>
  <script src="content/js/jquery.bootbox.js"></script>

  <?php
  if ($count> 0) {
  ?>
  <script>
  //<![CDATA[
  jQuery(document).ready(function() {
    jQuery('button[type="button"]').prop('disabled', true);
  });
  //]]>
  </script>
  <?php
  }
  ?>

  </body>
</html>
