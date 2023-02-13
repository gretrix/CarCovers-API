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

if (isset($_GET['type']) && (isset($_GET['make'])) && (isset($_GET['model']))) {
	$type = $_GET['type'];
	$make = $_GET['make'];
	$model = $_GET['model'];
	
	$query = "SELECT * FROM cars WHERE LOWER(carstype) = LOWER('" . $type . "') AND  LOWER(carsmake) = LOWER('" . $make . "') AND LOWER(carsmodel) = LOWER('". $model ."') ORDER BY carsmake ASC";
	$result = mysqli_query($conn, $query);
	
		if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = ['min_year' => $row['carsYearMin'], 'max_year' => $row['carsYearMax']];
		
	  }
	} else {
	  $json[] = "none";
	}
}else if (isset($_GET['type']) && (isset($_GET['make'])) && (isset($_GET['type2']))) {
	$type = $_GET['type'];
	$make = $_GET['make'];
	$type2 = $_GET['type2'];
	$query = "SELECT DISTINCT carsmodel FROM cars WHERE (LOWER(carstype) = LOWER('" . $type2 . "') OR LOWER(carstype) = LOWER('" . $type . "')) AND  LOWER(carsmake) = LOWER('" . $make . "') ORDER BY carsmake ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carsmodel'];
	  }
	} else {
	  $json[] = "none";
	}
} 
else if (isset($_GET['type']) &&  (isset($_GET['type2']))) {
	$type = $_GET['type'];
	
	$type2 = $_GET['type2'];
	$query = "SELECT DISTINCT * FROM cars WHERE (LOWER(carstype) = LOWER('" . $type2 . "') OR LOWER(carstype) = LOWER('" . $type . "'))  ORDER BY carsmake ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row;
		
	  }
	} else {
	  $json[] = "none";
	}
} 
else if (isset($_GET['type']) && (isset($_GET['make']))) {
	$type = $_GET['type'];
	$make = $_GET['make'];
	
	$query = "SELECT DISTINCT carsmodel FROM cars WHERE LOWER(carstype) = LOWER('" . $type . "') AND  LOWER(carsmake) = LOWER('" . $make . "') ORDER BY carsmake ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carsmodel'];
	  }
	} else {
	  $json[] = "none";
	}
} 

 
echo json_encode($json);