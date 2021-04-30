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

	// Listening to favorites button
	$(".search-result").on("click", ".favorite-button", function(event) {
		event.preventDefault();

		console.log("favorites button clicked");
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

			apodHTML = 
			`<div class="col-12 col-sm-12 col-md-12 col-lg-7">
				
				<div class="embed-responsive embed-responsive-16by9">
			   		<iframe class="embed-responsive-item" src="${apod.url}" allowfullscreen></iframe>
				</div>
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-5">
				
				<h2 class="picture-title">${apod.title}</h2>

				<button type="button" class="btn btn-outline-light favorite-button">Favorite</button>
				
				<h5 class="picture-title">${apod.date}</h5>
				<h5 class="picture-title">Copyright: ${apod.copyright}</h5>
				<p class="picture-title">${apod.explanation}</p>
			</div>`;
			}
			else if (apod.media_type == "image") {
				console.log("media type is image")

				apodHTML = 
				`<div class="col-12 col-sm-12 col-md-12 col-lg-7">
				
				<a href="${apod.url}" data-lightbox="${apod.title}" data-title="${apod.title}" >
					<img src="${apod.url}" class="img-fluid" alt="${apod.title}">
				</a>
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-5">
				
				<h2 class="picture-title">${apod.title}</h2>
				<button type="button" class="btn btn-outline-light favorite-button">Favorite</button>
				
				<h5 class="picture-title">${apod.date}</h5>
				<h5 class="picture-title">Copyright: ${apod.copyright}</h5>
				<p class="picture-title">${apod.explanation}</p>
			</div>`;
			}
			

			$searchResult.append(apodHTML);
		}

		$searchFormContainer.removeClass("d-block");
		$searchFormContainer.addClass("d-none");

		$searchResult.removeClass("d-none");
		$searchResult.addClass("d-flex");
	}
})