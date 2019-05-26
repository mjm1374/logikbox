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

	<script src='https://www.google.com/recaptcha/api.js?render=6LfoV3sUAAAAALwuQVeRhBeMbPqxZ561orueLeJo'></script>
	<script>
		grecaptcha.ready(function() {
			grecaptcha.execute('6LfoV3sUAAAAALwuQVeRhBeMbPqxZ561orueLeJo', {
					action: 'email_forms'
				})
				.then(function(token) {
					// Verify the token on the server.
					//console.log(token);
					$('form').prepend('<input type="hidden" name="token" value="' + token + '">');
					$('form').prepend('<input type="hidden" name="action" value="create_comment">');
					// submit form now
					//$('form').unbind('submit').submit();
				});
		});
	</script>
</head>

<body>
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">

				<?php include("nav.php"); ?>
			</div>
			<!--/.navbar-collapse -->
		</div>
	</nav>

	<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<h1>Contact Me</h1>
			<p> Go ahead, I don't bite'
				<?php
			//$controller->invoke();
			?>

			</p>
		</div>
	</div>

	<div class="container">
		<!-- Example row of columns -->
		<div class="row">
			<div class="col-md-2">

			</div>
			<div class="col-md-8">
				<h2>Write it ups</h2>
				<?php
			//$controller->invoke();
			?>

				<form action="thanks.php" method="POST" id="commentForm" name="commentForm">
					<label>Name</label><br/>
					<input type="text" name="name" class="emailform" required><br/>
					<label>Email</label><br/>
					<input type="text" name="email" class="emailform" required><br/>
					<label>Message</label><br/>
					<textarea name="msg" class="emailform msgbox"></textarea><br/>
					<button  type="submit" name="sendMail" class="btn btn-primary">Send</button>
				</form>
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
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
	<script>
		window.jQuery || document.write('<script src="js/jquery-2.1.4.js"><\/script>')
	</script>

	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/main.js"></script>

	<script>
		$().ready(function() {
			// validate the comment form when it is submitted
			//$("#commentForm").validate();

			// validate signup form on keyup and submit
			$("#commentForm").validate({
				rules: {
					name: {
						required: true,
						minlength: 3,
						lettersonly: true

					},
					email: {
						required: true,
						email: true

					},
				},


				messages: {
					name: "Please enter your firstname",

					email: "Please enter a valid email address",
				}


			});


		});
	</script>
</body>

</html>