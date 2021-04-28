<?php

require '../config/config.php';

// If user is logged in, don't show them this page. Redirect them somewhere else.
// if not logged in, do the usual thing
if ( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]  ) {


	// Check if a username and password has been submitted via POST method.
	// will not go into if statement if user simply got to the login page.
	// only if username and password was actually submitted
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		if ( empty($_POST['username']) || empty($_POST['password']) ) {

			$error = "Please enter username and password.";

		}
		else {
			// This means user has filled out something for username and password.
			// So let's check if this username/password combo exists in the DB and that it is correct!
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			// hash whatever user typed in for the password field and then compare that with the hashed pw in the db
			$passwordInput = hash("sha256", $_POST["password"]);

			$sql = "SELECT * FROM users
						WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";

			echo "<hr>" . $sql . "<hr>";
			
			$results = $mysqli->query($sql);

			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			// if we get one match, that means this username/pw combo exists!
			// num_rows tells us how many results we obtained from the above sql query
			if($results->num_rows > 0) {
				// log in success
				// set session variables to remember the username
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["logged_in"] = true;

				// redirect logged in user to the home page
				header("Location: ../song-db/index.php");
			
			}
			else {
				$error = "Invalid username or password.";
			}
		} 
	}
}
else {
	// user is already logged in, so redirect them to another page
	header("Location:  ../song-db/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<?php include '../song-db/nav.php'; ?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Login</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<!-- POST-back: submitting the form to itself -->
		<!-- what this allows us to do: if the password is wrong, just reload the same page with the error messag -->
		<form action="login.php" method="POST">

			<div class="row mb-3">
				<div class="font-italic text-danger col-sm-9 ml-sm-auto">
					<!-- Show errors here. -->
					<?php
						if ( isset($error) && !empty($error) ) {
							echo $error;
						}
					?>
				</div>
			</div> <!-- .row -->
			

			<div class="form-group row">
				<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username-id" name="username">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password-id" name="password">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Login</button>
					<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Cancel</a>
				</div>
			</div> <!-- .form-group -->
		</form>

		<div class="row">
			<div class="col-sm-9 ml-sm-auto">
				<a href="register_form.php">Create an account</a>
			</div>
		</div> <!-- .row -->

	</div> <!-- .container -->
</body>
</html>