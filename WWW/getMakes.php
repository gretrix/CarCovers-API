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

if (isset($_GET['type'])) {
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