


if (localStorage.getItem("userCity")) {
	console.log(localStorage.getItem("userCity"))
	makeCityEndpoint(localStorage.getItem("userCity"))
} else {
	city = "los-angeles"
	makeCityEndpoint(city)
}


function displayResults(results) {
	console.log(results.data[0].city_name)
	console.log("temp " + results.data[0].temp)
	console.log("apparent temp " + results.data[0].app_temp)
	console.log(results.data[0].weather.description)


	let temp = results.data[0].temp
	let app_temp = results.data[0].app_temp
	let description = results.data[0].weather.description

	let displayWeather = temp + "° " + description +". Feels like " + app_temp +  "°"
	console.log(displayWeather)

	$(".weather-report").text(displayWeather)
}

$("select").change(function () {
	console.log("Changed city")
	console.log(this.value)

	let city = this.value
	localStorage.setItem("userCity", city)
	let cityEndpoint = ""
	
	cityEndpoint = makeCityEndpoint(city);
	console.log(cityEndpoint);

	
})

function makeCityEndpoint(city) {
	let cityEndpoint = ""
	if (city == "los-angeles") {
		cityEndpoint = "Los+Angeles,California"
	} else if (city == "baltimore") {
		cityEndpoint = "Baltimore,Maryland"
	} else if (city == "san-diego") {
		cityEndpoint = "San+Diego,California"
	}

	makeEndpoint(cityEndpoint)
}

function makeEndpoint(cityEndpoint) {
	let url = "https://api.weatherbit.io/v2.0/current?city=" + cityEndpoint + "&key=20d896852b2e4fb585ed40f7113be96b&units=I&include=minutely";

	console.log(url);
	ajax(url)
}

function ajax(endpoint) {
	$.ajax({
		method: "GET",
		url: endpoint
	})
	.done(function(results) {
		console.log(results)
		displayResults(results)

	}).fail(function() {
		console.log("ERROR")
	})
}

$("#todo-items").on("click", "li", function(event) {
	//console.log($(this).css("text-decoration-line"))
	event.preventDefault();
	if ($(this).css("text-decoration-line") == "line-through") {
		$(this).css({
			textDecorationLine: "none",
			color: "black"
		}) 
	} else {
		$(this).css({
			textDecorationLine: "line-through",
			color: "gray"
		}) 
	}
	
})

$("#todo-items").on("click", "span", function(event) {
	event.preventDefault();
	if ($(this).closest("li").css("text-decoration-line") == "line-through") {
		$(this).css({
			textDecorationLine: "none",
			color: "black"
		}) 
	}
	$(this).closest("li").fadeOut("slow", function () {
		$(this).closest("li").remove();
	})
	
})

$("#todo-form").on("submit", function(event) {
	event.preventDefault();

	let itemInput = $("#todo-input").val()

	console.log(itemInput)

	let newItemString = '<li><span class="delete">X</span> ' + itemInput +  "</li>" 
	let newItem = $(newItemString)

	$("#todo-items").append(newItem)
})













