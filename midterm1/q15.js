document.querySelector("#save-btn").onclick = function() {
	localStorage.setItem("dog", "Fluffy");
}

document.querySelector("#get-btn").onclick = function() {
	console.log(localStorage.getItem("dog"));
}