
$("#login-form").on("submit", function() {
	event.preventDefault();
	let username = $("#username-input").val();
	let password = $("#password-input").val();

	$.ajax({
		method: 'GET',
		url: 'https://badlogin.com/login',
		data: {
			username: username,
			password = password,
		}
	}).done(function(results) {
		let response = JSON.parse(results);
		let success = response.success;
		if (sucess) {
			console.log("Yes");
		} else {
			console.log("No");
		}
	})
})

