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
		SELECT carshandle FROM cars 
		WHERE LOWER(carstype) = LOWER('" . $type . "') 
		AND carsyear = '" . $year . "' 
		AND LOWER(carsmake) = LOWER('" . $make . "') 
		AND LOWER(carsmodel) = LOWER('" . $model. "') 
		ORDER BY carshandle ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carshandle'];
	  }
	} else {
	  $json[] = "none";
	}
	echo json_encode($json);
} else if ((isset($_GET['year'])) && (isset($_GET['make'])) && (isset($_GET['model']))) {
	
	$year = $_GET['year'];
	$make = $_GET['make'];
	$model = $_GET['model'];
	
	$query = "
		SELECT carshandle FROM cars 
		
		WHERE carsyear = '" . $year . "' 
		AND LOWER(carsmake) = LOWER('" . $make . "')
		AND LOWER(carsmodel) = LOWER('".$model."')
		
		ORDER BY carshandle ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carshandle'];
	  }
	} else {
	  $json[] = "none";
	}
	echo json_encode($json);
}
