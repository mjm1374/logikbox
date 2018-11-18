<?php
include_once("model/Model.php");

class Controller {
	public $model;

	public function __construct()
    {
        $this->model = new Model();

    }

	public function invoke()
	{
		if (!isset($_GET['job']))
		{
			// no special book is requested, we'll show a list of all available books
			$jobs = $this->model->getJobList();
			include 'view/timeline.php';
		}
		else
		{
			// show the requested book
			$job = $this->model->getJob($_GET['job']);
			include 'view/viewjob.php';
		}
	}

	public function nav()
	{
		$jobs = $this->model->getJobList();
		include 'view/jobnav.php';
	}


	public function get_form(){
        $name = $_REQUEST['name'];
        $name = trim($name);
		$msg = $_POST['msg'];
       // $msg = trim($msg);
		$msg =  $name . " writes \r\n" . $msg;
		$email_from = $_POST['email'];
		$email_from = trim($email_from);

		//reCaptcha
		$secret   = "6LfoV3sUAAAAABCL8io_gVio80cvcxbwzW0cm-XQ";
		$response = $_POST['token'];
		$remoteip = $_SERVER['REMOTE_ADDR'];
		//$remoteip = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
		$recaptcha_response =  file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
		$result  = json_decode($recaptcha_response,true);


		if(isset($result['success'] ) &&  $result['success'] == 1) {

             print_r("Thanks for reaching out. I'll get back to you.");

			if($msg !== ''){

				$email_to = "mike@logikbox.com";
				$email_subject = "Logikbox email";

				$headers = 'From: '.$email_from."\r\n".

			   'Reply-To: '.$email_from."\r\n" .

			   //'X-Mailer: PHP/' . phpversion();

			   @mail($email_to, $email_subject, $msg, $headers);

			}

		} else {

			print_r("Failed Robotic validation.");

			}

    }
}

?>