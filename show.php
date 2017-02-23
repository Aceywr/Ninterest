<!DOCTYPE html>
<html>
<head>
	<title>show page</title>
	<meta charset="utf-8">
</head>
<body>
	<div id="content">
		<ul>
		<?php

			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = 'root';
			$conn = new mysqli($dbhost, $dbuser, $dbpass);

			$sql = "SELECT id, title, content, time
					FROM article";
			mysqli_select_db($conn, "users");
			$retval = mysqli_query($conn, $sql, MYSQLI_USE_RESULT);

			while ($row = mysqli_fetch_array($retval, MYSQL_NUM)) {

				$constract = mb_substr($row[2], 0, 200) . "......";
				$encode = mb_detect_encoding($row[1], array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
				echo $encode;
				echo "<li><h2>{$row[1]}</h2><p>{$row[3]}</p><h3>{$constract}</h3></li>";
			}
			mysqli_close($conn);
		?>
		</ul>
	</div>
</body>
</html>