<?php 
require("config/config.php");

// user session active
if ( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true ) {
	$mysqli = new mysqli('303.itpwebdev.com', 'kimsooye_db_user', 'uscitp2021!', 'kimsooye_astra_db');

	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// get the username from the session 
	$username = $_SESSION["username"];
	// echo $username;

	// get the photo date of the photo user just favorited
	$mysqldate = date('Y-m-d', strtotime($_POST["favDate"]));

	

	// execute SQL SELECT statement to find user_id
	// SELECT user_id FROM users WHERE username = ?;
	$sqlSelectUser = $mysqli->prepare("SELECT user_id FROM users WHERE username = ?;");

	$sqlSelectUser->bind_param("s", $username);

	$sqlSelectUser->execute();

	$resultUser = $sqlSelectUser->get_result();

	$rowUser = $resultUser->fetch_assoc();

	$userId = $rowUser["user_id"];


	// execute SQL SELECT statement to find photo_id
	// SELECT photo_id FROM photos WHERE photo_date = ?;
	$sqlSelectPhoto = $mysqli->prepare("SELECT photo_id FROM photos WHERE photo_date = ?;");

	$sqlSelectPhoto->bind_param("s", $mysqldate);

	$sqlSelectPhoto->execute();

	$resultPhoto = $sqlSelectPhoto->get_result();

	$rowPhoto = $resultPhoto->fetch_assoc();

	$photoId = $rowPhoto["photo_id"];

	// execute SQL statement to see if user already favorited
	// SELECT * FROM users_has_photos WHERE user_id = ? AND photo_id = ?;
	$sqlCheckFav = $mysqli->prepare("SELECT * FROM users_has_photos WHERE users_user_id = ? AND photos_photo_id = ?;");

	$sqlCheckFav->bind_param("ii", $userId, $photoId);

	$sqlCheckFav->execute();

	$sqlCheckFav->store_result();

	// if num rows > 0: don't add favorites again
	if ($sqlCheckFav->num_rows > 0) {
		// send some json fail message?
		$response = array("message" => "readding favorites");

		header('Content-Type: application/json');
		echo json_encode($response);
	}
	else {
		// execute SQL INSERT statement to insert user_id and photo_id pair
		// into TABLE users_has_photos
		// INSERT INTO users_has_photos (users_user_id, photos_photo_id) VALUES (?, ?);
		$sqlInsert = $mysqli->prepare("INSERT INTO users_has_photos (users_user_id, photos_photo_id) VALUES (?, ?);");

		$sqlInsert->bind_param("ii", $userId, $photoId);

		$sqlInsert->execute();

		if (!$sqlInsert) {
			exit();
		}
		else {
			$response = array("message" => "success");

			header('Content-Type: application/json');
			echo json_encode($response);
		}

		// return successful json message
	}
	
	$mysqli->close();
}

// user session not active
// direct to login page
else {
	// header("Location:  login.php");
	$response = array("message" => "user session not active");

	echo json_encode($response);
}


 ?>