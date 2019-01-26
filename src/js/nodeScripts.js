
var SportmonksApi = require('sportmonks').SportmonksApi;
var sportmonks = new SportmonksApi('XLLBWCMEyXePNyNrIbi9OMnX7pvoOR83RSncC6dGuwNBLMtCyF9SyJRxCaIX');

sportmonks.get('v2.0/teams/{id}', { id: 85, competitions: true }).then( function(response){
    console.log(response);
    $('#sportsBlock').innerHTML(response.name);
});

