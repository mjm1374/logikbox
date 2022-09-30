<?php
header("Access-Control-Allow-Origin: * ");
header('Content-Type: application/json');

require_once('./api.php');


$station = "/" . $_GET['station'];
$count = "/" . $_GET['count'];


$url = "Arrivals/" . $station . $count;

$data = CallAPI("GET",  SEPTA . $url);

//$file = file_get_contents(ENDPOINT . $url . N2YO, true);

print_r($data);
