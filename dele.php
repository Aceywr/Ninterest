<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$conn = new mysqli($dbhost, $dbuser, $dbpass);
	$id = $_GET["id"];

	$sql = "DELETE FROM article where id = '".$id."'";

	mysqli_select_db($conn, "users");
	mysqli_query($conn, $sql, MYSQLI_USE_RESULT);

	$arr["success"] = 1;
	mysqli_close($conn);
	echo json_encode($arr);
?>