<?php
    $thisPage =  $_SERVER['SCRIPT_NAME'];
    $thisPage = substr($thisPage, 1, strlen($thisPage));

?>
	<ul class="nav navbar-nav">
		<li class='<?php if ($thisPage == "index.php")  { echo "active"; } ?>'><a href="index.php">Home</a></li>
        <li class='<?php if ($thisPage == "about.php")  {echo "active "; } ?>'><a href="about.php">About Me</a></li>
		<li class="dropdown  <?php if ($thisPage == "work.php") { echo " active "; }?>">
			<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Work
            <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<?php $controller->nav(); ?>
			</ul>
		</li>
		<li class='<?php if ($thisPage == "timeline.php")  {echo "active "; } ?>'><a href="timeline.php">Timeline</a></li>
		<li class='<?php if ($thisPage == "contact.php")  {echo "active "; }?>'><a href="contact.php">Contact</a></li>
		<li>
			<?php echo $thisPage; ?>
		</li>
	</ul>