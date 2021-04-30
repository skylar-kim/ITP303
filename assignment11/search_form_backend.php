<?php 
require("config/nasa-creds.php");
// require 'config/config.php';

// Check database to see if the search result is already in the DB
$mysqli = new mysqli('303.itpwebdev.com', 'kimsooye_db_user', 'uscitp2021!', 'kimsooye_astra_db');

if ($mysqli->connect_errno) {
	echo $mysqli->connect_error;
	exit();
}

// $_GET["searchDate"] = "2020-01-01";

$sqlDate = $mysqldate = date('Y-m-d', strtotime($_GET["searchDate"]));

$sqlSelect = $mysqli->prepare("SELECT * FROM photos WHERE photo_date = ?;");

$sqlSelect->bind_param("s", $sqlDate);

$sqlSelect->execute();

$sqlSelect->store_result();

if ($sqlSelect->num_rows > 0) {
	// photo data is already cached in DB
	$sqlSelect->execute();

	$result = $sqlSelect->get_result();

	$row = $result->fetch_assoc();

	// echo "here" . "<hr>" ;
	// echo "<hr>" . var_dump($row);

	// echo "<hr>" . $row["url"];
	$url = $row["url"];
	$title = $row["title"];
	$photoDate = $row["photo_date"];
	$mediaType = $row["media_type"];
	$copyright = "";
	if ( isset($row["copyright"]) && !empty($row["copyright"]) ) {
		$copyright = $row["copyright"];
	}
	$explanation = $row["explanation"];

	$jsonResponse = array();
	$jsonResponse[] = array("url" => $url, "title" => $title, "date" => $photoDate, "media_type" => $mediaType, "copyright" => $copyright, "explanation" => $explanation);

	
	echo json_encode($jsonResponse);


}
else {
	// photo data is new - must grab from API

	// 1. Create Data
	$data = array (
		"api_key" => $api_key,
		"start_date" => $_GET["searchDate"],
		"end_date" => $_GET["searchDate"]
	);

	// $data = array (
	// 	"api_key" => $api_key,
	// 	"start_date" => "2020-01-01",
	// 	"end_date" => "2020-01-01"
	// );

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
	
	$responseCopy = json_decode($response, true);

	$filteredResponse = array();

	// This will parse out result from the JSON data and store into associative array
	foreach ($responseCopy as $key => $result) { 
		foreach($result as $key => $value) {
			// echo "<hr>" . $key; 
			// echo "<hr>" . $value; 
			$filteredResponse[$key] = $value;

		}
	}


	// add the API JSON response to the database to "cache" it

	$url = $filteredResponse["url"];
	$title = $filteredResponse["title"];
	$media_type = $filteredResponse["media_type"];
	$copyright = "";
	if ( !isset($filteredResponse["copyright"]) && empty($filteredResponse["copyright"]) ) {
		$copyright = null;
	}
	else {
		$copyright = $filteredResponse["copyright"];
	}

	$explanation = $filteredResponse["explanation"];

	$sqlInsert = $mysqli->prepare("INSERT INTO photos (url, photo_date, title, media_type, copyright, explanation) VALUES (?,?,?,?,?,?);");

	$sqlInsert->bind_param("ssssss", 
		$url, 
		$mysqldate,
		$title,
		$media_type,
		$copyright, 
		$explanation
	);

	$sqlInsert->execute();

	if (!$sqlInsert) {
		//echo "here";
		//echo $mysqli->error;
		exit();
	}

	// echo "here";

	// 5. Filter Response (only get what you need)
	// actually I need everything from the JSON response so just
	// send to frontend
	header('Content-Type: application/json');
	echo json_encode($response);

}










?>