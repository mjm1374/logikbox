<?php
include_once("controller/Controller.php");
$controller = new Controller();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<?php include("header.php"); ?>
	<link rel="canonical" href="http://logikbox.com/index.php" />
</head>

<body>
	<a href="#main" class="skip-nav" tabindex="0">Skip to main content</a>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<?php include("nav.php"); ?>
			<!--/.navbar-collapse -->
		</div>
	</nav>

	<!-- <div id="acceleration" style="display:none; width:100%; height:100px;"></div> -->
	<section id="soccer">
		<?php include_once("view/team_banner.php"); ?>
	</section>

	<div class="jumbotron jumbotron--homepage">
		<div class="container">
			<h1>Hello, World!</h1>
			<p id="pickupLine"></p>
			<div id="qrCode">
				<div id="qrTitle"><span>Scan for Mobile</span></div>
			</div>
			<div id="quadrophenia">
				<div class="quadrophenia_ring1 blue">
					<div class="quadrophenia_ring2 white">
						<div class="quadrophenia_ring3 red">
							<div id="nameplate">
								<div id="photo">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<p></p>
		</div>
	</div>
	<div class="container">
		<main id="main">
			<div class="row">
				<div class="col-md-8" tabindex="0">
					<?php $controller->firstProject()  ?>
				</div>
				<div class="col-md-4">
					<div class="socialContainer socialContainer--plus50" tabindex="0">
						<h2 class="homeH2">Follow me on GitHub</h2>
						<img src="img/GitHub-Mark.svg" class="logoimg" alt="Github logo" />
						<p>I code there for I am. Follow me and my boys projects on Github. We do some cool stuff and a lot of learning exercises so we can get better. Games, interesting ideas, stupid stuff. You know, why you got into coding too.</p>
						<a class="btn btn-default socialContainer--btn" href="https://www.github.com/mjm1374/" role="button" aria-label="Go view my Github account">Go to Github &raquo;</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="socialContainer" tabindex="0">
						<h2 class="homeH2">LinkedIn</h2>
						<img src="img/In-PMS2174U-L.svg" class="logoimg" alt="LinkedIn logo" />
						<p>Lead developer across multiple work groups. In my role I lead programming projects for internal application development and marketing. </p>
						<a class="btn btn-default socialContainer--btn" href="https://www.linkedin.com/in/mjm1374/" role="button" aria-label="Go view my LinkedIn profile">View details &raquo;</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="socialContainer" tabindex="0">
						<h2 class="homeH2">Facebook</h2>
						<img src="img/f_logo_RGB-Blue_1024.svg" class="logoimg" alt="Facebook logo" />
						<p>Father of 2 boys, friend to many, scooter rider, craft beer advocate, soccer fan and Star Wars super nerd. Pride myself on being a tinkerer of all things electronic and code. </p>
						<a class="btn btn-default socialContainer--btn" href="https://www.facebook.com/Phillymike" role="button" aria-label="Go view my Facebook account">View details &raquo;</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="socialContainer" tabindex="0">
						<h2 class="homeH2">Instagram</h2>
						<img src="img/instagram.svg" class="logoimg" alt="Instagram logo" />
						<p>Studying chef, father of 2 boys and one cat, world traveler and past-life professional photographer. </p>
						<a class="btn btn-default socialContainer--btn" href="https://www.instagram.com/mjm1374/" role="button" aria-label="Go view my Instagram feed.">View details &raquo;</a>
					</div>
				</div>
		</main>
		<section id="SpaceX">
			<div class="col-md-12 launchHeader">
				<img src='/img/spacex/SpaceX-Logo.svg' class='launchLogo' alt="SpaceX" />
				<h2 class="homeH2" aria-label="Upcoming SpaceXLaunchess" tabindex="0">Upcoming Launches</h2>
			</div>
			<div id="launchBlockHolder"></div>
		</section>
	</div>
	<hr>
	<section id="Instagram">
		<div id="insta__big" class="insta__big"></div>
		<h2 class="homeH2">Lastest Photos</h2>
		<div class="row instagram">
		</div>
		<a id="getMoreIstagram" class="btn btn-default" href="#" data-nexturl="" role="button" aria-label="View more Photos">View More &raquo;</a>
	</section>
	<hr>
	<footer>
		<?php include_once("footer.php"); ?>

	</footer>
	</div>

	<?php
	include_once("modal-photo.php");
	include_once("modal-video.php");
	include_once("modal-worldcup.php");
	?>

	<!-- /container -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {

			let bigInstagram = document.getElementById('insta__big');
			window.addEventListener('scroll', checkInstagramVisable);

			function checkInstagramVisable() {
				if (isInViewport(bigInstagram)) bigInstagram.classList.add('insta__big--rotate');
			}

			fetch('js/quotes.json')
				.then(response => response.json())
				.then(result => document.getElementById('pickupLine').innerHTML = result.lines[Math.floor(Math.random() * (result.lines.length - 1))])

			GetInstagram();
			GetSpaceXV4(3);

			window.addEventListener('scroll', checkInstagramVisable);

			function checkInstagramVisable() {
				if (isInViewport(bigInstagram)) bigInstagram.classList.add('insta__big--rotate');
			}
		});
	</script>

</body>

</html>