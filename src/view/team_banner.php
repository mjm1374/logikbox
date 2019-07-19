<?php
require_once 'vendor/autoload.php';
include_once("api-key.php");

$myTeam = 13;
$myLeague = 2;

//https:api-football-v1.p.rapidapi.com/v2/teams/team/{id}

$response = Unirest\Request::get(
    $endpoint . "teams/team/" . $myTeam,
    array(
        "X-RapidAPI-Key" => $footballKey,
        "Accept" => "application/json"
    )
);

$standings = Unirest\Request::get(
    $endpoint . "leagueTable/" . $myLeague,
    array(
        "X-RapidAPI-Key" => $footballKey,
        "Accept" => "application/json"
    )
);
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
        //$team = $response->body->api->teams[0];
        
        
        $teams = $standings->body->api->standings[0];

        foreach ($teams as $obj) {
            //echo $obj->team_id;
            if($obj->team_id == $myTeam){
                $teamInfo = $obj;
            } 
        }

        $logo = $teamInfo->logo;
        if ($logo == "Not available in Demo" || $logo == NULL) {
            $logo = "img/football_noLogo.png";
        }

        ?>
        <div class="football__item">
            <div class="football__logo" style="background-image:url(<?php echo $logo; ?>);"></div>
            
            <h2 class="football_title"><?php echo $teamInfo->teamName; ?></h2>
        </div>
        <div class="football__item">
            <h2 class="football_title">Last Game</h2>
        </div>
        <div class="football__item">
            <h2 class="football_title">Next Game</h2>
        </div>
    </div>
</div>