<?php
require_once 'vendor/autoload.php';
include_once("api-key.php");
include_once("controller/Controller.php");
$controller = new Controller();

//$endpoint = "https://api-football-v1.p.rapidapi.com/v2/"; // Live endpoint
$endpoint = "http://www.api-football.com/demo/api/v2/"; // Demo endpoint

$response = Unirest\Request::get(
	$endpoint . "leagues/league/2",
	array(
		"X-RapidAPI-Host" => "api-football-v1.p.rapidapi.com",
		"X-RapidAPI-Key" => $football 
	)
);


?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<?php include("header.php"); ?>
	<link rel="canonical" href="http://logikbox.com/index.php" />
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<?php include("nav.php"); ?>
			<!--/.navbar-collapse -->
		</div>
	</nav>

	<div id="acceleration" style="display:none; widht:100%; height:100px;"></div>
	<div class="worldcup--wrapperx">
		<div class="worldcupx"></div> <?php //$controller->getTable(2)
		//var_dump($response);  

		// ["results"]=> int(1) ["leagues"]=> array(1) { [0]=> object(stdClass)#7 (11) { ["league_id"]=> int(2) ["name"]=> string(14) "Premier League" ["country"]=> string(7) "England" ["country_code"]=> string(2) "GB" ["season"]=> int(2018) ["season_start"]=> string(10) "2018-08-10" ["season_end"]=> string(10) "2019-05-12" ["logo"]=> string(49) "https://www.api-football.com/public/leagues/2.png" ["flag"]=> string(48) "https://www.api-football.com/public/flags/gb.svg" ["standings"]=> int(1) ["is_current"]=> int(0) } } } } >

		var_dump($response->body->api->leagues[0]);
		echo "<br>";
		$league = $response->body->api->leagues[0];
		echo $league->name; ?>
		</div>
	</div>
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
		<!-- Example row of columns -->
		<div class="row">
			<div class="col-md-8">
				<?php $controller->firstProject()  ?>
			</div>
			<div class="col-md-4">
				<div class="socialContainer socialContainer--plus50">
					<h2 class="homeH2">Follow me on GitHub</h2>
					<img src="img/GitHub-Mark.svg" class="logoimg" alt="Instagram" />
					<p>I code there for I am. Follow me and my boys projects on Github. We do some cool stuff and a lot of learning exercises so we can get better. Games, interesting ideas, stupid stuff. You know, why you got into coding too.</p>
					<a class="btn btn-default socialContainer--btn" href="https://www.github.com/mjm1374/" role="button">Go to Github &raquo;</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="socialContainer">
					<h2 class="homeH2">LinkedIn</h2>
					<img src="img/In-PMS2174U-L.svg" class="logoimg" alt="LinkedIn" />
					<p>Lead developer across multiple work groups. In my role I lead programming projects for internal application development and marketing. </p>
					<a class="btn btn-default socialContainer--btn" href="https://www.linkedin.com/in/mjm1374/" role="button">View details &raquo;</a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="socialContainer">
					<h2 class="homeH2">Facebook</h2>
					<img src="img/f_logo_RGB-Blue_1024.svg" class="logoimg" alt="Facebook" />
					<p>Father of 2 boys, friend to many, scooter rider, craft beer advocate, soccer fan and Star Wars super nerd. Pride myself on being a tinkerer of all things electronic and code. </p>
					<a class="btn btn-default socialContainer--btn" href="https://www.facebook.com/Phillymike" role="button">View details &raquo;</a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="socialContainer">
					<h2 class="homeH2">Instagram</h2>
					<img src="img/instagram.svg" class="logoimg" alt="Instagram" />
					<p>Studying chef, father of 2 boys and one cat, world traveler and past-life professional photographer. </p>
					<a class="btn btn-default socialContainer--btn" href="https://www.instagram.com/mjm1374/" role="button">View details &raquo;</a>
				</div>
			</div>
			<div class="col-md-12 launchHeader">
				<img src='/img/spacex/SpaceX-Logo.svg' class='launchLogo' alt="SpaceX" />
				<h2 class="homeH2">Upcoming Launches</h2>
			</div>
			<div id="launchBlockHolder"></div>
		</div>
		<hr>
		<h2 class="homeH2">Lastest Photos</h2>
		<div class="row instagram">
		</div>
		<a id="getMoreIstagram" class="btn btn-default" href="#" data-nexturl="" role="button">View More &raquo;</a>
		<hr>
		<footer>
			<?php include_once("footer.php"); ?>

		</footer>
		<div class="credits">Icons made by <a href="https://www.freepik.com/?__hstc=57440181.79d66b1f1a0716ef8134194c7c62ad28.1560433074791.1560433074791.1560433074791.1&__hssc=57440181.4.1560433074792&__hsfp=3359128668" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
	</div>

	<?php
	include_once("modal-photo.php");
	include_once("modal-video.php");
	include_once("modal-worldcup.php");
	?>

	<!-- /container -->
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
			GetInstagram();
			GetSpaceX(3);
			//GetGroupResults();
			GetTable(2);
		});
	</script>


	<!-- <script src="js/goodwill-halloween.min.js"></script> -->
</body>

</html>