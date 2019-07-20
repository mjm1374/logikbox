<?php
require_once 'vendor/autoload.php';
include_once("api-key.php");

Unirest\Request::verifyPeer(false);
if ($mode == 'prod') {
    $myTeam = 50; // live
    $myLeagueCurrentSeason = 2;
    $myLeagueNextSeason = 524;
} else {
    $myTeam = 13; // live
    $myLeagueCurrentSeason = 2;
    $myLeagueNextSeason = 524;
}


//https:api-football-v1.p.rapidapi.com/v2/teams/team/{id}


function getStandings($myLeague){
    // Get teams for team info
    $standings = Unirest\Request::get(
        $GLOBALS['endpoint'] . "leagueTable/" . $myLeague,
        array(
            "X-RapidAPI-Key" => $GLOBALS['footballKey'],
            "Accept" => "application/json"
        )
    );
    return $standings;
}

function getFixturess($myLeague, $myTeam  )
{
    // Get team schedule for last and next
    $fixtures = Unirest\Request::get(
        $GLOBALS['endpoint'] . "fixtures/team/" . $myTeam . "/" . $myLeague,
        array(
            "X-RapidAPI-Key" => $GLOBALS['footballKey'],
            "Accept" => "application/json"
        )
    );
    return $fixtures;
}



function checkLogo($logo)
{
    if ($logo == "Not available in Demo" || $logo == NULL) {
        $logo = "img/football_noLogo.png";
        //$logo = "https://www.api-football.com/public/teams/50.png";
    }

    return $logo;
}

    $standings =  getStandings($myLeagueCurrentSeason);
    $fixtures = getFixturess($myLeagueCurrentSeason, $myTeam);

    $teams = $standings->body->api->standings[0];
    $games = $fixtures->body->api->fixtures;

//var_dump($standings->body);
?>

<div class="football">
    <div class="foootball__inner">
        <?php
// League
// ["results"]=> int(1) ["leagues"]=> array(1) { [0]=> object(stdClass)#7 (11) { ["league_id"]=> int(2) ["name"]=> string(14) "Premier League" ["country"]=> string(7) "England" ["country_code"]=> string(2) "GB" ["season"]=> int(2018) ["season_start"]=> string(10) "2018-08-10" ["season_end"]=> string(10) "2019-05-12" ["logo"]=> string(49) "https://www.api-football.com/public/leagues/2.png" ["flag"]=> string(48) "https://www.api-football.com/public/flags/gb.svg" ["standings"]=> int(1) ["is_current"]=> int(0) } } } } >

// Team
// { ["team_id"]=> int(13) ["name"]=> string(15) "Manchester City" ["code"]=> NULL ["logo"]=> string(21) "Not available in Demo" ["country"]=> string(7) "England" ["founded"]=> int(1880) ["venue_name"]=> string(14) "Etihad Stadium" ["venue_surface"]=> string(5) "grass" ["venue_address"]=> string(14) "Rowsley Street" ["venue_city"]=> string(10) "Manchester" ["venue_capacity"]=> int(55097) }

//var_dump($standings->body->api->standings[0]);

//array(20) { [0]=> object(stdClass)#24 (13) { ["rank"]=> int(1) ["team_id"]=> int(13) ["teamName"]=> string(15) "Manchester City" ["logo"]=> string(21) "Not available in Demo" ["group"]=> string(14) "Premier League" ["forme"]=> string(5) "WWWWW" ["description"]=> string(42) "Promotion - Champions League (Group Stage)" ["all"]=> object(stdClass)#25 (6) { ["matchsPlayed"]=> int(37) ["win"]=> int(31) ["draw"]=> int(2) ["lose"]=> int(4) ["goalsFor"]=> int(91) ["goalsAgainst"]=> int(22) } ["home"]=> object(stdClass)#26 (6) { ["matchsPlayed"]=> int(19) ["win"]=> int(18) ["draw"]=> int(0) ["lose"]=> int(1) ["goalsFor"]=> int(57) ["goalsAgainst"]=> int(12) } ["away"]=> object(stdClass)#27 (6) { ["matchsPlayed"]=> int(18) ["win"]=> int(13) ["draw"]=> int(2) ["lose"]=> int(3) ["goalsFor"]=> int(34) ["goalsAgainst"]=> int(10) } ["goalsDiff"]=> int(69) ["points"]=> int(95) ["lastUpdate"]=> string(10) "2019-05-08" }

