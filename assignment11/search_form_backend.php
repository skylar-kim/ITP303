<?php 
require("config/nasa-creds.php");
require 'config/config.php';

// 1. Create Data
$data = array (
	"api_key" => $api_key,
	"start_date" => $_GET["searchDate"],
	"end_date" => $_GET["searchDate"]
);

// 2. Determine URL
$url = "https://api.nasa.gov/planetary/apod?" . http_build_query($data);

//echo $url;

// 3. Make request
// initialize curl session
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
));

// 4. Parse Response
$response = curl_exec($curl);

// get the response 


// 5. Filter Response (only get what you need)
// actually I need everything from the JSON response so just
// send to frontend
header('Content-Type: application/json');
echo $response;






 ?>