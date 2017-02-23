<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	header("Content-type: text/html; charset=utf-8");
	$con = mysql_connect("localhost","root",'root');
	mysql_select_db("users", $con);
	mysql_query("SET names UTF8");

	$name = stripslashes(trim($_POST['user']));
	$pass = stripslashes(trim($_POST['pass']));

	if(empty($name)){
		exit;
	}
	if(empty($pass)){
		exit;
	}
	$result = mysql_query("SELECT * FROM users");
	$sign = 0;
	while($row = mysql_fetch_array($result))
	{
		if($row["name"] == $name)
			$sign = 1;
	}
	if($sign == 1){
		$arr["success"] = 0;
		$arr["msg"] = "用户名已存在";
	}else{
		mysql_query(
		"INSERT INTO `users` (`name`,`pass`) VALUES ("
			."'"
			.$name		."','"
			.$pass	
			."'"
			.");"
		);
		$arr["success"] = 1;
		$arr["msg"] = "注册成功!";
		$query = mysql_query("select * from users where name='$name'");
		$row = mysql_fetch_array($query);

		$arr["id"] = $row["id"];

	}
	echo json_encode($arr);
?>