// echo "<br>";
//$team = $response->body->api->teams[0]; // I commented this out while high. pay attention, either kill the api call or re-establish this object.


   


        foreach ($teams as $team) {
            //echo $team->team_id;
            if ($team->team_id == $myTeam) {
                $teamInfo = $team;
            }
        }

        $logo = checkLogo($teamInfo->logo);

        $standings  = $teamInfo->all;

        $today = time();
        //$today = '1540321200';
        $lastGame = null;
        $nextGame = null;
        $filter = 0;

        foreach ($games as $game) {
            //echo $game->event_timestamp . "<br />";
            if ($game->event_timestamp < $today) {
                $lastGame = $game;
            }

            if ($game->event_timestamp >= $today && $filter == 0) {
                $nextGame = $game;
                $filter = 1;
            }
        }

        // no next game, try next season
        if($nextGame == null){
            $fixtures = getFixturess($myLeagueNextSeason, $myTeam);
            $games = $fixtures->body->api->fixtures;

            foreach ($games as $game) {
                
                if ($game->event_timestamp >= $today && $filter == 0) {
                    $nextGame = $game;
                    $filter = 1; 
                }
            }

        }

        ?>
        <div class="football_flex football__item">
            <div class="football__logo" style="background-image:url(<?php echo $logo; ?>);"></div>

            <div class="football_teamData">
                <h2 class="football_title"><?php echo $teamInfo->teamName; ?></h2>
                <div class="football_rank"><?php echo $teamInfo->group; ?></div>

                <table class="footbal__table">
                    <tr class="footbal__table_tr">
                        <th class="football__table__header">
                            <div aria-label="Rank">Rank</div>
                        </th>
                        <th class="football__table__header">
                            <div aria-label="Matches played">MP</div>
                        </th>
                        <th class="football__table__header">
                            <div aria-label="Wins">W</div>
                        </th>
                        <th class="football__table__header">
                            <div aria-label=" Draws">D</div>
                        </th>
                        <th class="football__table__header">
                            <div aria-label=" Losses">L</div>
                        </th>
                        <th class="football__table__header">
                            <div aria-label=" Goals scored">GF</div>
                        </th>
                        <th class="football__table__header">
                            <div aria-label=" Goals against">GA</div>
                        </th>
                        <th class="football__table__header">
                            <div aria-label="Goal difference">GD</div>
                        </th>
                        <th class="football__table__header">
                            <div aria-label="Points">Pts</div>
                        </th>

                    </tr>
                    <tr>
                        <td class="football__table__td__div"><?php echo $teamInfo->rank; ?></td>
                        <td class="football__table__td__div"><?php echo $standings->matchsPlayed; ?></td>
                        <td class="football__table__td__div"><?php echo $standings->win; ?></td>
                        <td class="football__table__td__div"><?php echo $standings->draw; ?></td>
                        <td class="football__table__td__div"><?php echo $standings->lose; ?></td>
                        <td class="football__table__td__div"><?php echo $standings->goalsFor; ?></td>
                        <td class="football__table__td__div"><?php echo $standings->goalsAgainst; ?></td>
                        <td class="football__table__td__div"><?php echo $teamInfo->goalsDiff; ?></td>
                        <td class="football__table__td__div"><?php echo $teamInfo->points; ?></td>

                    </tr>
                </table>

                <div class="football_rank"><span class="bold">Form:</span> <?php echo $teamInfo->forme; ?></div>
            </div>
        </div>
        <div class="football__item">
            <h4 class="football_title">Last Game</h4>
            <?php
            $awayTeam = $lastGame->awayTeam;
            $homeTeam = $lastGame->homeTeam;
            ?>
            <table class="football__matchInfo">
                <tr>
                    <td class="football__match__teamLogo">
                        <div class="football__match__logo" style="background-image:url(<?php echo checkLogo($homeTeam->logo); ?>);"></div>
                        <span class="fottball__match__teamName"><?php echo $homeTeam->team_name; ?></span>
                    </td>
                    <td class="football_MatchData">
                        <?php echo date_format(date_create($lastGame->event_date), 'M d, Y'); ?><br />
                        <span class="football__match__score"><?php echo $lastGame->goalsHomeTeam .  " - " . $lastGame->goalsAwayTeam; ?></span><br />
                        <span class="football__venue"><?php echo $lastGame->venue; ?></span>
                    </td>

                    <td class="football__match__teamLogo">
                        <div class="football__match__logo" style="background-image:url(<?php echo checkLogo($awayTeam->logo); ?>);"></div>
                        <span class="fottball__match__teamName"><?php echo $awayTeam->team_name; ?></span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="football__item" <?php if ($nextGame == null) { ?> style = "background-image:url(img/sad-soccer.jpg)" <?php } ?> >
            <h4 class ="football_title">Next Game </h4>
                <?php if ($nextGame == null) {
                    echo "<h5>Next Season</h5>";
                } else {

                    $awayTeam = $nextGame->awayTeam;
                    $homeTeam = $nextGame->homeTeam;
                    //$Timezone = new DateTimeZone('America / New_York');
                    ?> <table class="football__matchInfo">
                    <tr>
                        <td class="football__match__teamLogo">
                            <div class="football__match__logo" style="background-image:url(<?php echo checkLogo($homeTeam->logo); ?>);"></div>
                            <span class="fottball__match__teamName"><?php echo $homeTeam->team_name; ?></span>
                        </td>
                        <td class="football_MatchData">
                            <?php echo date_format(date_create($nextGame->event_date), 'M d, Y -  H:i'); ?><br />
                            <span class="football__match__score"><?php echo $nextGame->goalsHomeTeam .  " - " . $nextGame->goalsAwayTeam; ?></span><br />
                            <span class="football__venue"><?php echo $nextGame->venue; ?></span>

                        </td>

                        <td class="football__match__teamLogo">
                            <div class="football__match__logo" style="background-image:url(<?php echo checkLogo($awayTeam->logo); ?>);"></div>
                            <span class="fottball__match__teamName"><?php echo $awayTeam->team_name; ?></span>
                        </td>
                    </tr>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>