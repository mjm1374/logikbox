<?php
	include_once("controller/Controller.php");
    $controller = new Controller();



?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
	<?php include("header.php"); ?>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
				<?php include("nav.php"); ?>
			<!--/.navbar-collapse -->
		</div>
	</nav>

	<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<h1>The History of Me</h1>
			<p>

			</p>
		</div>
	</div>

	<div class="container">
		<!-- Example row of columns -->
		<div class="row">
			<div class="col-md-1">

			</div>
			<div class="col-md-10">



				<section id="cd-timeline" class="cd-container">
					<?php
						$controller->invoke();
					?>
				</section>
				<!-- cd-timeline -->

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
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script src="js/main.js"></script>


	<script>
		$(document).ready(function() {});
	</script>
</body>

</html>