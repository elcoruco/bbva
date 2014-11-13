<?php
include_once('BBVA.php');
include_once('.keys.php');

// The $id and the $key are inside .keys.php
$bbva = new BBVA($id, $key);

$lat  = 20.676;
$lng  = -103.342;

$zipcode = "64102";

$res  = $bbva->get_categories();

header("Content-Type: application/json");
echo $res;

?>