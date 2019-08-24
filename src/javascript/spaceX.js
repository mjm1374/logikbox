function GetSpaceX(max_cnt){
	$.when(  $.get( 'https://api.spacexdata.com/v3/launches/upcoming', 
	{ limit: max_cnt, tbd: 'false' } ) )
	.then(function( result ) {
            let launches = result;
            var promises = [];
            
            for(let i=0; i < launches.length; i++){
                buildTargetBlock(i);
                let rocket = launches[i].rocket.rocket_id;
                let rocketImg = 'falcon9.png';
                let rocketName = launches[i].rocket.rocket_name;
                let payload = launches[i].rocket.second_stage.payloads[0].payload_type;
                let missionID = '';
                let launchDate = tardis.MonthDateTime(launches[i].launch_date_unix) + '<br /><span class="italic">';
                if (launches[i].is_tentative) {launchDate = launchDate + 'tenative up to a ' + launches[i].tentative_max_precision; }else{ launchDate = launchDate + '&nbsp;';}
                launchDate = launchDate + '</span>';
                let description = '';
                let target = $('#launchBlock' + i); 
                
                if(launches[i].mission_id.length > 0){ missionID = launches[i].mission_id[0]; }
                if(rocket == 'falconheavy') { rocketImg = 'falconheavy.png'; }
                if(payload.toLowerCase().indexOf("dragon") >= 0) { rocketImg = 'dragon.png'; }
                if(launches[i].details == '' || launches[i].details == null) {
                    let details;
                    description = $.ajax({url: 'https://api.spacexdata.com/v3/missions/' + missionID, success: function( mission ) {
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
    let targetBlock = `<div class="col-md-4"><div id="launchBlock${i}" class="launchContainer">
                <img src="" class="launch__img launch__copy" />
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