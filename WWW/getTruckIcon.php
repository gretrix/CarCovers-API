<?php
header("Access-Control-Allow-Origin: *");
include 'conn.php';

if (isset($_GET['make']) && isset($_GET['model']) && isset($_GET['body'])) {
	$make = $_GET['make'];
	$model = $_GET['model'];
	$body = $_GET['body'];
	
	$query = "
		SELECT targetfolder, targetname FROM truckicons 
		WHERE LOWER(iconmake)  = LOWER('" . $make. "') 
		AND   LOWER(iconmodel) = LOWER('" . $model . "') 
		AND   LOWER(iconbody)  = LOWER('" . $body . "') 
		LIMIT 1";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$json[] = $row;
		}
	} else {
		$json[] = "none";
	}
}

echo json_encode($json);