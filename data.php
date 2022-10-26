<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","","demodb");

$query = "SELECT * FROM cricket";

$result = mysqli_query($conn,$query);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>