<?php

class Project {
	public $name;
	public $description;
	public $img;
	public $link;
	
	public function __construct($name, $description, $img, $link)  
    {  
        $this->name = $name;
	    $this->description = $description;
		$this->img = $img;
		$this->link = $link;
    } 
}

?>