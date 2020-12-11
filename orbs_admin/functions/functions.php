<?php include('..db/db.php');?>
<?php
	function showMealType() {
		global $connection;
		$query = "SELECT * FROM meal_type";
		$result = mysqli_query($connection, $query);
		if(!$result) {
			echo "Failed to fetch food types " . mysqli_error($connection);
		}

		while($row = mysqli_fetch_assoc($result)) {
			$id = $row['id'];
			$name = $row['name'];

			echo "<option name='food_cat' value='$id'>$name</option>";
		}
	}


?>