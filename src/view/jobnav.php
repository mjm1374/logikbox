
	<?php 

		foreach ($jobs as $title => $job)
		{
			echo '<li><a href="work.php?job='.$job->company.'">'.$job->company.'</a></li>';
		}
		
		 

	?>
 