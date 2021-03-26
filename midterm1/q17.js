<!DOCTYPE html>
<html>
<head>
	<titles>question 17</title>
</head>
<body>


	<form id="registration-form">
		Username: <input type="text" id="username">
		<button type="submit" id="submit-button">Register</button>
	</form>

<script>
	document.querySelector("#submit-button").onsubmit = function(event) {
		event.preventDefault();
		let username = document.querySelector("#username").value;
		console.log(username);
	}
</script>
</body>
</html>