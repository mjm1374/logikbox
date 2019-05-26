<?php
	include_once("controller/Controller.php");
    $controller = new Controller();



?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"  lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"  lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"  lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"  lang="en">
<!--<![endif]-->

<head>
	<?php include("header.php"); ?>
	<link rel="canonical" href="http://logikbox.com/work.php"/>
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