<?php
require_once 'vendor/autoload.php';
include_once("api-key.php");

//$endpoint = "https://api-football-v1.p.rapidapi.com/v2/"; // Live endpoint
$endpoint = "http://www.api-football.com/demo/api/v2/"; // Demo endpoint

https: //api-football-v1.p.rapidapi.com/v2/teams/team/

$response = Unirest\Request::get(
    $endpoint . "teams/team/13",
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

        // var_dump($response->body->api->teams[0]);
        // echo "<br>";
        $team = $response->body->api->teams[0];
        $logo = $team->logo;
        if($logo == "Not available in Demo" || $logo == NULL ){
            $logo = "img/football_noLogo.png";
        }
        ?>
        <div class="football__item">
            <div class="football__logo" style="background-image:url(<?php echo $logo; ?>);"></div>
            <h2 class="football_title"><?php echo $team->name; ?></h2>
        </div>
        <div class="football__item">
            <h2 class="football_title">Last Game</h2>
        </div>
        <div class="football__item">
            <h2 class="football_title">Next Game</h2>
        </div>
    </div>
</div>