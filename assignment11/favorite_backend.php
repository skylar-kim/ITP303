<?php 
require("config/nasa-creds.php");

// user session active
// If user is logged in, don't show them this page. Redirect them somewhere else.
// if not logged in, do the usual thing
if ( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]  ) {

	
}

// user session not active
// direct to login page
else {
	header("Location:  login.php");
}


 ?>