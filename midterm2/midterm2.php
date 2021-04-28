<?php 
	$statement = $mysqli->prepare("INSERT INTO menu_items(name, price, category_id, is_featured) 
	VALUES(?, ?, ?, ?)");

	$statement->bind_param("sdii", $_POST["name"], $_POST["price"], $_POST["category"], $_POST["featured"]);

	$executed = $statement->execute();

	if (!$executed) {
		echo $mysqli->error;
		exit();
	}


if ( isset($_GET['product_sku']) && !empty($_GET['product_sku']) 
	&& isset($_GET['category']) && !empty($_GET['category']) ) {
	echo "Category: " . $_GET['category'] . ", SKU: " . $_GET['product_sku']
} else {
	echo "No input";
}









 ?>

<ul>
	<?php 
		$imposter_color = $game['imposter'];

		$players = $game["players"]
		foreach($player in $players) {
			if ($player == $imposter_color) {
				echo "<li><strong>" . $player . "</strong></li>";
			}
			else {
				echo "<li>" . $player . "</li>";
			}
		}
	 ?>
	

</ul>
