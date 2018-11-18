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
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			body {
				padding-top: 50px;
				padding-bottom: 20px;
			}
		</style>
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/main.css">

		<script src="js/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	</head>

	<body>
		<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
					<a class="navbar-brand" href="index.php">Mike McAllister</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<?php include("nav.php"); ?>
				</div>
				<!--/.navbar-collapse -->
			</div>
		</nav>

		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
				<h1>Contact Me</h1>
				<p> Go ahead, I don't bite'</p>
				<?php
			//$controller->invoke();
			?>


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
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="js/jquery-2.1.4.js"><\/script>')
		</script>

		<script src="js/bootstrap.min.js"></script>

		<script src="js/main.js"></script>

	</body>

	</html>