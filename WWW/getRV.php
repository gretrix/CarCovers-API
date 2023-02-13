<?php 
header("Access-Control-Allow-Origin: *");
include 'conn.php';

/*
	Order
	Type
	Type & Year
	Type & Year &  Make
	Type & Year & Make & Model
*/

if (isset($_GET['type']) && (isset($_GET['year'])) && (isset($_GET['make'])) && (isset($_GET['model']))) {
	$type = $_GET['type'];
	$year = $_GET['year'];
	$make = $_GET['make'];
	$model = $_GET['model'];
	
	$query = "
		SELECT carscovers FROM cars 
		WHERE LOWER(carstype) = LOWER('" . $type . "') 
		AND carsyear = '" . $year . "' 
		AND LOWER(carsmake) = LOWER('" . $make . "') 
		AND LOWER(carsmodel) = LOWER('" . $model. "') 
		ORDER BY carsmodel ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carscovers'];
	  }
	} else {
	  $json[] = "none";
	}
} else if (isset($_GET['type']) && (isset($_GET['year'])) && (isset($_GET['make']))) {
	$type = $_GET['type'];
	$year = $_GET['year'];
	$make = $_GET['make'];
	
	$query = "SELECT DISTINCT carsyear FROM cars WHERE LOWER(carstype) = LOWER('" . $type . "') AND carsmake = '" . $year . "' AND LOWER(carsmodel) = LOWER('" . $make . "') ORDER BY carsyear DESC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carsyear'];
	  }
	} else {
	  $json[] = "none";
	}
} else if (isset($_GET['type']) && (isset($_GET['year']))) {
	$type = $_GET['type'];
	$year = $_GET['year'];
	
	$query = "SELECT DISTINCT carsmodel FROM cars WHERE LOWER(carstype) = LOWER('" . $type . "') AND carsmake = '" . $year . "' ORDER BY carsmodel ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carsmodel'];
	  }
	} else {
	  $json[] = "none";
	}
} else if (isset($_GET['type'])) {
	$type = $_GET['type'];
	
	$query = "SELECT DISTINCT carsmake FROM cars WHERE LOWER(carstype) = LOWER('" . $type . "') ORDER BY carsmake ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carsmake'];
	  }
	} else {
	  $json[] = "none";
	}
}

echo json_encode($json);