<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-5 mb-3">Order Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	
	<div class="container">

		<div class="row mt-3">
			<div>
				<!-- Change this to date/time that this was submitted. -->
				<?php 
					date_default_timezone_set('America/Los_Angeles');
					echo "This form was submitted on " . date("l, F d, o") 
					. " at " . date("h:i:s A");
				 ?>
			</div>
		</div>

		<div class="row mt-4">
			<div class="col-4 text-right">Full Name:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php 
					if (isset($_POST["fname"]) && !empty($_POST["fname"])
						&& isset($_POST["lname"]) && !empty($_POST["lname"])) {
						echo $_POST["fname"] . " " . $_POST["lname"];
					}
					else {
						echo "<div class='text-danger'>Not provided.</div>";
					}
				 ?>
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Phone Number Match:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php 
					if (empty($_POST["phone"]) || empty($_POST["phone-confirm"])) {
						echo "<div class='text-danger'>Not provided.</div>";
					}
					else if (isset($_POST["phone"]) && !empty($_POST["phone"]) 
						&& isset($_POST["phone-confirm"]) && !empty($_POST["phone-confirm"])
						&& strcmp($_POST["phone"], $_POST["phone-confirm"]) != 0) {
						echo "<div class='text-danger'>Phone Numbers do not match.</div>";
					}
					else if (isset($_POST["phone"]) && !empty($_POST["phone"]) 
						&& isset($_POST["phone-confirm"]) && !empty($_POST["phone-confirm"])
						&& strcmp($_POST["phone"], $_POST["phone-confirm"]) == 0) {
						echo "<div class='text-success'>Phone Numbers match.</div>";
						echo $_POST["phone"];
					}
				 ?>
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Order:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php 
					if (isset($_POST["order"]) && !empty($_POST["order"])) {
						echo $_POST["order"];
					}
					else {
						echo "<div class='text-danger'>Not provided.</div>";
					}
				 ?>
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-4 text-right">Size:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php 
					if (isset($_POST["size"]) && !empty($_POST["size"])) {
						echo $_POST["size"];
					}
					else {
						echo "<div class='text-danger'>Not provided.</div>";
					}
				 ?>
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Flavor shot(s): </div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php 
					if (empty($_POST["flavor"])) {
						echo "None.";
					}
					else {
						foreach($_POST["flavor"] as $flavor) {
							echo $flavor . " ";
						}
					}
					
				 ?>
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->

</body>
</html>