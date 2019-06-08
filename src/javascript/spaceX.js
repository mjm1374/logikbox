function GetSpaceX(max_id){
	$.when(  $.get( 'https://api.spacexdata.com/v3/launches/upcoming?limit=3', 
	{ access_token: access_token, max_id: max_id } ) )
	.then(function( result ) {
        let launches = result;
        console.log(launches);

        for(i=0; i < launches.length; i++){
            let target = $('#launchBlock' +i);
            let rocket = launches[i].rocket.rocket_id;
            let payload = launches[i].rocket.second_stage.payloads[0].payload_type;
            let rocketImg = 'falcon9.png';
            let launchDate = timeConverter(launches[i].launch_date_unix);

            if(rocket == 'falconheavy') { rocketImg = 'falconheavy.png'; }
            if(payload.toLowerCase().indexOf("dragon") >= 0) { rocketImg = 'dragon.png'; }


            if(launches[i].details == '' || launches[i].details == null) {
                launches[i].details = "<span class=''>There are no details available for this mission.</span>";
            }
            

            target.find(".launch__mission__name").html(launches[i].mission_name);
            target.find(".launch__rocket").html(launches[i].rocket.rocket_name);
            target.find(".launch__date").html(launchDate);
            target.find(".launch__site").html(launches[i].launch_site.site_name_long);
            target.find(".launch__details").html(launches[i].details);
            target.find(".launch__img").attr('src','/img/spacex/' + rocketImg);
        }

    }
    );
} 

function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp * 1000);
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours(); 
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = month + ' ' +  date  + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
    return time;
  }

{/* <div class="launch__mission__name"></div>
<div class="launch__rocket"></div>
<div class="launch__date"></div>
<div class="launch__details"></div>
<div class="launch__site"></div>
<div class="launch__img"></div> */}