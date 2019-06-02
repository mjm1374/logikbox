<?php
	include_once("controller/Controller.php");
    $controller = new Controller();
?>

	<!doctype html>
	<html class="no-js"  lang="en">
	<head>
		<?php include("header.php"); ?>
		<link rel="canonical" href="http://logikbox.com/thanks.php"/>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
					<?php include("nav.php"); ?>
				<!--/.navbar-collapse -->
			</div>
		</nav>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
				<h1>Contact Me</h1>
				<p> Go ahead, I don't bite'</p>
			</div>
		</div>
		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8">
					<h2>Thank You</h2>
					<?php
						$controller->get_form();
					?>
				</div>
				<div class="col-md-2">
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