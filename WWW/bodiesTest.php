<?php
header("Access-Control-Allow-Origin: *");
include 'conn.php';

$query = "SELECT DISTINCT bodytitle, bodymake FROM bodies WHERE bodytype = 'Truck' ORDER BY bodymake ASC";
	$result = mysqli_query($conn, $query);
	echo "<div style='display:grid;grid-template-columns:1fr 1fr 1fr;column-gap:15px;'>";
	if (mysqli_num_rows($result) > 0) {
		$lastmake = '';
	  while($row = mysqli_fetch_assoc($result)) {
		  if ($lastmake != $row['bodymake']) { 
			echo "</div>";
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><h1>" . $row['bodymake'] . "</h1>"; 
			echo "<div style='display:grid;grid-template-columns:1fr 1fr 1fr;column-gap:15px;'>";
		  }
		echo "<div style='border-bottom:1px solid black;'><img src='https://api.carcovers.com/img/bodies/" . $row['bodymake'] . "/" . $row['bodytitle'] . ".jpg' onerror='this.error=null;this.src=\"https://cdn.pixabay.com/photo/2016/10/04/13/52/fail-1714367_1280.jpg\"' style='width:200px;'><p>" . $row['bodymake'] . " :: " . $row['bodytitle'] . "</p></div>";
		$lastmake = $row['bodymake'];
	  }
	}
	echo "</div>";