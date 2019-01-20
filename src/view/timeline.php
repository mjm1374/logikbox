<?php

date_default_timezone_set('America/New_York');

	$cnt = 0;
	$myString = "";
	$lastDistance = "2019";


// public $name;
// public $description;
// public $img;
// public $link; 

		foreach ($projects as $title => $project)
		{
			//echo '<tr><td><a href="index.php?job='.$job->company.'">'.$job->title.'</a></td><td>'.$job->company.'</td><td>'.$job->description.'</td></tr>';
			
			
			$myString =  $myString . '<div class="cd-timeline-block">';
			$myString =  $myString . '<div class="cd-timeline-img cd-picture">';
			$myString =  $myString . '	<img src="img/' . $project->img . '" alt="Picture">';
			$myString =  $myString . '</div> ';

			$myString =  $myString . '<div class="cd-timeline-content">';
			$myString =  $myString . '	<h2>' . $project->name . '</h2>';
			$myString =  $myString . '<img src="img/' . $project->bigimg  . '" class="projectImg picLeft" />';
			$myString =  $myString . '	<p>' . $project->description . '</p>';
			$myString =  $myString . '	<a href="' . $project->link . '" class="cd-read-more">See Site</a>';
			$myString =  $myString . '</div> ';
			$myString =  $myString . '</div> ';
			
			 
			 $cnt =  $cnt + 1;
		}
		
		//$myString = substr ( $myString, 1 , (strlen($myString) -1 ));
		
		echo $myString ;
	?>
   