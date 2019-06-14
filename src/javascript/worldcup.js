

function GetGroupResults(max_cnt){
	$.when(  $.get( 'https://worldcup.sfg.io/teams/group_results' ) )
	.then(function( groups ) {
        console.log(groups);
        let worldcupBoard = $('.worldcup');
        
        
        for (i = 0; i < groups.length; i++) {
            let groupString = "<div class='worldcup__group'><table class='worldcup__table'><thead><tr><th scope='col' class='left' title='GROUP ";
            let group = groups[i];
            let letter = group.letter;
            let teams = getTeams(group.ordered_teams);
            groupString += letter + "'>GROUP " + letter + "</th>";
            groupString += "<th scope='col' class='center' title='GP'>GP</th><th scope='col' class='center' title='W' > W </th><th scope='col' class='center' title='D'>D</th><th scope='col' class='center' title='L' > L </th><th scope='col' class='center' title='GD'>GD</th><th scope='col' class='center' title='P'> P </th></tr></thead>"
            groupString += teams;
            groupString += "</table></div>";
            worldcupBoard.append(groupString);
        }
        
        

        }
    ); 
} 

function getTeams(teams){
    let teamsString = "";
    console.log(teams);
    for (j = 0; j < teams.length; j++) {
        let team = teams[j];
        let name = team.country;
        teamsString += "<tr class='worldcup__teams worldcup__teams--shade" + j % 2 + "'>";
        teamsString += "<td><div class='worldcup__flag' style='background-image: url(/img/flags/" + name.replace(" ", "") + ".svg'></div><div class='worldcup__teamName'>" + name + "</div></td>";
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