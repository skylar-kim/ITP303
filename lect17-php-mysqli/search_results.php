<?php 
var_dump($_GET);
echo "<hr>";
echo $_GET["track_name"];


// ---------- STEP 1: Establish a DB connection
$host = "303.itpwebdev.com";
$user = "kimsooye_db_user";
$password = "uscitp2021!";
$db = "kimsooye_song_db";

// To use the mysqli extension, first create an instance of the mysqli class
// The second this instance is created, mysqli is going to attempt to connect this db using these credentials
$mysqli = new mysqli($host, $user, $password, $db);

// connect_errno returns the error code from the last db conenction call. 
if ($mysqli->connect_errno) {
	// There was an error, so let's display the actual error emssage
	echo $mysqli->connect_error;
	// exit() terminate the php program. No subsequent code runs
	exit();
}
$mysqli->set_charset('utf8');

// -------- STEP 2: Generate and Submit SQL Query
$sql = "SELECT tracks.name AS track, genres.name AS genre, media_types.name AS media
FROM tracks
JOIN genres
	ON genres.genre_id = tracks.genre_id
JOIN media_types
	ON media_types.media_type_id = tracks.media_type_id
WHERE 1=1";

// depending on what the user searches for, the where statement will change

if (isset($_GET["track_name"]) && !empty($_GET["track_name"])) {
	// append to my sql statement
	$sql = $sql . " AND tracks.name LIKE '%" . $_GET["track_name"] . "%'" ;
}

if (isset($_GET["genre"]) && !empty($_GET["genre"])) {
	// append to my sql statement
	$sql = $sql . " AND tracks.genre_id = " . $_GET["genre"];
}

if (isset($_GET["media_type"]) && !empty($_GET["media_type"])) {
	// append to my sql statement
	$sql = $sql . " AND tracks.media_type_id = " . $_GET["media_type"];
}

$sql = $sql . ";";

// submit the query!
$results = $mysqli->query($sql);

if (!results) {
	echo $mysqli->error;
	exit();
}

$mysqli->close();

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Song Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4 mt-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing 2 result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Track</th>
							<th>Genre</th>
							<th>Media Type</th>
						</tr>
					</thead>
					<tbody>

						<!-- <tr>
							<td>For Those About To Rock (We Salute You)</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr>
						<tr>
							<td>Put The Finger On You</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr> -->

						<?php while($row = $results->fetch_assoc()) :?>
							<tr>
								<td> <?php echo $row['track']; ?></td>
								<td> <?php echo $row['genre']; ?></td>
								<td> <?php echo $row['media']; ?></td>
							</tr>
						<?php endwhile;?>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>