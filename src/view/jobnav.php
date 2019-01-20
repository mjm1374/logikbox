
	<?php 

		foreach ($jobs as $title => $job)
		{
			echo '<li><a href="work.php?job='.$job->company.'" class="nava">'.$job->company.'</a></li>';
		}
		
		 

	?>
 