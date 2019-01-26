<?php if(!defined('PARENT')) { exit; } ?>

    </div>

    <footer class="push">
      <?php
      // Please do not change unless you have a commercial licence, thank you
      echo $footer;
      ?>
    </footer>

    <?php
    // Nav menu..
    include(PATH . 'templates/nav-menu.php');
    ?>

    <script src="templates/js/jquery.js"></script>
    <?php
    if (in_array('jq-ui', $fjs)) {
    ?>
    <script src="templates/js/jquery-ui.js"></script>
    <?php
    }
    ?>
    <script src="templates/js/bootstrap.js"></script>
    <script src="templates/js/functions.js"></script>
    <script>
    //<![CDATA[
    var mswlang = {
      aus : '<?php echo mswJSClean($msw_common9); ?>'
    }
    //]]>
    </script>
    <script src="templates/js/ops.js"></script>
    <script src="templates/js/plugins/jquery.pushy.js"></script>
    <script src="templates/js/plugins/jquery.bootbox.js"></script>

    <?php
    if (in_array('datepicker', $fjs) && isset($mswPick['lang'])) {
    ?>
    <script src="templates/js/plugins/jquery.datepicker.js"></script>
    <script src="templates/js/plugins/i18n/datepicker.<?php echo $mswPick['lang']; ?>.js"></script>
    <script>
    //<![CDATA[
    jQuery(document).ready(function() {
      jQuery('.mswdatepicker').datepicker({
        autoClose : true,
        dateFormat : '<?php echo $SETTINGS->calformat; ?>',
        firstDay : <?php echo ($SETTINGS->weekstart == 'sun' ? 0 : 1); ?>,
        language : '<?php echo $mswPick['lang']; ?>',
        timepicker : <?php echo $mswPick['time']; ?>,
        timeFormat : 'hh:ii'
      });
    });
    //]]>
    </script>
    <?php
    }
    if (in_array('textarea', $fjs)) {
    ?>
    <script src="templates/js/plugins/jquery.textareafullscreen.js"></script>
    <script>
    //<![CDATA[
    jQuery(document).ready(function() {
      jQuery('textarea').textareafullscreen({
        overlay   : true,
        maxWidth  : '80%',
        maxHeight : '80%'
      });
    });
    //]]>
    </script>
    <?php
    }
    // Chartist..
    if (in_array('chartist', $fjs)) {
    ?>
    <script src="templates/js/plugins/chartist.js"></script>
    <script>
    //<![CDATA[
    new Chartist.Line('.ct-chart', {
      labels : <?php echo $msw_graph; ?>,
      series : [
        [<?php echo $gDisplay[0]; ?>],
        [<?php echo $gDisplay[1]; ?>]
      ]
    }, {
      fullWidth : true,
      chartPadding: {
        right : 40
      },
      height : '280px',
      axisY : {
        onlyInteger : true
      }
    });
    //]]>
    </script>
    <?php
    }
    // Dependencies..
    if (file_exists(PATH . 'templates/js-php/' . $cmd . '.php')) {
      include(PATH . 'templates/js-php/' . $cmd . '.php');
    }
    if (defined('MSWSORT')) {
      include(PATH . 'templates/js-php/sort.php');
    }

    // Action spinner, DO NOT REMOVE
    ?>
    <div class="overlaySpinner" style="display:none"></div>

  </body>

</html>