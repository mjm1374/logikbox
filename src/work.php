<?php
include_once("controller/Controller.php");
$controller = new Controller();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<?php include("header.php"); ?>
	<link rel="canonical" href="https://logikbox.com/work.php" />
</head>

<body>
	<a href="#main" class="skip-nav" tabindex="0">Skip to main content</a>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<?php include("nav.php"); ?>
			<!--/.navbar-collapse -->
		</div>
	</nav>
	<main id="main">
		<?php
		$controller->invoke();
		?>
	</main>
	<hr>
	<footer>
		<?php include_once("footer.php"); ?>
	</footer>
	</div>
	<!-- /container -->
</body>

</html>