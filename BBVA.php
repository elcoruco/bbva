<?php
/*
*
*/

// include_once('.key.php');
// GET THE BASIC USER DATA
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_USERPWD, "APPI_ID:API_KEY");
 curl_setopt($ch, CURLOPT_URL, 'https://apis.bbvabancomer.com/datathon/info/merchants_categories' );
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
 $result = curl_exec($ch);
 // show the JSON response
 header("Content-Type: application/json");
 echo $result;

// END of library BBVA