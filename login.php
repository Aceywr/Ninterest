<?php
	
	error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	header("Content-type: text/html; charset=utf-8");
	$con = mysql_connect("localhost","root",'root');
	mysql_select_db("users", $con);
	mysql_query("SET names UTF8");

	$action = $_GET['action'];
	if($action == 'login'){
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
		$ifname = 0;
		while($row = mysql_fetch_array($result))
		{
			if($row["name"] == $name && $row["pass"] == $pass)
				$sign = 1;
			if($row["name"] == $name)
				$ifname = 1;
		}
		if($ifname == 0)
		{
			$arr["success"] = 0;
	    	$arr["msg"] = "用户名不存在，請先注冊";
		}
		else
		{
			if($sign == 1)
			{
				$query = mysql_query("select * from users where name='$name'");
				$row = mysql_fetch_array($query);
				$counts = $row["login_counts"] + 1;
				$_SESSION["id"] = $row["id"];
				$_SESSION["user"] = $row["name"];
				$_SESSION["login_time"] = $row["login_time"];
				$_SESSION["login_counts"] = $counts;
				date_default_timezone_set("Asia/Shanghai");
				$logintime = time();
				$rs = mysql_query("update users set login_time = '$logintime', login_counts = '$counts' where name='$name'");
				if($rs){
					$arr["success"] = 1;
	    			$arr["msg"] = "登陸成功";
	    			$arr["user"] = $_SESSION["user"];
	    			$arr["login_time"] = date('Y-m-d H:i:s',$_SESSION["login_time"]);
	    			$arr["login_counts"] = $_SESSION["login_counts"];
	    			$arr["id"] = $_SESSION["id"];
				}else{
					$arr["success"] = 0;
					$arr["msg"] = "登录失败";
				} 
				
			}
			else
			{
				$arr["success"] = 0;
	    		$arr["msg"] = "密码错误";
			}
			
		}
		echo json_encode($arr);
	

	}elseif ($action == 'logout') {
			unset($_SESSION);
			session_destroy();
			echo('1');
	}

	


	



?>