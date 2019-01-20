<?php if (!defined('PARENT')) { exit; }
if ($SETTINGS->prodkey == '' || strlen($SETTINGS->prodkey) != 60) {
  $productKey = mswPK();
  $DB->db_query("UPDATE `" . DB_PREFIX . "settings` SET
  `prodkey` = '{$productKey}'
  ");
  $SETTINGS->prodkey = $productKey;
}
?>
  <div class="panel panel-default">
    <div class="panel-heading">
      Purchase Information - Please Read
    </div>
    <div class="panel-body">
      If you would like show your support for this software and enjoy the benefits of the commercial version of <?php echo SCRIPT_NAME; ?>, please consider purchasing a licence. Thank you.<br><br>
      <span class="badge">1</span> Please visit the <a href="https://www.<?php echo SCRIPT_URL; ?>" title="<?php echo SCRIPT_NAME; ?>" onclick="window.open(this);return false"><?php echo SCRIPT_NAME; ?> Website</a> and use the &#039;<span class="highlighter">Purchase</span>&#039; option.<br><br>
      <span class="badge">2</span> Once payment has been completed you will be redirected to the <a href="https://www.maiangateway.com/login.html" onclick="window.open(this);return false">Maian Script World Licence Centre</a>.<br><br>
      <span class="badge">3</span> Generate your &#039;<span class="highlighter">licence.lic</span>&#039; licence file using the onscreen instructions. To generate a licence file you will need the unique <span class="highlighter">60 character product key</span> shown below.<br><br>
      <span class="badge">4</span> Upload the &#039;<span class="highlighter">licence.lic</span>&#039; file into your software installation folder and replace the default one.<br><br>
      <span class="badge">5</span> Enter your footer information on the main <a href="index.php?p=settings">settings</a> page (This is hidden in the free version).
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      Commercial Version Benefits
    </div>
    <div class="panel-body" style="line-height:25px">
      Besides unlocking ALL the free restrictions, the full version has the following benefits:<br><br>
      <i class="fa fa-check fa-fw"></i> ALL Future upgrades FREE of Charge<br>
      <i class="fa fa-check fa-fw"></i> Notifications of new version releases<br>
      <i class="fa fa-check fa-fw"></i> All features unlocked and unlimited<br>
      <i class="fa fa-check fa-fw"></i> Copyright removal included in price<br>
      <i class="fa fa-check fa-fw"></i> Free 12 months priority support<br>
      <i class="fa fa-check fa-fw"></i> No links in email footers<br>
      <i class="fa fa-check fa-fw"></i> One off payment, no subscriptions<br><br>
      A <a href="https://www.<?php echo SCRIPT_URL; ?>/white-label.html" onclick="window.open(this);return false">white label licence</a> is also available for you to sell the system as your own with no reference to Maian Script World.<br><br>
      Check out the <a href="https://www.<?php echo SCRIPT_URL; ?>/features.html" onclick="window.open(this);return false">feature comparison matrix</a> on the <?php echo SCRIPT_NAME; ?> website. If you have any questions, please <a href="https://www.maianscriptworld.co.uk/contact" onclick="window.open(this);return false">contact me</a>.
    </div>
  </div>

  <div class="panel panel-default" style="margin-bottom:50px">
    <div class="panel-heading">
      Unique Product Key
    </div>
    <div class="panel-body" style="overflow-y:auto">
      <?php echo strtoupper($SETTINGS->prodkey); ?>
    </div>
  </div>
