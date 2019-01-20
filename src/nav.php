<?php
    $thisPage =  $_SERVER['SCRIPT_NAME'];
    $thisPage = substr($thisPage, 1, strlen($thisPage));

?>
<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="index.php" class="homeTitle">Mike McAllister</a>
</div>
<div id="navbar" class="navbar-collapse collapse">

	<ul class="nav navbar-nav">
		<li class='<?php if ($thisPage == "index.php")  { echo "active"; } ?>'><a href="index.php" class='nava'>Home</a></li>
        <li class='<?php if ($thisPage == "about.php")  {echo "active "; } ?>'><a href="about.php" class='nava'>About Me</a></li>
		<li class="dropdown  <?php if ($thisPage == "work.php") { echo " active "; }?>">
			<a class='dropdown-toggle  nava' data-toggle='dropdown' href='#'>Work
            <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<?php $controller->nav(); ?>
			</ul>
		</li>
		<li class="dropdown  <?php if ($thisPage == "timeline.php") { echo " active "; }?>">
			<a class='dropdown-toggle nava' data-toggle='dropdown' href='timeline.php'>My Projects
            <span class="caret"></span></a>
			<ul class="dropdown-menu">
			<li class='<?php if ($thisPage == "timeline.php")  {echo "active "; }?>'><a href="timeline.php" class="nava">Overview</a></li>
				<?php $controller->projects(); ?>
			</ul>
		</li>

		<li class='<?php if ($thisPage == "contact.php")  {echo "active "; }?>'><a href="contact.php" class="nava">Contact</a></li>
		<li>
			<?php echo $thisPage; ?>
		</li>
	</ul>
</div>