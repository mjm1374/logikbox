<?php

class Job {
	public $company;
	public $title;
	public $startDate;
	public $endDate;
	public $description;
	public $logo;
	public $link;
	public $url;
	
	public function __construct($company, $title, $startDate, $endDate, $description, $logo, $link, $url)  
    {  
        $this->company = $company;
		$this->title = $title;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->description = $description;
		$this->logo = $logo;
		$this->link = $link;
		$this->url = $url;
    } 
}

?>