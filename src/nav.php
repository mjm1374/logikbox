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
        <li class="dropdown  <?php if ($thisPage == "work.php") { echo " active "; }?>">
			<a class='dropdown-toggle' data-toggle='dropdown' href='#'>My Projects
            <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="https://securec48.ezhostingserver.com/logikbox-com/satellite/">Satelite Tracker</a></li>
                <li><a href="http://logikbox.com/asteroids/">Asteroids</a></li>
                <li><a href="http://logikbox.com/clock/">Word clock</a></li>
                <li><a href="http://logikbox.com/phprss/">World Cup RSS feed (2014)</a></li>
                <!--<li><a href="http://logikbox.com/phprss/">JS Face Tracking</a></li>-->

                <li><a href="http://dev.deardorffassociates.com/costume-generator/" target="_blank">Goodwill Costume Generator</a></li>
			</ul>
		</li>
		<li class='<?php if ($thisPage == "timeline.php")  {echo "active "; } ?>'><a href="timeline.php">Timeline</a></li>
		<li class='<?php if ($thisPage == "contact.php")  {echo "active "; }?>'><a href="contact.php">Contact</a></li>
		<li>
			<?php echo $thisPage; ?>
		</li>
	</ul>