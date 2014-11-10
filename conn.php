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

$top_zips = $bbva->top_zips();
header("Content-Type: application/json");
echo $top_zips;
*/

/*
* Top tiles
* ----------------------------------------------------

// get tiles
$top_tiles = $bbva->top_tiles();
header("Content-Type: application/json");
echo $top_tiles;
*/

/*
* Base stats (tiles)
* ----------------------------------------------------

$lat = 20.676;
$lng = -103.342;
$base_stats = $bbva->tiles_base_stats($lat, $lng);
header("Content-Type: application/json");
echo $base_stats;
*/

/*
* Top zips by tile
* ----------------------------------------------------

$lat = 20.676;
$lng = -103.342;
$top_zips_by_tile = $bbva->top_zips_by_tile($lat, $lng);
header("Content-Type: application/json");
echo $top_zips_by_tile;
*/

/*
* Age distribution by tile
* ----------------------------------------------------
*/
$lat = 20.676;
$lng = -103.342;
$age_distribution_by_tile = $bbva->age_distribution_by_tile($lat, $lng);
header("Content-Type: application/json");
echo $age_distribution_by_tile;

?>