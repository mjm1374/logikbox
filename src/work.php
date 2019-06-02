<?php
	include_once("controller/Controller.php");
    $controller = new Controller();
?>

<!doctype html>
<html class="no-js"  lang="en">
<head>
	<?php include("header.php"); ?>
	<link rel="canonical" href="http://logikbox.com/work.php"/>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
				<?php include("nav.php"); ?>
			<!--/.navbar-collapse -->
		</div>
	</nav>
	<!-- Main jumbotron for a primary marketing message or call to action -->
	<?php
		$controller->invoke();
	?>
	<hr>
	<footer>
		<?php include_once("footer.php"); ?>
	</footer>
	</div>
	<!-- /container -->
</body>
</html>