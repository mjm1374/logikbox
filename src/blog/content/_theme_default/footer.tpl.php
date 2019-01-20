<?php if(!defined('PARENT')) { exit; }

/* FOOTER TEMPLATE
----------------------------------*/

?>

    </div>

    <div class="footbar push">

      <div class="container">

        <div class="row">
          <div class="col-lg-7 col-md-7">
            <h2><?php echo $this->TEXT[3]; ?></h2>
            <?php
            // html/journal-link.htm
            echo $this->RECENT_JOURNALS;
            ?>
          </div>
          <div class="col-lg-5 col-md-5 social">
            <h2><?php echo $this->TEXT[4]; ?></h2>
            <div class="row">
              <?php
              // html/social/social-link.htm
              echo $this->SOCIAL;
              ?>
            </div>
          </div>
        </div>

      </div>

    </div>

    <footer class="push">
      <?php
      // Please do not change unless you have a commercial licence, thank you
      echo $this->FOOTER;
      ?>
    </footer>

    <?php
    // Nav menu..
    include(dirname(__file__) . '/nav-menu.php');
    ?>

    <script src="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>js/jquery.js"></script>
    <script src="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>js/bootstrap.js"></script>
    <script src="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>js/functions.js"></script>
    <script src="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>js/ops.js"></script>
    <script src="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>js/plugins/jquery.pushy.js"></script>
    <script src="<?php echo $this->META['basehref'] . $this->META['themefolder']; ?>js/plugins/jquery.bootbox.js"></script>

    <script>
    //<![CDATA[
    jQuery(document).ready(function() {
      mswCalOps('today', '<?php echo $this->TODAY; ?>');
      <?php
      // Auto focus login box. 500 millisecond pause because of menu..
      if (defined('LOGIN_SCREEN')) {
      ?>
      setTimeout(function() {
        jQuery('input[name="fm[usr]"]').focus();
      }, 500);
      <?php
      }
      ?>
    });
    //]]>
    </script>

    <?php
    // Loads page specific JS files.
    echo $this->MODULES;
    ?>

    <?php
    // Action spinner, DO NOT REMOVE
    ?>
    <div class="overlaySpinner" style="display:none"></div>

  </body>

</html>