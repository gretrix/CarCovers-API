<?php


header("Access-Control-Allow-Origin: *");
include 'conn.php';

  if ((isset($_GET['year'])) && isset($_GET['make'])  && isset($_GET['type']) && isset($_GET['model']) ) {
	
	$year = $_GET['year'];
	$make = strtolower($_GET['make']);
	$type = strtolower($_GET['type']);
	$model = strtolower($_GET['model']);

	
	$query = "
		Select  * from ukvehicles1
		where '".$year."' between min_year and max_year
		and make = '".$make."'
		and type = '".$type."'
		and model = '".$model."'
		
		";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['title'];
	  }
	} else {
	  $json[] = "none";
	}
	
} 
  else if ((isset($_GET['year'])) && isset($_GET['make'])  && isset($_GET['type'])) {
	
	$year = $_GET['year'];
	$make = strtolower($_GET['make']);
	$type = strtolower($_GET['type']);

	
	$query = "
		Select  distinct model from ukvehicles1
		where '".$year."' between min_year and max_year
		and make = '".$make."'
		and type = '".$type."'
		
		";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$json[] = $row['model'];
	  }
	} else {
	  $json[] = "none";
	}
	
} else if ((isset($_GET['year'])) && isset($_GET['make'])  && isset($_GET['model'])) {
	
	$year = $_GET['year'];
	$make = strtolower($_GET['make']);
	$model = strtolower($_GET['model']);

	
	$query = "
		Select  * from ukvehicles1
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
		Select  distinct model from ukvehicles1
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
	
}
else if ((isset($_GET['year'])) && isset($_GET['type'])) {
	
	$year = $_GET['year'];
	$type = strtolower($_GET['type']);
	
	
	
	$query = "
		Select  Distinct make from ukvehicles1
		where '".$year."' >= min_year and  '".$year."' <= max_year
		and type = '".$type."'

		
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
else if ((isset($_GET['year']))) {
	
	$year = $_GET['year'];
	$make = strtolower($_GET['make']);
	$model = strtolower($_GET['model']);
	
	$query = "
		SELECT Distinct make FROM ukvehicles1
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
	
} else if (isset($_GET['type'])) {
	$type = $_GET['type'];
	
	$query = "SELECT Min(min_year),Max(max_year) FROM ukvehicles1 WHERE LOWER(type) = LOWER('" . $type . "')";
	$result = mysqli_query($conn, $query);
	
	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		$min = $row['Min(min_year)'];
		$max = $row['Max(max_year)'];
		if(!empty($min) || !empty($max)){
			for($i = "$max"; $i >= "$min"; $i--){
			$json[] = $i;
			
		}
		} else {
			 $json[] = "Coming Soon";
		}
	  }
	} else {
	  $json[] = "none";
	}
}


	echo json_encode($json);