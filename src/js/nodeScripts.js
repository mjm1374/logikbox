
var SportmonksApi = require('sportmonks').SportmonksApi;
var sportmonks = new SportmonksApi('XLLBWCMEyXePNyNrIbi9OMnX7pvoOR83RSncC6dGuwNBLMtCyF9SyJRxCaIX');



var callTeam = function (teamid){
    sportmonks.get('v2.0/teams/{id}', { id: teamid, competitions: true }).then( function(response){
        console.log(response.data.name);
        $('#sportsBlock').html(response.data.name);
    });
}
callTeam(85);
console.log('3'); 


