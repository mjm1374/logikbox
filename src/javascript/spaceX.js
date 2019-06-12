function GetSpaceX(max_cnt){
	$.when(  $.get( 'https://api.spacexdata.com/v3/launches/upcoming', 
	{ limit: max_cnt } ) )
	.then(function( result ) {
        let launches = result;
        //console.log(launches);
        var promises = [];

        for(i=0; i < launches.length; i++){
            buildTargetBlock(i);
            let rocket = launches[i].rocket.rocket_id;
            let rocketImg = 'falcon9.png';
            let rocketName = launches[i].rocket.rocket_name;
            let payload = launches[i].rocket.second_stage.payloads[0].payload_type;
            let missionID = '';
            let launchDate = timeConverter(launches[i].launch_date_unix);
            let description = '';
            let target = $('#launchBlock' + i); 
            
            
            if(launches[i].mission_id.length > 0){  missionID = launches[i].mission_id[0];}
            if(rocket == 'falconheavy') { rocketImg = 'falconheavy.png'; }
            if(payload.toLowerCase().indexOf("dragon") >= 0) { rocketImg = 'dragon.png'; }
            if(launches[i].details == '' || launches[i].details == null) {
                description =  $.ajax({url: 'https://api.spacexdata.com/v3/missions/' + missionID, success: function( mission ) {
                    //console.log("mission",mission);
                    details = mission.description;
                    if(details == '' || details == null){ details = "<span class=''>There are no details available for this mission.</span>"; }
                    target.find(".launch__details").html(details);
                    }});
                promises.push(description);
            } else {
                description = launches[i].details;
                target.find(".launch__details").html(description);
            }
            
            target.find(".launch__mission__name").html(launches[i].mission_name);
            target.find(".launch__rocket").html(launches[i].rocket.rocket_name);
            target.find(".launch__date").html(launchDate);
            target.find(".launch__site").html(launches[i].launch_site.site_name_long);
            target.find(".launch__img").attr('src','/img/spacex/' + rocketImg);
            target.find(".launch__img").attr('alt', rocketName);
        }
        $.when.apply(null, promises).done(function(){
            //console.log('All done')
        });

    }
    );
} 

function buildTargetBlock(i){
    let targetBlock = '<div class="col-md-4"><div id="launchBlock' + i + '" class="launchContainer">';
    targetBlock	= targetBlock +	`<img src="" class="launch__img launch__copy" />
                <div class="launch__mission__name launch__copy"></div>
                <div class="launch__rocket launch__copy"></div>
                <div class="launch__date launch__copy"></div>
                <div class="launch__site launch__copy"></div>
                <hr />
                <div class="launch__details launch__copy"></div>
            </div>
        </div>`;
        
        $('#launchBlockHolder').append(targetBlock);
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