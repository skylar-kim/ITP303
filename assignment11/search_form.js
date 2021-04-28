$(document).ready(function () {

	// Form Related
	const $searchFormContainer = $(".search-form-container");
	const $searchForm = $("#search-form");
	const $searchDate = $("#search-date");

	// Search Result Stuff
	const $searchResult = $(".search-result");

	// Event Handlers
	$searchForm.on("submit", function(e) {
		e.preventDefault();


		console.log("form submitted");

		const searchDate = $searchDate.val();

		console.log(searchDate);

		getAjax(searchDate);
	})

	function getAjax(searchDate) {
		console.log(searchDate);

		$.ajax({
			method: "GET",
			url: "search_form_backend.php",
			data: {
				searchDate: searchDate
			}
		})
		.done(function(result) {
			console.log(result);

			displayGetResult(result);
		})
		.fail(function() {
			console.log("fail");
		});
	}

	function displayGetResult(result) {

		// clears out the existing elements in searchResult
		$searchResult.html("");

		for (let apod of result) {
			let apodHTML = ``;
			if (apod.media_type == "video") {
				console.log("media type is video");

				apodHTML = `<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="${apod.url}" allowfullscreen></iframe>
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="col-8 col-sm-8 col-md-8 col-lg-8"><h2 class="picture-title">${apod.title}</h2></div>

					<div class="col-2 col-sm-2 col-md-2 col-lg-4"><button class="btn btn-light">Favorite</button></div>
				</div>
				
				<h5 class="picture-title">${apod.date}</h5>
				<h5 class="picture-title">Copyright: ${apod.copyright}</h5>
				<p class="picture-title">${apod.explanation}</p>
			</div>`
			}
			else if (apod.media_type == "image") {
				console.log("media type is image")

				apodHTML = 
				`<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<img src="${apod.url}" class="img-fluid" alt="${apod.title}">
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="col-8 col-sm-8 col-md-8 col-lg-8"><h2 class="picture-title">${apod.title}</h2></div>

					<div class="col-2 col-sm-2 col-md-2 col-lg-4"><button class="btn btn-light">Favorite</button></div>
				</div>
				
				<h5 class="picture-title">${apod.date}</h5>
				<h5 class="picture-title">Copyright: ${apod.copyright}</h5>
				<p class="picture-title">${apod.explanation}</p>
			</div>`;
			}
			

			$searchResult.append(apodHTML);
		}

		$searchFormContainer.removeClass("search-form-container-show");
		$searchFormContainer.addClass("search-form-container-hide");
		$searchResult.removeClass("search-result-hide");
		$searchResult.addClass("search-result-show");
	}
})