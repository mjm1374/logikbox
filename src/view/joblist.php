<?php

date_default_timezone_set('America/New_York');

	$cnt = 0;
	$myString = "";
	$lastDistance = "2017";

		foreach ($jobs as $title => $job)
		{
			//echo '<tr><td><a href="index.php?job='.$job->company.'">'.$job->title.'</a></td><td>'.$job->company.'</td><td>'.$job->description.'</td></tr>';
			
			$myString =  $myString . ' {';
			$myString = $myString . '"isSelected": "';
			if ($cnt == 0) {
				$myString = $myString. 'true';
			 }
			 $myString =  $myString . '",' ;
			 $myString =  $myString . '"nextDistance": 4,';
			 $myString =  $myString .'"taskTitle": "' . $job->company . '",';
				$date = new DateTime($job->startDate);
			 $myString =  $myString .'"taskSubTitle": "' .  $job->title . '",';
			 $myString =  $myString .'"assignDate": "' . date_format($date, 'd/m/Y') . '",';
			 $myString =  $myString .'"taskShortDate": "' . date_format($date, 'd M Y') . '",';
			 //$myString =  $myString .'"taskShortDate": "p' . $cnt . '",';
			 //$myString =  $myString .'"taskDetails": "' . $job->description . '"';
			  $myString =  $myString .'"taskDetails": "XXX"';
			 $myString =  $myString .' },';
			 $cnt =  $cnt + 1;
		}
		
		$myString = substr ( $myString, 1 , (strlen($myString) -1 ));
		
		echo $myString ;
	?>
   