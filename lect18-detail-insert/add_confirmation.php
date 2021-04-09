<?php

// var_dump($_POST);
// Check that required fields are filled out
if ( !isset($_POST['track_name']) || 
	empty($_POST['track_name']) || 
	!isset($_POST['media_type']) || 
	empty($_POST['media_type']) || 
	!isset($_POST['genre']) || 
	empty($_POST['genre']) || 
	!isset($_POST['milliseconds']) || 
	empty($_POST['milliseconds']) || 
	!isset($_POST['price']) || 
	empty($_POST['price']) ) {

	$error = "Please fill out all required fields";
}
else {
	// all required fields are given, connect to the DB
	$host = "303.itpwebdev.com";
	$user = "kimsooye_db_user";
	$password = "uscitp2021!";
	$db = "kimsooye_song_db";

	$mysqli = new mysqli($host, $user, $password, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// Handle the optional fields such as album, composer and bytes. Set these to NULL
	if (isset($_POST["album"]) && !empty($_POST["album"]) ) {
		// User has selected an album
		$album = $_POST["album"];
	}
	else {
		$album = null;
	}

	if (isset($_POST["composer"]) && !empty($_POST["composer"]) ) {
		// User has selected an album
		$composer = "'" . $_POST["composer"] . "'";
	}
	else {
		$composer = null;
	}

	if (isset($_POST["bytes"]) && !empty($_POST["bytes"]) ) {
		// User has selected an album
		$bytes = "'" . $_POST["bytes"] . "'";
	}
	else {
		$bytes = null;
	}

	// Escape any special characters.
	// e.g single quotes get escaped so it doesn't affect the SQL statement
	$track_name = $mysqli->real_escape_string($_POST["track_name"]);

	// Generate the SQL query
	$sql = "INSERT INTO tracks (name, album_id, media_type_id, genre_id, composer, milliseconds, bytes, unit_price)
		VALUES('" . $track_name . "', " 
		. $album . " , " 
		. $_POST["media_type"] . " , " 
		. $_POST["genre"] . ", "
		. $composer . ","
		. $_POST["milliseconds"] . ", " 
		. $bytes .", "
		. $_POST["price"] . ");";

	// echo "<hr>" . $sql . "<hr>";

	$results = $mysqli->query($sql);

	if (!$results) {
		echo $mysqli->error;
		exit();
	}

	// To check that this new song was actually added to the db, have to check the db. Also, you can check the $mysqli->affected_row property
	// returns how many records were affected
	// ie. added 1 song, returns 1
	// added 5 songs, returns 5

	// echo "Inserted: " . $mysqli->affected_rows;

	if ($mysqli->affected_rows == 1) {
		$isInserted = true;
	}


	$mysqli->close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a Song</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php if(isset($error) && !empty($error)) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<!--  show this success message only if affected_rows == 1 -->
<?php if ($isInserted) : ?>
				<div class="text-success">
					<span class="font-italic"><?php echo $_POST["track_name"] ?></span> was successfully added.
				</div>
<?php endif; ?>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>