<?php
require_once 'vendor/autoload.php';
include_once("api-key.php");

$userTimezone = new DateTimeZone('America/New_York');
$gmtTimezone = new DateTimeZone('GMT');

Unirest\Request::verifyPeer(false);
if ($mode == 'prod') {
    $myTeam = 50; // live
    $myLeagueCurrentSeason = 524;
    $myLeagueNextSeason = 524;
} else {
    $myTeam = 13; // dev
    $myLeagueCurrentSeason = 2;
    $myLeagueNextSeason = 524;
}


//https:api-football-v1.p.rapidapi.com/v2/teams/team/{id}


function getStandings($myLeague)
{
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

function getFixturess($myLeague, $myTeam)
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

//cache checking
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
    or die('Could not connect to the database server' . mysqli_connect_error());

$time = time();
$time = $time - (60 * $cacheTime);

// Perform queries 
$cacheSet = mysqli_query($con, "SELECT * FROM football_cache WHERE fc_timestamp >= FROM_UNIXTIME($time)");
 
if($cacheSet === FALSE) {
    $rowcount = mysqli_num_rows($cacheSet);
}else{
   $rowcount = 0; 
}
//echo $rowcount;

if($rowcount == 0){
    $standings =  getStandings($myLeagueCurrentSeason);
    $teams = $standings->body->api->standings[0];
    $rankings = getRankHTML($teams, $myTeam);
    
    $myInsert = mysqli_query($con, "INSERT INTO football_cache (fc_content,fc_timestamp) VALUES ('$rankings',Now())");
} else{
    $row = mysqli_fetch_array($cacheSet, MYSQLI_ASSOC);
    $rankings =  $row["fc_content"];
    mysqli_free_result($cacheSet);
}


$fixtures = getFixturess($myLeagueCurrentSeason, $myTeam);


$games = $fixtures->body->api->fixtures;

$con->close();
//var_dump($standings->body);



function getRankHTML($teams, $myTeam){
$html = '';
foreach ($teams as $team) {
            //echo $team->team_id;
            $teamInfo = $team;
            $showTeam = "hide";
            if ($team->team_id == $myTeam) {
                $showTeam = "show";
                $myteamRank = $teamInfo->rank;
            }
            $logo = checkLogo($teamInfo->logo);
            $teamStanding  = $teamInfo->all;
                $html = $html . '<div class="football_flex football__item football_teams football_team--'. $teamInfo->rank . ' football_team--' . $showTeam . '">';

                $html = $html . '<div class="football__logo" style="background-image:url(' . $logo . ');"></div>';

                $html = $html . '<div class="football_teamData"> <h2 class="football_title">' . $teamInfo->teamName . '</h2><div class="football_rank">' . $teamInfo->group . '</div>';

                $html = $html . '<table class="footbal__table">
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
                        <tr>';
                            $html = $html . '<td class="football__table__td__div">' . $teamInfo->rank . '</td>';
                            $html = $html . '<td class="football__table__td__div">' . $teamStanding->matchsPlayed . '</td> ';
                            $html = $html . '<td class="football__table__td__div">' . $teamStanding->win . '</td> ';
                            $html = $html . '<td class="football__table__td__div">' . $teamStanding->draw . '</td> ';
                            $html = $html . '<td class="football__table__td__div">' . $teamStanding->lose . '</td> ';
                            $html = $html . '<td class="football__table__td__div">' . $teamStanding->goalsFor . '</td> ';
                            $html = $html . '<td class="football__table__td__div">' . $teamStanding->goalsAgainst . '</td> ';
                            $html = $html . '<td class="football__table__td__div">' . $teamInfo->goalsDiff . '</td> ';
                            $html = $html . '<td class="football__table__td__div">' . $teamInfo->points . '</td> ';
                    $html = $html . '</tr> </table> ';
                    $html = $html . '<div class="football_rank"><span class="bold">Form:</span> ' . $teamInfo->forme . '</div> ';
                    $html = $html . '</div><div class="football__item--scroller">
                            <div class="football__item--up" data-dir="up" aria-label="Rank up"></div>
                            <div class=" football__item--down" data-dir="down" aria-label="Rank down"></div>
                        </div>
                    </div>';

        } // end the rankings loop
    
        $html = $html . '<script> let currentRank = ' . $myteamRank .';</script>';

    return $html;
}

?>

<div class="football">
    <div class="foootball__inner">
        <?php
        
        echo $rankings;

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
        if ($nextGame == null) {
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



        <div class="football__item mobile__hide">
            <h4 class="football_title">Last Man City Game</h4>
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
        <div class="football__item ipad__hide mobile__hide" <?php if ($nextGame == null) { ?> style="background-image:url(img/sad-soccer.jpg)" <?php } ?>>
            <h4 class="football_title">Next Man City Game </h4>
            <?php if ($nextGame == null) {
                echo "<h5>Next Season</h5>";
            } else {

                $awayTeam = $nextGame->awayTeam;
                $homeTeam = $nextGame->homeTeam;
                $myDateTime = new DateTime($nextGame->event_date, $gmtTimezone);
                $offset = $userTimezone->getOffset($myDateTime);
                $myInterval = DateInterval::createFromDateString((string) $offset . 'seconds');
                $myDateTime->add($myInterval);
                $gameTime = $myDateTime->format('M d, Y H:i A');

                ?> <table class="football__matchInfo">
                    <tr>
                        <td class="football__match__teamLogo">
                            <div class="football__match__logo" style="background-image:url(<?php echo checkLogo($homeTeam->logo); ?>);"></div>
                            <span class="fottball__match__teamName"><?php echo $homeTeam->team_name; ?></span>
                        </td>
                        <td class="football_MatchData">
                            <?php echo $gameTime; ?><br />
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

