<div class="jumbotron">
      <div class="container">

				
        <h1><?php echo $job->company ; ?> </h1>
        <p>
          <?php echo $job->title ;?>
        </p>
       
			
		
      </div>
    </div>
 
 <div class="container">
      <!-- Example row of columns -->
      <div class="row">
		<div class="col-md-2">
         
        </div>
        <div class="col-md-8">
          <h3>Things I did....</h3>
          <p><img src="/img/<?php echo $job->logo ; ?>" class="logoimgLeft" alt="<?php echo $job->company ; ?>">
          <h4><?php echo $job->company ; ?></h4>
          <h5><?php echo $job->title ; ?></h5>
          <?php echo $job->description ; ?></p>
	    <a class="btn btn-default" href="<?php echo $job->link ; ?>/" role="button" target="_blank" rel="noopener">View Site &raquo;</a> 
       </div>
        <div class="col-md-2">
        
        </div>
      </div>
