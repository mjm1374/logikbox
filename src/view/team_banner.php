<?php
require_once 'vendor/autoload.php';
include_once("api-key.php");

$userTimezone = new DateTimeZone('America/New_York');
$gmtTimezone = new DateTimeZone('GMT');

Unirest\Request::verifyPeer(false);
if ($mode == 'prod') {
    $myTeam = 50; // live
    $myLeagueCurrentSeason = 2;
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

$standings =  getStandings($myLeagueCurrentSeason);
$fixtures = getFixturess($myLeagueCurrentSeason, $myTeam);

$teams = $standings->body->api->standings[0];
$games = $fixtures->body->api->fixtures;

//var_dump($standings->body);
?>

<div class="football">
    <div class="foootball__inner">
        <?php

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
            ?>
            <div class="football_flex football__item football_teams football_team--<?php echo $teamInfo->rank; ?> football_team--<?php echo $showTeam; ?> ">

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
                            <td class="football__table__td__div"><?php echo $teamStanding->matchsPlayed; ?></td>
                            <td class="football__table__td__div"><?php echo $teamStanding->win; ?></td>
                            <td class="football__table__td__div"><?php echo $teamStanding->draw; ?></td>
                            <td class="football__table__td__div"><?php echo $teamStanding->lose; ?></td>
                            <td class="football__table__td__div"><?php echo $teamStanding->goalsFor; ?></td>
                            <td class="football__table__td__div"><?php echo $teamStanding->goalsAgainst; ?></td>
                            <td class="football__table__td__div"><?php echo $teamInfo->goalsDiff; ?></td>
                            <td class="football__table__td__div"><?php echo $teamInfo->points; ?></td>

                        </tr>
                    </table>

                    <div class="football_rank"><span class="bold">Form:</span> <?php echo $teamInfo->forme; ?></div>
                </div>
                <div class="football__item--scroller">
                    <div class="football__item--up" data-dir="up" aria-label="Rank up"></div>
                    <div class=" football__item--down" data-dir="down" aria-label="Rank down"></div>
                </div>

            </div>

        <?php

        } // end the rankings loop


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

<script>
    let currentRank = <?php echo $myteamRank; ?>
</script>