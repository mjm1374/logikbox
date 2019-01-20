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
				<h1>Hello, World!</h1>
				<p id="pickupLine"></p>
				<div id="portrait"></div>
				<p>


				</p>
			</div>
		</div>

		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-8">
					<?php $controller->firstProject()  ?>
					
				</div>
				<div class="col-md-4">
					<h2>Follow me on GitHub</h2>
					<img src="img/GitHub-Mark.png" class="logoimg" alt="Instagram" />
					<p>I code there for I am. Follow me and my boys projects on Github.  We do some cool stuff and a lot of just learning exercises so we can get better. Games, insteresting ideas, stupid stuff. You know, why you got into coding too.</p>
					<p><a class="btn btn-default" href="https://www.instagram.com/mjm1374/" role="button">Go to Github &raquo;</a></p>
				</div>
		</div>
			<div class="row">
				<div class="col-md-4">
					<h2>LinkedIn</h2>
					<img src="img/linkedin-resizeimage.png" class="logoimg" alt="LinkedIn" />
					<p>Lead developer across multiple work groups. In my role I lead programming projects for internal application development and marketing. </p>
					<p><a class="btn btn-default" href="https://www.linkedin.com/in/mjm1374/" role="button">View details &raquo;</a></p>
				</div>
				<div class="col-md-4">
					<h2>Facebook</h2>
					<img src="img/fb-resizeimage.png" class="logoimg" alt="Facebook" />
					<p>Father of 2 boys, friend to many, craft beer advocate and Star Wars super fan. Tinkerer of all things electronic and code. </p>
					<p><a class="btn btn-default" href="https://www.facebook.com/Phillymike" role="button">View details &raquo;</a></p>
				</div>
				<div class="col-md-4">
					<h2>Instagram</h2>
					<img src="img/instagram-resizeimage.png" class="logoimg" alt="Instagram" />
					<p>Studying chef, father of 2 boys and one cat, world traveler and past-life professional photographer. </p>
					<p><a class="btn btn-default" href="https://www.instagram.com/mjm1374/" role="button">View details &raquo;</a></p>
				</div>
				</div>
			</div>

			<hr>

			<footer>
				<?php include_once("footer.php"); ?>
			</footer>
		</div>
		<!-- /container -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

		<script src="js/bootstrap.min.js"></script>

		<script src="js/main.js"></script>
		<script>
			$(document).ready(function() {
				var json = (function() {
					var json = null;
					$.ajax({
						'async': false,
						'global': false,
						'url': 'js/quotes.json',
						'dataType': "json",
						'success': function(data) {
							json = data;
						}
					});
					return json;
				})();

				$('#pickupLine').html(json.lines[Math.floor(Math.random() * (json.lines.length - 1))]);
				//console.log( json.lines[Math.floor(Math.random() * 11)]);
			});
		</script>


	</body>

	</html>

	<script src="js/goodwill-halloween.min.js"></script>