function GetSpaceX(max_id){
	$.when(  $.get( 'https://api.spacexdata.com/v3/launches/upcoming?limit=3', 
	{ access_token: access_token, max_id: max_id } ) )
	.then(function( result ) {
        let launches = result;
        console.log(launches);

        for(i=0; i < launches.length; i++){
            let target = $('#launchBlock' +i);

            target.find(".launch__mission__name").html(launches[i].mission_name);
            target.find(".launch__rocket").html(launches[i].rocket.rocket_name);
            target.find(".launch__date").html(launches[i].launch_date_unix);
            target.find(".launch__site").html(launches[i].launch_site.site_name_long);
            target.find(".launch__details").html(launches[i].details);
            target.find(".launch__img").html();
        }

    }
    );
} 

{/* <div class="launch__mission__name"></div>
<div class="launch__rocket"></div>
<div class="launch__date"></div>
<div class="launch__details"></div>
<div class="launch__site"></div>
<div class="launch__img"></div> */}