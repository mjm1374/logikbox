<?php

date_default_timezone_set('America/New_York');

$cnt = 0;
$myString = "";
$lastDistance = "2019";


// public $name;
// public $description;
// public $img;
// public $link; 

foreach ($projects as $title => $project) {

	$myString =  $myString . '<div class="cd-timeline-block">';
	$myString =  $myString . '<div class="cd-timeline-img cd-picture">';
	$myString =  $myString . '	<img src="img/' . $project->img . '" alt="' . $project->name . ' project">';
	$myString =  $myString . '</div> ';

	$myString =  $myString . '<div class="cd-timeline-content">';
	$myString =  $myString . '	<h2 tabindex="0">' . $project->name . '</h2>';
	$myString =  $myString . '<img src="img/' . $project->bigimg  . '" class="projectImg picLeft" alt="' . $project->name . '" />';
	$myString =  $myString . '	<span  tabindex="0">' . $project->description . '</span>';
	if ($project->active == 1) {
		$myString =  $myString . '	<a href="' . $project->link . '" class="cd-read-more">See Site</a>';
	}

	$myString =  $myString . '</div> ';
	$myString =  $myString . '</div> ';

	$cnt =  $cnt + 1;
}

//$myString = substr ( $myString, 1 , (strlen($myString) -1 ));

echo $myString;
