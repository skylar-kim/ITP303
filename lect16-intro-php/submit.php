<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

			<div class="col-12">
				<!-- Display Test Output Here -->
<?php
	// write PHP here
	echo "Hello World!";
	echo "<strong>Hello World!</strong>";
	echo "<hr>";

	// Variables
	$name = "Tommy";
	$age = 5;
	echo $name;

	echo "<hr>";

	// prints sutff, but also the data type and num of chars
	// good for debugging
	var_dump($name);

	echo "<hr>";

	// Concatenation - period
	// not a plus sign like other languages
	echo "My name is " . $name;

	echo "<hr>";
	// When using double quotes, can utilize variable interpolation and do something like this:
	echo "My name is $name";

	// variable interpolation doesn't work with single quotes
	echo "<hr>";
	echo 'My name is $name';

	// DATE/TIME in PHP

	// set a default timezone
	date_default_timezone_set('America/Los_Angeles');

	echo "<hr>";

	// get the current time
	echo date("m-d-y H:i:s T");
	echo "<hr>";
	
	// Arrays
	$colors = ["red", "green", "blue"];
	
	echo $colors[0];
	echo "<hr>";
	for($i = 0; $i < sizeof($colors); $i++) {
		echo $colors[$i] . ", ";
	}

	// Associative arrays: it is an array with string keys
	// left hand is keys, right hand is the value
	$courses = [
		"ITP 303" => "Full-Stack Web Development",
		"ITP 104" => "Advanced Front-End Web Development"
	];

	echo "<hr>";
	echo $courses["ITP 303"];

	
	echo "<hr>";
	foreach($courses as $courseNumber => $courseName) {
		echo $courseNumber . ": " . $courseName;
		echo "<br>";
	}

	echo "<hr>";
	foreach($courses as $course) {
		echo $course;
		echo "<br>";
	}

	// SUPERGLOBALS
	echo "<hr>";
	var_dump($_SERVER);
	echo "<hr>";

	// can get a specific value from $_SERVER
	echo $_SERVER["HTTP_HOST"];

	// Other superglobals: $_POST and $_GET

	echo "<hr>";
	echo "GET supergloabl: ";
	// by default, GET and POST superglobals are empty
	var_dump($_GET);

	echo "<hr>";
	echo "POST supergloabl: ";
	// by default, GET and POST superglobals are empty
	var_dump($_POST);


 ?>

			</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php 
					if (isset($_POST["name"]) && 
						!empty($_POST["name"])) {
						// if the variable is set and it is not empty
						// then show the name
						echo $_POST["name"];
					}
					else {
						echo "<div class='text-danger'>Not provided</div>";
					}
					
				?>
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php 
					foreach($_POST["subscribe"] as $subscribe) {
						echo $subscribe . " ";
					}
				 ?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>