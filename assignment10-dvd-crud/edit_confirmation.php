<?php 
// import the config/config.php
require "config/config.php";
$isUpdated = false;

// var_dump($_POST);

if ( !isset($_POST['title']) || empty($_POST['title']) ) {
	$error = "Please fill out all required fields.";
}
else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// Cover optional fields
	// Release Date
	if ( isset($_POST['release_date']) && !empty($_POST['release_date']) ) {
		$release_date = date('Y-m-d', strtotime($_POST['release_date']));
	} else {
		$release_date = null;
	}

	// Label ID
	if ( isset($_POST['label']) && !empty($_POST['label']) ) {
		$label_id = $_POST['label'];
	} else {
		$label_id = null;
	}

	// Sound ID
	if ( isset($_POST['sound']) && !empty($_POST['sound']) ) {
		$sound_id = $_POST['sound'];
	} else {
		$sound_id = null;
	}

	// Genre ID
	if ( isset($_POST['genre']) && !empty($_POST['genre']) ) {
		$genre_id = $_POST['genre'];
	} else {
		$genre_id = null;
	}

	// Rating ID
	if ( isset($_POST['rating']) && !empty($_POST['rating']) ) {
		$rating_id = $_POST['rating'];
	} else {
		$rating_id = null;
	}

	// Format ID
	if ( isset($_POST['format']) && !empty($_POST['format']) ) {
		$format_id = $_POST['format'];
	} else {
		$format_id = null;
	}

	// Award
	if ( isset($_POST['award']) && !empty($_POST['award']) ) {
		$award = "'" . $_POST['award'] . "'";
	} else {
		$award = null;
	}

	// Generate SQL statement
	// $sql = "UPDATE dvd_titles
	// SET title = '" . $_POST['title'] . "',
	// release_date = '" . $release_date . "',
	// award = " . $award . ",
	// label_id = " . $label_id . ",
	// sound_id = " . $sound_id . ",
	// genre_id = " . $genre_id . ",
	// rating_id = " . $rating_id . ",
	// format_id = " . $format_id . 
	// " WHERE dvd_title_id = " . $_POST['dvd_title_id'] .
	// ";";

	// echo "<hr>" . $sql . "<hr>";

	// Using prepared statements
	$prepared_stmt = "UPDATE dvd_titles SET title = ?, release_date = ?, award = ?, label_id = ?, sound_id = ?, genre_id = ?, rating_id = ?, format_id = ? WHERE dvd_title_id = ?";
	$statement = $mysqli->prepare($prepared_stmt);

	$statement->bind_param("sssiiiiii", $_POST['title'], $release_date, $award, $label_id, $sound_id, $genre_id, $rating_id, $format_id, $_POST['dvd_title_id']);

	// execute the statement
	$executed = $statement->execute();

	// check for errors 
	if (!$executed) {
		echo $mysqli->error;
	}

	// check that one record was affected
	// echo "<hr>" . $mysqli->affected_rows ."<hr>";
	if ($mysqli->affected_rows == 1) {
		$isUpdated = true;
	}

	// close the statement when finished
	$statement->close();



	$mysqli->close();
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Confirmation | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="details.php">Details</a></li>
		<li class="breadcrumb-item"><a href="edit_form.php">Edit</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Edit a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger font-italic">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<?php if ($isUpdated) : ?>
					<div class="text-success"><span class="font-italic"><?php echo $_POST['title']; ?></span> was successfully edited.</div>
				<?php endif; ?>

				

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="details.php?dvd_title_id=<?php echo $_POST['dvd_title_id']; ?>" role="button" class="btn btn-primary">Back to Details</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>