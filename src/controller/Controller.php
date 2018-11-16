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
		
        if($msg !== ''){
			
			$email_to = "mike@logikbox.com";
			$email_subject = "MVC Email";
			
			$headers = 'From: '.$email_from."\r\n".
			
		   'Reply-To: '.$email_from."\r\n" .
			
		   //'X-Mailer: PHP/' . phpversion();
			
		   @mail($email_to, $email_subject, $msg, $headers);  
			
		 
 
 
            
        }           
    }
}

?>