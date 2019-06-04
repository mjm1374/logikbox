<?php
	include_once("controller/Controller.php");
    $controller = new Controller();
?>

<!doctype html>
<html class="no-js"  lang="en">
<head>
	 
	<?php include("header.php"); ?>
	<link rel="canonical" href="http://logikbox.com/timeline.php"/>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
				<?php include("nav.php"); ?>
			<!--/.navbar-collapse -->
		</div>
	</nav>
	<div class="jumbotron">
		<div class="container">
			<h1>Tinkerings</h1>
			<p>
			</p>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-10">
				<section id="cd-timeline" class="cd-container">
					<?php
						$controller->invoke();
					?>
				</section>
			</div>
			<div class="col-md-1">
			</div>
		</div>
		<hr>
		<footer>
			<?php include_once("footer.php"); ?>
		</footer>
	</div>
	<!-- /container -->
</body>
</html>