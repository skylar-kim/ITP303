<?php 

require "config/config.php";

// make sure user session is active
if ( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true ) {
	// make DB connection
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// get the POST data
	$photo_id = $_POST["photo_id"];

	// get the username to get the user id
	// get the username from the session 
	$username = $_SESSION["username"];

	// execute SQL SELECT statement to find user_id
	// SELECT user_id FROM users WHERE username = ?;
	$sqlSelectUser = $mysqli->prepare("SELECT user_id FROM users WHERE username = ?;");

	$sqlSelectUser->bind_param("s", $username);

	$sqlSelectUser->execute();

	if (!$sqlSelectUser) {
		$jsonMessage = array("message" => "failure to find user");
		echo json_encode($jsonMessage);
		exit();
	}

	$resultUser = $sqlSelectUser->get_result();

	$rowUser = $resultUser->fetch_assoc();

	$user_id = $rowUser["user_id"];


	// delete the favorite entry from users_has_photos
	$sqlDelete = $mysqli->prepare("DELETE FROM users_has_photos WHERE users_user_id = ? AND photos_photo_id = ?;");

	$sqlDelete->bind_param("ii", $user_id, $photo_id);

	$sqlDelete->execute();

	if (!$sqlDelete) {
		$jsonMessage = array("message" => "failure to delete favorites");
		echo json_encode($jsonMessage);
		exit();
	}


	if ($sqlDelete->affected_rows == 1) {
		// return successful json message
		$jsonResponse = array("message" => "delete success");
		echo json_encode($jsonResponse);

	}
	else if ($sqlDelete->affected_rows == 0) {
		// return not successful json message. nothing was deleted?
		$jsonResponse = array("message" => "delete failure");
		echo json_encode($jsonResponse);
	}
	else {
		// uh oh this is bad. it means that there was more than 1 entry was deleted which shouldn't happen
		$jsonResponse = array("message" => "delete failure");
		echo json_encode($jsonResponse);

	}


}
else {
	header("Location: index.php");
}

 ?>