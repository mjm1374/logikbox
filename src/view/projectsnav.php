
	<?php

	foreach ($projects as $title => $project) {
		if ($project->active == 1) {
			echo '<li><a href="' . $project->link . '" class="nava">' . $project->name . '</a></li>';
		}
	}



	?>
 