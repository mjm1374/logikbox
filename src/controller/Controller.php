<?php
require_once 'vendor/autoload.php';
include_once("model/model.php");

class Controller {
	public $jobs;
	public $projects;

	public function __construct()
    {
		$this->jobs = new Jobs();
		$this->projects = new Projects();

    }

	public function invoke()
	{
		if (!isset($_GET['job']))
		{
			// no project chosen, show them all
			$projects = $this->projects->getProjectList();
			include 'view/timeline.php';
		}
		else
		{
			// show the requested job
			$job = $this->jobs->getJob($_GET['job']);
			include 'view/viewjob.php';
		}
	}

	public function firstProject()
	{
		
			// show the 1st project
			$lastest = $this->projects->getFirstProject();
			include 'view/viewLatest.php';
		
	}



	public function nav()
	{
		$jobs = $this->jobs->getJobList();
		include 'view/jobnav.php';
	}


	public function projects()
	{
		$projects = $this->projects->getProjectList();
		include 'view/projectsnav.php';
	}

	// public function getTable($league_id)
	// {
	// 	include 'view/team_banner.php';
	// 	$response = Unirest\Request::get(
	// 		"https://api-football-v1.p.rapidapi.com/v2/leagues/league/" . $league_id,
	// 		array(
	// 			"X-RapidAPI-Host" => "api-football-v1.p.rapidapi.com",
	// 			"X-RapidAPI-Key" => "Rd2pyVFguwJeulnqTswlZ2pJCrlurqnE"
	// 		)
	// 	);

		//return $response;
		
	//}


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
				$email_subject = "Logikbox E-mail";
				$headers  = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= 'From: '.$email_from."\r\n";
				$headers .= 'Reply-To: ' . $email_from . "\r\n";
				$headers .= "X-Priority: 1\r\n";
				$headers .= "X-MSMail-Priority: High\r\n";

				@mail($email_to, $email_subject, $msg, $headers);
			}

		} else {

			print_r("Failed Robotic validation.");

			}

	}
	
}
