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
	
	$query = "SELECT DISTINCT carsmodel FROM cars WHERE LOWER(carstype) = LOWER('" . $type . "') AND '" . $year . "' Between carsYearMin and carsYearMax  AND LOWER(carsmake) = LOWER('" . $make . "') ORDER BY carsmodel ASC";
	if($type == "car"){
		$query = "SELECT DISTINCT carsmodel FROM cars WHERE  '" . $year . "' Between carsYearMin and carsYearMax  AND LOWER(carsmake) = LOWER('" . $make . "') AND (carstype = 'car' or carstype='truck' or carstype='suv' or carstype='van') ORDER BY carsmodel ASC";
			
	} 
	else if ($type == "scooter" || $type =="motorcycle"){
		
		$query = "SELECT DISTINCT carsmodel FROM cars WHERE  '" . $year . "' Between carsYearMin and carsYearMax  AND LOWER(carsmake) = LOWER('" . $make . "') AND ( LOWER(carstype) = 'Motorcycle' or  LOWER(carstype)='Scooter') ORDER BY carsmodel ASC";

	}
	else if ($type == "ATV" || $type == "UTV"){
		
		$query = "SELECT DISTINCT carsmodel FROM cars WHERE  '" . $year . "' Between carsYearMin and carsYearMax  AND LOWER(carsmake) = LOWER('" . $make . "') AND ( LOWER(carstype) = 'ATV' or  LOWER(carstype)='UTV') ORDER BY carsmodel ASC";

	}
	
	

	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carsmodel'];
	  }
	} else {
	  $json[] = "none";
	}
} else if (isset($_GET['type']) && (isset($_GET['year']))) {
	$type = $_GET['type'];
	$year = $_GET['year'];
	
	$query = "SELECT DISTINCT carsmake FROM cars WHERE carstype = LOWER('" . $type . "') AND '" . $year . "' Between carsYearMin and carsYearMax ORDER BY carsmake ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carsmake'];
	  }
	} else {
	  $json[] = "none";
	}
} else if (isset($_GET['make']) && (isset($_GET['year']))) {
	$type = $_GET['make'];
	$year = $_GET['year'];
	
	$query = "SELECT DISTINCT carmodel FROM cars WHERE LOWER(carsmake) = LOWER('" . $make. "') AND carsyear = '" . $year . "' ORDER BY carsmodel ASC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carsmodel'];
	  }
	} else {
	  $json[] = "none";
	}
} else if (isset($_GET['type']) && isset($_GET['make'])) {
	$type = $_GET['type'];
	$make = $_GET['make'];
	
	$query = "SELECT DISTINCT carsyear FROM cars WHERE LOWER(carstype) = LOWER('" . $type . "') AND LOWER(carsmake) = LOWER('" . $make . "') ORDER BY carsyear DESC";

	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['carsyear'];
	  }
	} else {
	  $json[] = "none";
	}
} else if (isset($_GET['type'])) {
	$type = $_GET['type'];
	
	$query = "SELECT * FROM cars WHERE LOWER(carstype) = LOWER('" . $type . "') ORDER BY carsmake DESC";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row;
	  }
	} else {
	  $json[] = "none";
	}
	
}
 else if (isset($_GET['type']) && (isset($_GET['model'])) && (isset($_GET['make']))) {
	$type = $_GET['type'];
	$model = $_GET['model'];
	$make = $_GET['make'];
	
	$query = "SELECT * FROM cars WHERE LOWER(carstype) = LOWER('" . $type . "') AND LOWER(carsmodel) = LOWER('" . $model . "')AND LOWER(carsmake) = LOWER('" . $make . "')";
	
	
	

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