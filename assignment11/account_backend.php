<?php 

require("config/config.php");

// check if user session is active
if ( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true ) {

	// make DB connection
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	
	// get the username from the session 
	$username = $_SESSION["username"];

	// echo $username . "<hr>";

	// execute SQL SELECT statement to find user_id
	// SELECT user_id FROM users WHERE username = ?;
	$sqlSelectUser = $mysqli->prepare("SELECT user_id FROM users WHERE username = ?;");

	$sqlSelectUser->bind_param("s", $username);

	$sqlSelectUser->execute();

	$resultUser = $sqlSelectUser->get_result();

	$rowUser = $resultUser->fetch_assoc();

	$userId = $rowUser["user_id"];


	// query DB for user's list of photos
	// associated to their user id
	$sqlFav = $mysqli->prepare("SELECT * FROM users_has_photos WHERE users_user_id = ?;");

	$sqlFav->bind_param("i", $userId);

	$sqlFav->execute();

	$resultFav = $sqlFav->get_result();

	// for each row in resultset, add photos_photo_id to an array?
	$photoIdArray = array();
	while ($row = $resultFav->fetch_assoc()) {
		//echo "<hr>" . $row["photos_photo_id"];
		$photoIdArray[] = $row["photos_photo_id"];
	}

	// loop through the photos_photo_id array 
	// for each photos_photo_id, call DB 
	// and build an array of json objects to send to frontend
	$jsonArray = array();
	foreach($photoIdArray as $key => $photo_id) {
		$sqlSelectPhoto = $mysqli->prepare("SELECT * FROM photos WHERE photo_id = ?;");

		$sqlSelectPhoto->bind_param("i", $photo_id);

		$sqlSelectPhoto->execute();

		$photoResult = $sqlSelectPhoto->get_result();

		$photoRow = $photoResult->fetch_assoc();

		// echo "<hr>" . $photoRow["photo_id"];
		// echo "<hr>" . $photoRow["url"];


		$jsonObject = array(
			"photo_id" => $photoRow["photo_id"],
			"url" => $photoRow["url"],
			"media_type" => $photoRow["media_type"],
			"title" => $photoRow["title"]
		);

		$jsonArray[] = $jsonObject;

	}

	header('Content-Type: application/json');
    echo json_encode($jsonArray);



	$mysqli->close();
}
else {

	// user session not active: direct to index page
	header("Location: index.php");

	// $response = array("message" => "user session not active");

	// echo json_encode($response);
}











?>