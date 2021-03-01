let endpoint = "https://api.weatherbit.io/v2.0/current?city=Los+Angeles,California&key=20d896852b2e4fb585ed40f7113be96b&units=I&include=minutely"

// ajax request

$.ajax({
	method: "GET",
	url: "https://api.weatherbit.io/v2.0/current?city=Los+Angeles,California&key=20d896852b2e4fb585ed40f7113be96b&units=I&include=minutely"

})
.done(function(results) {
	console.log(results)
	displayResults(results)

}).fail(function() {
	console.log("ERROR")
})


function displayResults(results) {
	console.log(results.data[0].city_name)
	console.log("temp " + results.data[0].temp)
	console.log("apparent temp " + results.data[0].app_temp)
	console.log(results.data[0].weather.description)

	let temp = results.data[0].temp
	let app_temp = results.data[0].app_temp
	let description = results.data[0].weather.description

	let displayWeather = "Today's weather in Los Angeles: " + temp + "° " + description +". Feels like " + app_temp +  "°"
	console.log(displayWeather)

	$(".weather-description").text(displayWeather)
}

$("select").on("change", function() {
	console.log($(this).value)
})














