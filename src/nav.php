<?php
    $thisPage =  $_SERVER['SCRIPT_NAME'];
    $thisPage = substr($thisPage, 5, strlen($thisPage));

?>
	<ul class="nav navbar-nav">
		<li class='<?php if ($thisPage == "index.php")  { echo "active"; } ?>'><a href="index.php">Home</a></li>
		<li class="dropdown">
			<a class="dropdown-toggle <?php if ($thisPage == " work.php ") { echo " active "; }?>" data-toggle="dropdown" href="#">Work
            <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<?php $controller->nav(); ?>
			</ul>
		</li>
		<li><a href="timeline.php" class="<?php if ($thisPage == " timeline.php ")  {echo "active "; } ?>">Timeline</a></li>
		<li><a href="contact.php" class="<?php if ($thisPage == " contact.php ")  {echo "active "; }?>">Contact</a></li>
		<li>
			<?php echo $thisPage; ?>
		</li>
	</ul>