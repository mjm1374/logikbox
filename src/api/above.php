<?php
header("Access-Control-Allow-Origin: * ");
header('Content-Type: application/json');

require_once('./api.php');


$lat = "/" . $_GET['lat'];
$lng = "/" . $_GET['lng'];
$alt = "/" . $_GET['alt'];
$rad = "/" . $_GET['rad'];
$cat = "/" . $_GET['cat'];


$url = "above" . $lat . $lng . $alt . $rad . $cat;

$data = CallAPI("GET",  ENDPOINT . $url . N2YO);

//$file = file_get_contents(ENDPOINT . $url . N2YO, true);

print_r($data);
