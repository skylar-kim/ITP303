



document.querySelector("#link").onclick = function() {
	event.preventDefault();

	document.querySelector("#link").href = "https://www.usc.edu";
}

$("#link").on("click", function() {
	event.preventDefault();
	$("#link").attr("href", "https://www.usc.edu");
}) 

document.querySelector("#link").dataset.school = "USC";

$("#link").attr("data-school", "USC");
