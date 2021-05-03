<?php

require 'config/config.php';

//var_dump($_POST);

// server side validation
if ( !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password'])) {
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
	$sql_registered = $mysqli->prepare("SELECT * FROM users WHERE username = ? OR email = ?;");

	$sql_registered->bind_param("ss", $_POST["username"], $_POST["email"]);

	$sql_registered->execute();

	$sql_registered->store_result();

	// var_dump($sql_registered->num_rows);

	// If we get even ONE result back from this SELECT query, it means username OR email already exists in the database!
	if($sql_registered->num_rows > 0) {
		$error = "Username or email address has already been taken. Please choose another one.";
	} 
	else {
		//echo "uniqe";
		// SQL to insert - use prepared statements
		$password = hash("sha256", $_POST["password"]);

		// make date into a string
		//$date = mysql_real_escape_string($_POST["birthday"]);

		//$birthday = date("Y-m-d", strtotime(str_replace('-', '/', $date)));
//		$mysqldate = date('Y-m-d', strtotime($_POST["birthday"]));

		//echo $mysqldate;

		$sqlInsert = $mysqli->prepare("INSERT INTO users(username, email, password) VALUES(?, ?, ?)");

		$sqlInsert->bind_param("sss",
			$_POST['username'],
			$_POST['email'],
			$password);

		$executedInsert = $sqlInsert->execute();

		if (!$executedInsert) {
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
	<title>ASTRA | Register Confirmation</title>

	<meta charset="UTF-8">
	<!-- BOOTSTRAP STYLING -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- FONT -->
	<link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
	<!-- RESPONSIVENESS -->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/register_confirmation.css">
	
</head>
<body>

	
		<?php include 'navbar.php'; ?>

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-8 col-sm-8 col-md-8 col-lg-5 py-5 my-5 slide-up">
					<?php if ( isset($error) && !empty($error)) : ?>
						<div class="register-message register-error"><?php echo $error; ?></div>
					<?php else: ?>
						<div class="register-message register-success"> <?php echo $_POST['username']; ?>, welcome to ASTRA.</div>
					<?php endif; ?>
				</div>
			</div>
		</div>


	

	
	<!-- POPPERS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<!-- BOOTSTRAP -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>