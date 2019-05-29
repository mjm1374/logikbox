<?php
	include_once("__apiKeys.php");
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
	<link rel="canonical" href="http://logikbox.com/about.php"/>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $gMapKey ?>"></script> 
 
    <script src="js/map.js"></script>
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
				<h1>About Me</h1>
				<p>Things I do....</p> 
				<?php
			//$controller->invoke();
			?>


			</div>
		</div>

		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-1">

				</div>
				<div class="col-md-10">


					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-12">
								<h2>Overview</h2>
								<div class="portaitclear">
									<div id="portrait"></div>
								</div>
								<p>I'm a creative professional working in the tech industries, involved in my community and I work to make the world a better place. I've been told I'm a true believer, they might be right, someone has to care.  Born and raised in Philly, huge fan of this town. Lived all over but Philly is always home.  Something about the grit of this town, the neighborhood and their neighbors. The food, the beer, the sports and that uniquely Philly pride. I like my <a href="#" data-toggle="modal" data-target="#eaglesModal">Eagles</a> and Flyers. Serious soccer fan, I follow Man. City and love going to the Union. </p>

								<p>I been an elected committee person for 14 years in the city (Go the mighty <a href='https://www.facebook.com/NinthWardDems/' target='_blank' rel="noopener">9-14th!</a>). Sat on the board of directors for my local art center, <a href='https://allenslane.org/' target='_blank' rel="noopener">Allens Lane Art Center</a>. I love to <a href="#" data-toggle="modal" data-target="#myModal">travel</a>, who doesn't. I’ve been a life long scooter enthusiast, Quadrophia had a really strong effect on me. Ask me about <a href='#' data-toggle='modal' data-target='#emmaModal'>my scooter</a> runs someday. Amateur astronomer,  I’ve seen all the planets (sorry Pluto, you been dumped to the minor leagues and don’t count anymore). This and programming are the two skills I share with my boys. That is my truest joy.</p>

								
								
								</div>

								<h2>Skills</h2>
							</div>
							<div class="col-sm-4">
								<h3>Back-End</h3>
								<ul>
									<li>.Net (C# & VBScript)</li>
									<li>PHP (5 & 7)</li>
									<li>Coldfusion</li>
									<li>MSSQL</li>
									<li>MySQL</li>
									<li>IIS & Apache</li>
								</ul>
							</div>
							<div class="col-sm-4">
								<h3>Front-End</h3>
								<ul>
									<li>HTML 5</li>
									<li>CSS 3.0</li>
									<li>Bootstrap 4.0</li>
									<li>Sass</li>
									<li>Javascript</li>
									<li>ES6</li>
									<li>jQuery 3.0</li>
									<li>Vue</li>
									<li>Angular 5</li>
									<li>JSON</li>
									<li>AJAX</li>
									<li>XML</li>
								</ul>

							</div>
							<div class="col-sm-4">
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
									<li>MySQL Workbench</li>
									<li>Git</li>
									<li>SVN</li>
								</ul>

							</div>
							<div class="col-sm-12 clientBlock">
								<h2>Clients</h2>
								<div class="row">
									<div class="col-sm-3 logo"><img src="img/logos/amerbergen150.png" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/Beneficial150.png" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/delonghi150.jpeg" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/mural150.png" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/logo-ikea150.png" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/loyola-150.jpg" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/Michigan_150.png" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/nike150.png" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/Saint-Gobain-150.jpg" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/sony150.jpg" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/brandywine150.png" alt=""></div>
									<div class="col-sm-3 logo"><img src="img/logos/goodwill-150.png" alt=""></div>
								</div>

							</div>
						</div>
					</div>





				</div>
				<div class="col-md-1">

				</div>
			</div>

			<hr>

	<footer>
		<?php include_once("footer.php"); ?>
	</footer>
	</div>
	<!-- The Modals -->
	<div class="modal fade" id="eaglesModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Superbowl LII - Greatest moment of my life</h4>
				</div>
				<div class="modal-body">
					<img id="emma" src="img/superbowl_LII.jpg" alt="Eagles 41 - Patriots 33" />
					</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="emmaModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Meet Emma Peel</h4>
				</div>
				<div class="modal-body">
					<img id="emma" src="img/3815420841_f6dbb07a9d.jpg" alt="Meet Emma Peel, She's my scooter" />
					</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal" role="dialog">
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