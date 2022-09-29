<?php

class Project
{
	public $name;
	public $description;
	public $img;
	public $bigimg;
	public $link;
	public $active;


	public function __construct($name, $description, $img, $bigimg,  $link, $active)
	{
		$this->name = $name;
		$this->description = $description;
		$this->img = $img;
		$this->bigimg = $bigimg;
		$this->link = $link;
		$this->active = $active;
	}
}
