/*jshint esversion: 6 */

function GetGroupResults(max_cnt){
	$.when(  $.get( 'https://worldcup.sfg.io/teams/group_results' ) )
	.then(function( groups ) {
        console.log("groups: ", groups);
        let worldcupBoard = $('.worldcup'); 
         
        
        for (let i = 0; i < groups.length; i++) {
            let groupString = "<div class='worldcup__group'><table class='worldcup__table'><thead><tr><th scope='col' class='left' title='GROUP ";
            let group = groups[i];
            let letter = group.letter;
            let teams = getTeams(group.ordered_teams);
            groupString += letter + "'>GROUP " + letter + "</th>";
            groupString += "<th scope='col' class='center' title='GP'>GP</th><th scope='col' class='center' title='W' > W </th><th scope='col' class='center' title='D'>D</th><th scope='col' class='center' title='L' > L </th><th scope='col' class='center' title='GD'>GD</th><th scope='col' class='center' title='P'> P </th></tr></thead>";
            groupString += teams;
            groupString += "</table></div>";
            worldcupBoard.append(groupString);
        }
        
        

        }
    ); 
} 

function getTeams(teams){
    let teamsString = "";
    //console.log(teams);
    for (let j = 0; j < teams.length; j++) {
        let team = teams[j];
        let name = team.country;
        teamsString += "<tr class='worldcup__teams worldcup__teams--shade" + j % 2 + "'>";
        teamsString += "<td><div class='worldcup__flag worldcup__flag--small' style='background-image: url(/img/flags/" + name.replace(" ", "") + ".svg)'></div><div class='worldcup__teamName' data-fifa='" + team.fifa_code + "' > " + name + " </div></td > ";
        teamsString += "<td class='center'>" + team.games_played + "</td>";
        teamsString += "<td class='center'>" + team.wins + "</td>";
        teamsString += "<td class='center'>" + team.draws + "</td>";
        teamsString += "<td class='center'>" + team.losses + "</td>";
        teamsString += "<td class='center'>" + team.goal_differential + "</td>";
        teamsString += "<td class='center'>" + team.points + "</td>";

        teamsString += "</tr>"; 

    }
    return teamsString;
}

function getMatches(team){
    $.when($.get('https://worldcup.sfg.io/matches/country?fifa_code=' + team))
        .then(function (matches) {
        
        let matchesString = "<div class='worldcup__group worldcup__group--matches'><table class='worldcup__table'><thead><tr><th scope='col' class='middle' title='Home'> Home </th><th scope='col' class='middle' title='date and score '></th> <th scope='col' class='middle' title='away' > Away </th></tr></thead> ";

        for(let i = 0; i < matches.length; i++){
            let match = matches[i];
            let date = new Date(match.datetime);
            let homeTeam = match.home_team_country;
            let awayTeam = match.away_team_country;
            let venue = match.location + ", " + match.venue;
            let homeScore = match.home_team.goals;
            let awyaScore = match.away_team.goals;
            let winner = match.winner;
            let shade = i % 2;

            matchesString += "<tr class=' worldcup__teams--shade" + shade + "'>";
            matchesString += "<td class='wordcup__teamAndFlag middle'><div class='worldcup__flag worldcup__flag--large' style='background-image: url(/img/flags/" + homeTeam.replace(" ", "") + ".svg)'></div><div class='worldcup__teamName";
            if (winner == homeTeam) matchesString += " worldcup__team--winner";
            matchesString += "'> " + homeTeam + " </div></td>";
            matchesString += "<td class='wordcup__score middle'><span class='small'>" + date.toLocaleDateString() + "<br/>" + date.toLocaleTimeString() +  "</span><br />" + homeScore + "  -  " + awyaScore + "<br/>" + venue + "</td>";
            matchesString += "<td class='wordcup__teamAndFlag middle'><div class='worldcup__flag  worldcup__flag--large' style='background-image: url(/img/flags/" + awayTeam.replace(" ", "") + ".svg)'></div><div class='worldcup__teamName";
            if (winner == awayTeam) matchesString += " worldcup__team--winner";
            matchesString += "'> " + awayTeam + " </div></td></tr>";
            
        }

        matchesString += "</table></div>";
        $('.worldcup__matches').html(matchesString);
        $('#worldcupModal').modal('show');
        return matchesString;
        });
    
}

jQuery(document).ready(function ($) {

    $(document).on('click', '.worldcup__teamName', function () {
        let thisTeam = $(this).data('fifa');
        getMatches(thisTeam);
    });
    
});

 