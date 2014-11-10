<?php
include_once('BBVA.php');
include_once('.keys.php');

// The $id and the $key are inside .keys.php
$bbva = new BBVA($id, $key);
$lat  = 20.676;
$lng  = -103.342;
$res  = [];

header("Content-Type: application/json");
echo $res;

?>