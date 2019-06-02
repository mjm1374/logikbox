<?php
	include_once("controller/Controller.php");
    $controller = new Controller();
?>

<!doctype html>
<html class="no-js"  lang="en">
<head>
	<?php include("header.php"); ?>
	<link rel="canonical" href="http://logikbox.com/contact.php"/>
	<script src='https://www.google.com/recaptcha/api.js?render=6LfoV3sUAAAAALwuQVeRhBeMbPqxZ561orueLeJo'></script>
	<script>
		grecaptcha.ready(function() {
			grecaptcha.execute('6LfoV3sUAAAAALwuQVeRhBeMbPqxZ561orueLeJo', {
					action: 'email_forms'
				})
				.then(function(token) {
					// Verify the token on the server.
					$('form').prepend('<input type="hidden" name="token" value="' + token + '">');
					$('form').prepend('<input type="hidden" name="action" value="create_comment">');
					// submit form now
					//$('form').unbind('submit').submit();
				});
		});
	</script>
</head>
<body>
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
			<p> Go ahead, I don't bite'</p>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				<h3>Send me a missive</h3>
				<form action="thanks.php" method="POST" id="commentForm" name="commentForm">
					<label>Give me a name, it's only polite.</label><br/>
					<input type="text" name="name" class="emailform" required aria-label="Name"><br/>
					<label>Email, if you want an answer......</label><br/>
					<input type="text" name="email" class="emailform"  aria-label="Email" required><br/>
					<label>Send me your thoughts, complaints, rants abouts sports...</label><br/>
					<textarea name="msg" class="emailform msgbox"  aria-label="Message"></textarea><br/>
					<button  type="submit" name="sendMail" class="btn btn-primary">Shoot it off!</button>
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
	<script src="js/jquery.validate.min.js"></script>
	<script>
		$().ready(function() {

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