<?php

require '../config/config.php';

// var_dump($_POST);

// server side validation
if ( !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all required fields.";
}
else {
	// Connect to the DB and insert a new user to the users table
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// Before creating a new user, check the users table to see if the user and/or email address already exists.
	$sql_registered = "SELECT * FROM users WHERE username = '" . $_POST["username"] . "' OR email = '" . $_POST["email"] . "';";

	$results_registered = $mysqli->query($sql_registered);
	if (!$results_registered) {
		echo $mysqli->error;
		exit();
	}

	// var_dump($results_registered);

	// If we get even ONE result back from this SELECT query, it means username OR email already exists in the database!
	if($results_registered->num_rows > 0) {
		$error = "Username or email address has already been taken. Please choose another one.";
	} 
	else {
		// SQL to insert - use prepared statements
		$password = hash("sha256", $_POST["password"]);

		$statement = $mysqli->prepare("INSERT INTO users(username, email, password) VALUES(?, ?, ?)");

		$statement->bind_param("sss",
			$_POST['username'],
			$_POST['email'],
			$password);

		$executed = $statement->execute();

		if (!$executed) {
			echo $mysqli->error;
			exit();
		}
	}


	$mysqli->close();


}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">User Registration</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['username']; ?> was successfully registered.</div>
				<?php endif; ?>
		</div> <!-- .col -->
	</div> <!-- .row -->

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<a href="login.php" role="button" class="btn btn-primary">Login</a>
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Back</a>
		</div> <!-- .col -->
	</div> <!-- .row -->

</div> <!-- .container -->

</body>
</html>