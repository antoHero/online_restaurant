<?php 

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASSWORD', 'secret');
define('DB_NAME', 'orbs');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$connection):
    echo "Failed Connection!!! " . mysqli_connect_errno() ."<br> " . mysqli_connect_error();
endif;




?>
<?php
	
function getBreakfast() {
	global $connection;
	$qry = "SELECT * FROM food";
	$result = mysqli_query($connection, $qry);
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if($row['category'] == 'Breakfast') {
				echo "<form action='' method='post'>
                      <input type='hidden' name='code' value=".$row['code']." />
	                    <div class='single_food_item media'>
	                      <img src='admin/".$row['image']."' class='mr-3' alt='".$row['name']."' width='160px' height='160px'>
	                  
	                      <div class='media-body align-self-center'>
	                          <h3>".$row['name_of_food']."</h3>
	                          <p>".substr($row['description'], 0, 50)." ...<p>
	                          <h5>#".$row['cost']."</h5>
	                          <a href='details.php?fid=".$row['id']."'>Read More <img src='img/icon/left_2.svg'></a>
	                          <button type='submit'>Buy Now </button>
	                      </div>
	                    </div>
                      </form>";
			} else {

			}
		}
	} 
}

function getLunch() {
	global $connection;
	$qry = "SELECT * FROM food";
	$result = mysqli_query($connection, $qry);
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if($row['category'] == 'Lunch') {
				echo "<form action='' method='post'>
                      <div class='single_food_item media'>
                          <img src='admin/".$row['image']."' class='mr-3' alt='".$row['name']."' width='160px' height='160px'>
                      
                      <div class='media-body align-self-center'>
                          <h3>".$row['name_of_food']."</h3>
                          <p>".substr($row['description'], 0, 50)." ...<p>
                          <h5>".$row['cost']."</h5>
                          <a href='details.php?fid=".$row['id']."'>Read More <img src='img/icon/left_2.svg'></a>
                          <button type='submit'>Order </button>
                      </div>
                      </div>
                      </form>";
			} else {

			}
		}
	} 
}

function getDinner() {
	global $connection;
	$qry = "SELECT * FROM food";
	$result = mysqli_query($connection, $qry);
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if($row['category'] == 'Dinner') {
				echo "
                      <div class='single_food_item media'>
                          <img src='admin/".$row['image']."' class='mr-3' alt='".$row['name']."' width='160px' height='160px'>
                      
                      <div class='media-body align-self-center'>
                          <h3>".$row['name_of_food']."</h3>
                          <p>".substr($row['description'], 0, 50)." ...<p>
                          <h5>".$row['cost']."</h5>
                          <a href='details.php?fid=".$row['id']."'>Read More <img src='img/icon/left_2.svg'></a>
                      </div>
                      </div>";
			} else {

			}
		}
	} 
}

function getSnacks() {
	global $connection;
	$qry = "SELECT * FROM food";
	$result = mysqli_query($connection, $qry);
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if($row['category'] == 'Snacks') {
				echo "
                      <div class='single_food_item media'>
                          <img src='admin/".$row['image']."' class='mr-3' alt='".$row['name']."' width='160px' height='160px'>
                      
                      <div class='media-body align-self-center'>
                          <h3>".$row['name_of_food']."</h3>
                          <p>".substr($row['description'], 0, 50)." ...<p>
                          <h5>".$row['cost']."</h5>
                          <a href='details.php?fid=".$row['id']."'>Read More <img src='img/icon/left_2.svg'></a>
                      </div>
                      </div>";
			} else {

			}
		}
	} 
}

function getDessert() {
	global $connection;
	$qry = "SELECT * FROM food";
	$result = mysqli_query($connection, $qry);
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if($row['category'] == 'Dessert') {
				echo "
                      <div class='single_food_item media'>
                          <img src='admin/".$row['image']."' class='mr-3' alt='".$row['name']."' width='160px' height='160px'>
                      
                      <div class='media-body align-self-center'>
                          <h3>".$row['name_of_food']."</h3>
                          <p>".substr($row['description'], 0, 50)." ...<p>
                          <h5>".$row['cost']."</h5>
                          <a href='details.php?fid=".$row['id']."'>Read More <img src='img/icon/left_2.svg'></a>
                      </div>
                      </div>";
			} else {

			}
		}
	} 
}

function runQuery($query) {
	global $connection;
	$result = mysqli_query($connection, $query);
	while($row = mysqli_fetch_assoc($result)) {
		$resultSet[] = $row;
	}
	if(!empty($resultSet)) 
		return $resultSet;
	
	
}

?>

