<?php

date_default_timezone_set('America/New_York');

	$cnt = 0;
	$myString = "";
	$lastDistance = "2019";

		foreach ($jobs as $title => $job)
		{
			//echo '<tr><td><a href="index.php?job='.$job->company.'">'.$job->title.'</a></td><td>'.$job->company.'</td><td>'.$job->description.'</td></tr>';
			
			
			$myString =  $myString . '<div class="cd-timeline-block">';
			$myString =  $myString . '<div class="cd-timeline-img cd-picture">';
			$myString =  $myString . '	<img src="img/' . $job->logo . '" alt="Picture">';
			$myString =  $myString . '</div> ';

			$myString =  $myString . '<div class="cd-timeline-content">';
			$myString =  $myString . '	<h2>' . $job->company . '</h2>';
			$myString =  $myString . '	<p><b>' . $job->title . '</b></p>';
			$myString =  $myString . '	<p>' . $job->description . '</p>';
			$myString =  $myString . '	<a href="' . $job->link . '" class="cd-read-more">See Site</a>';
			$date = new DateTime($job->startDate);
			$myString =  $myString . '	<span class="cd-date">' . date_format($date, 'd/m/Y') . '</span>';
			$myString =  $myString . '</div> ';
			$myString =  $myString . '</div> ';
			
			 
			 $cnt =  $cnt + 1;
		}
		
		//$myString = substr ( $myString, 1 , (strlen($myString) -1 ));
		
		echo $myString ;
	?>
   