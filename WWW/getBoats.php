<?php


header("Access-Control-Allow-Origin: *");
include 'conn.php';

 if ((isset($_GET['year'])) && isset($_GET['make'])  && isset($_GET['model'])) {
	
	$year = $_GET['year'];
	$make = strtolower($_GET['make']);
	$model = strtolower($_GET['model']);

	
	$query = "
		Select  * from boats
		where '".$year."' >= min_year and  '".$year."' <= max_year
		and make = '".$make."'
		and model = '".$model."'
		
		";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['body'];
	  }
	} else {
	  $json[] = "none";
	}
	
} else if ((isset($_GET['year'])) && isset($_GET['make'])) {
	
	$year = $_GET['year'];
	$make = strtolower($_GET['make']);
	$model = strtolower($_GET['model']);
	
	
	$query = "
		Select  distinct model from boats
		where '".$year."' >= min_year and  '".$year."' <= max_year
		and make = '".$make."'

		
		";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['model'];
	  }
	} else {
	  $json[] = "none";
	}
	
} else if ((isset($_GET['year']))) {
	
	$year = $_GET['year'];
	$make = strtolower($_GET['make']);
	$model = strtolower($_GET['model']);
	
	$query = "
		SELECT Distinct make FROM boats
		where '".$year."' >= min_year and  '".$year."' <= max_year

		
		";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['make'];
	  }
	} else {
	  $json[] = "none";
	}
	
} else {
	$query = "
		SELECT Distinct make FROM boats
		";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['make'];
	  }
	} else {
	  $json[] = "none";
	}
}


	echo json_encode($json);