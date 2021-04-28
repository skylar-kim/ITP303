<!DOCTYPE html>
<html>
<head>
	<title>ASTRA | Search </title>

	<meta charset="UTF-8">
	<!-- BOOTSTRAP STYLING -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- FONT -->
	<link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
	<!-- RESPONSIVENESS -->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<!-- Custom Scripts -->
	<script type="text/javascript" src="search_form.js"></script>
	<style type="text/css">
		body {
			background-color: black;
			font-family: 'Karla', sans-serif;
		}

		.picture-title {
			color: white;
		}

		.search-form-container-hide {
			display: none;
		}

		.search-form-container-show {
			display: block;
		}

		.search-result-hide {
			display: none;
		}

		.search-result-show {
			display: block;
		}
	</style>
</head>
<body>

	<!-- <div class="top-half">
        

	    <div class="sticky-top hidden-spacer"> </div>

        <div class="form-div">
			<div class="container register-container my-2 py-4 mx-auto mr-auto">
				<div class="row justify-content-center">
					<h1 class="title-style col-12 col-sm-12 col-md-12 col-lg-12">ASTRA</h1>

					<div class="container">

						<form id="search-form" action="" method="GET">

							
							<label for="search-date" class="col-sm-12 text-white text-center form-label-style description-style">Search by Date:</label>
							<div class="form-group row justify-content-center">
								<div class="col-sm-12 col-md-10 col-lg-8">
									<input type="date" class="form-control" id="search-date" name="username">
								</div>
							</div>

							<div class="row justify-content-center">
								<button type="submit" class="btn btn-outline-light btn-lg">Search</button>
							</div>
						</form>

	

					</div>


				</div>
			</div>
		</div>
	</div> -->

	<?php include 'navbar.php'; ?>
	<div class="container">
		<div class="container register-container my-2 py-4 mx-auto mr-auto search-form-container search-form-container-show">
			<div class="row justify-content-center">
				<h1 class="title-style col-12 col-sm-12 col-md-12 col-lg-12">ASTRA</h1>

				<div class="container">

					<form id="search-form" action="" method="GET">


						<label for="search-date" class="col-sm-12 text-white text-center form-label-style description-style">Search by Date:</label>
						<div class="form-group row justify-content-center">
							<div class="col-sm-12 col-md-10 col-lg-8">
								<input type="date" class="form-control" id="search-date" name="username">
							</div>
						</div>

						<div class="row justify-content-center">
							<button type="submit" class="btn btn-outline-light btn-lg">Search</button>
						</div>
					</form>



				</div>


			</div>
		</div>

		
		
	</div>

	<div class="container">
		<div class="embed-responsive">
			  <iframe width="560" height="315" src="https://www.youtube.com/embed/B1R3dTdcpSU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		<div class="row justify-content-center search-result search-result-show">
			

			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<img src="https://apod.nasa.gov/apod/image/2104/ant_hubble_1072.jpg" class="img-fluid" alt="Planetary Nebula Mz3: The Ant Nebula">
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="col-8 col-sm-8 col-md-8 col-lg-8"><h2 class="picture-title">Planetary Nebula Mz3: The Ant Nebula</h2></div>

					<div class="col-2 col-sm-2 col-md-2 col-lg-4"><button class="btn btn-light">Favorite</button></div>
				</div>
				
				

				
				<h5 class="picture-title">2021-04-25</h5>
				<h5 class="picture-title">Copyright: </h5>
				<p class="picture-title">Why isn't this ant a big sphere?  Planetary nebula Mz3 is being cast off by a star similar to our Sun that is, surely, round.  Why then would the gas that is streaming away create an ant-shaped nebula that is distinctly not round?  Clues might include the high 1000-kilometer per second speed of the expelled gas, the light-year long length of the structure, and the magnetism of the star featured here at the nebula's center.  One possible answer is that Mz3 is hiding a second, dimmer star that orbits close in to the bright star.  A competing hypothesis holds that the central star's own spin and magnetic field are channeling the gas.  Since the central star appears to be so similar to our own Sun, astronomers hope that increased understanding of the history of this giant space ant can provide useful insight into the likely future of our own Sun and Earth.</p>
			</div>
		</div>
	</div>





	
	<!-- POPPERS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<!-- BOOTSTRAP -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>