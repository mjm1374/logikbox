/*jshint esversion: 6 */ 
//https://api-football-v1.p.rapidapi.com/v2/leagues/league/2
//https://api-football-v1.p.rapidapi.com/v2/fixtures/team/50/2
let city = 33;
let prem = 2;


 let GetTable = (league_id) => {

    $.ajax({
        type: "GET",
        url: "https://api-football-v1.p.rapidapi.com/v2/leagueTable/" + league_id,
        headers: {
            'X-RapidAPI-Key': 'Rd2pyVFguwJeulnqTswlZ2pJCrlurqnE'
        },

        success: function (result) {
            //set your variable to the result 
            //console.log(result);
            return result;
        },
        error: function (result) {
            //handle the error 
            //console.log(result);
            return result;
        }
    });

};