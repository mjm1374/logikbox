
	<?php

	foreach ($jobs as $title => $job) {
		echo '<li><a href="/work.php?job=' . $job->url . '" class="nava">' . $job->company . '</a></li>';
	}



	?>
 