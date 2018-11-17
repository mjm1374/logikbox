<?php 
	include_once("controller/Controller.php");
    $controller = new Controller();
	 


?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
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
		<script src='https://www.google.com/recaptcha/api.js?render=6LfoV3sUAAAAALwuQVeRhBeMbPqxZ561orueLeJo'></script>
		<script>
		grecaptcha.ready(function() {
		grecaptcha.execute('6LfoV3sUAAAAALwuQVeRhBeMbPqxZ561orueLeJo', {action: 'email_forms'})
		.then(function(token) {
		// Verify the token on the server.
		//console.log(token);
			$('form').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('form').prepend('<input type="hidden" name="action" value="create_comment">');
                // submit form now
                $('form').unbind('submit').submit();
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
        </div><!--/.navbar-collapse -->
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
				<input type="submit" name="submit" value="Send">
			</form>
       </div>
        <div class="col-md-2">
           
        </div>
      </div>

      <hr>

      <footer>
        <?php include_once("footer.php"); ?>
      </footer>
    </div> <!-- /container -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-2.1.4.js"><\/script>')</script>

        <script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
           
		$().ready(function() {
		// validate the comment form when it is submitted
		$("#commentForm").validate();

		// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				name: "required",
				 
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
