<?php

			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = 'root';
			$conn = new mysqli($dbhost, $dbuser, $dbpass);
			$id = $_GET["id"];

			$sql = "SELECT title, content, time, auther, cover
					FROM article where id = '".$id."'";
			mysqli_select_db($conn, "users");
			$retval = mysqli_query($conn, $sql, MYSQLI_USE_RESULT);

			while ($row = mysqli_fetch_array($retval, MYSQL_NUM)) {

			$arr["success"] = 1;
			$arr["title"] = $row[0];
			$arr["content"] = $row[1];
			$arr["time"] = $row[2];
			$arr["auther"] = $row[3]; 
			$img = mb_substr($row[0], 0, 4);
			$arr["cover"] = $row[4].$img.'.jpg';
			 
			}
			mysqli_close($conn);
			echo json_encode($arr);

?>