<?php
require_once 'vendor/autoload.php';
include_once("api-key.php");
include_once("controller/Controller.php");
$controller = new Controller();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<?php include("header.php"); ?>
	<link rel="canonical" href="https://logikbox.com/about.php" />
	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $gMapKey ?>"></script>

</head>

<body>
	xxx: <?php echo $gMapKey ?>
	<a href="#main" class="skip-nav" tabindex="0">Skip to main content</a>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<?php include("nav.php"); ?>
			<!--/.navbar-collapse -->
		</div>
	</nav>
	<div class="jumbotron">
		<div class="container">
			<h1>About Me</h1>
			<p>Things I do....</p>
			<?php	//$controller->invoke(); 
			?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-10">
				<div class="col-sm-12">
					<main id="main" tabindex="0">
						<div class="row">
							<div class="col-sm-12">
								<h2>A bit 'bout me...</h2>
								<div class="portaitclear">
									<div id="portrait"></div>
								</div>
								<p>I'm an autodidact and a creative professional working in the tech industries, involved in my community and I work to make the world a better place. I've been told I'm a true believer, they might be right, someone has to care. Born and raised in Philly, huge fan of this town. Lived all over but Philly is always home. Something about the grit of this town, the neighborhoods and their neighbors. The food, the beer, the sports and that uniquely Philly pride. I like my <a href="javascript:void(0)" data-pic='/img/Superbowl_LII.jpg' data-caption='Superbowl LII - Greatest moment of my life' data-alt='Eagles 41 - Patriots 33' class='pic__modal'>Eagles</a> and <a href="javascript:void(0)" data-pic='/img/flyers-guy.jpg' data-caption='I don&apos;t love them as much as this guy though' data-alt='SERIOUSLY, WTF!' class='pic__modal'>Flyers</a>. Serious soccer fan, I follow <a href="https://www.mancity.com/" target="_blank" rel="noopener">Manchester City</a> and love going to the Union. </p>

								<p>I've been an elected committee person for 14 years in the city (Go the mighty <a href='https://www.facebook.com/NinthWardDems/' target='_blank' rel="noopener">9-14th!</a>). Sat on the board of directors for my local art center, the <a href='https://allenslane.org/' target='_blank' rel="noopener">Allens Lane Art Center</a>. I love to <a href="#" class='map__modal' data-toggle="modal" data-target="#map__modal">travel</a>, who doesn't. I’ve been a life long scooter enthusiast, Quadrophenia had a really strong effect on me. Ask me about <a href='#' data-pic='/img/3815420841_f6dbb07a9d.jpg' data-caption='Meet Emma Peel, She&apos;s my scooter' class='pic__modal'>my scooter</a> runs someday. Amateur <a href='javascript:void(0)' data-pic='/img/mars.jpg' data-caption='Mars in opposition - 4.18.2014' class='pic__modal'>astronomer</a>, I’ve seen all the planets (sorry Pluto, you been dumped to the minor leagues and don’t count anymore). This and programming are the two skills I share with my boys. That is my truest joy.</p>

							</div>
						</div>
					</main>
					<hr />
					<section id="skills">
						<div class="row">
							<h2 tabindex="0">Skills</h2>
							<div class="col-sm-4" tabindex="0">
								<h3>Back-End</h3>
								<ul>
									<li>.Net (C# & VBScript)</li>
									<li>PHP (5 & 7)</li>
									<li>Coldfusion</li>
									<li>MSSQL</li>
									<li>MySQL</li>
									<li>IIS & Apache</li>
									<li>Wordpress</li>
									<li>Drupal</li>
									<li>Craft</li>
								</ul>
							</div>
							<div class="col-sm-4" tabindex="0">
								<h3>Front-End</h3>
								<ul>
									<li>HTML 5</li>
									<li>CSS 3.0</li>
									<li>Bootstrap 4.0</li>
									<li>Scss/Sass</li>
									<li>Javascript</li>
									<li>ES6</li>
									<li>Typescript</li>
									<li>React</li>
									<li>Angular 9</li>
									<li>SveltKit</li>
									<li>Vue</li>
									<li>jQuery 3.0</li>
									<li>Gatsby</li>
									<li>JSON</li>
									<li>AJAX</li>
									<li>XML</li>
								</ul>
							</div>
							<div class="col-sm-4" tabindex="0">
								<h3>Technology</h3>
								<ul>
									<li>Adobe Creative Suite
										<ul>
											<li>Photoshop</li>
											<li>Illustrator</li>
											<li>Flash</li>
											<li>Premeire</li>
										</ul>
									</li>
									<li>Visual Studio</li>
									<li>DevOps</li>
									<li>MS Office Suite</li>
									<li>Node JS</li>
									<li>Git</li>
									<li>SVN</li>
								</ul>
							</div>
						</div>
					</section>
					<hr />
					<div class="row">
						<div class="col-sm-12">
							<section id="clients">
								<h2 tabindex="0">Clients</h2>
								<div class="row">
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/amerbergen150.png" alt="Amerisource Berger Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/Beneficial150.png" alt="beneficial Bank Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/delonghi150.jpeg" alt="Delonghi Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/mural150.png" alt="Philadelphia Mural Arts Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/logo-ikea150.png" alt="Ikea Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/loyola-150.jpg" alt="Loyola University or Maryland Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/Michigan_150.png" alt="University of Michigan Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/nike150.png" alt="Nike Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/Saint-Gobain-150.jpg" alt="Saint Gobain Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/sony150.jpg" alt="Sony Music Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/brandywine150.png" alt="Brandywine Property Group Logo"></div>
									<div class="col-sm-3 logo" tabindex="0"><img src="img/logos/goodwill-150.png" alt="Goodwill Logo"></div>
								</div>
							</section>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
			</div>
		</div>
	</div>
	<hr>
	<footer>
		<?php include_once("footer.php"); ?>
	</footer>
	</div>
	<!-- The Modals -->
	<?php
	include_once("modal-photo.php");
	?>

	<div class="modal fade" id="map__modal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">My Travels</h4>
				</div>
				<div class="modal-body">
					<div id="map"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /container -->
	<script>
		$(document).ready(function($) {
			getLocation();
		});
	</script>
</body>

</html>