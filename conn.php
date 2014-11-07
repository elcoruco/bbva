<?php
include_once('BBVA.php');
include_once('.keys.php');

// The $id and the $key are inside .keys.php
$bbva = new BBVA($id, $key);
/*
* Categories
* ----------------------------------------------------

$categories = $bbva->get_categories();
header("Content-Type: application/json");
echo $categories;
*/

/*
* Top zips
* ----------------------------------------------------
*/
$top_zips = $bbva->top_zips();
header("Content-Type: application/json");
echo $top_zips;

?>