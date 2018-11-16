<?php

class Job {
	public $company;
	public $title;
	public $startDate;
	public $endDate;
	public $description;
	public $logo;
	
	public function __construct($company, $title, $startDate, $endDate, $description, $logo)  
    {  
        $this->comaopny = $company;
		$this->title = $title;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
	    $this->description = $description;
		$this->logo = $logo;
    } 
}

?>