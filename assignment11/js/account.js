let sr = ScrollReveal();

$(document).ready(function () {
	ScrollReveal({reset: true});

	const $cardRow = $(".card-row");


	// call backend to get an array of photo urls and photo_id
	// for each item, create a card with photo url and photo_id
	getFavorites();


	// add event listener to cards
	$(".card-row").on("click", ".card", function(event) {
		event.preventDefault();

		let photo_id = $(this).children(".photo-id").html();

		window.location.href = "details.php?photo_id=" + photo_id;
	});


	function getFavorites() {
		$.ajax({
			method: "GET",
			url: "account_backend.php"
		})
		.done(function(result) {
			displayGetFavorites(result);
		})
		.fail(function() {
			console.log('fail');
		})
	}

	function displayGetFavorites(result) {
		console.log(result);
		// console.log(result[0].photo_id)

		$cardRow.html("");

		for (let i = 0; i < result.length; i++) {
			let fav = result[i];
			let cardHTML = ``;
			if (fav.media_type == "image") {
				cardHTML = 
				`<div class="col-12 col-sm-12 col-md-6 col-lg-4 my-4 card-div" >
					<div class="card">
						<a href=""><img src="${fav.url}" class="img-fluid" alt="${fav.title}"></a>
						<span class="photo-id d-none">${fav.photo_id}</span>
					</div>
				</div>`;
			}
			else if (fav.media_type == "video") {

			}

			$cardRow.append(cardHTML);
		}

		$cardRow.removeClass("d-none");
		ScrollReveal().reveal('.card');
	}

});

























