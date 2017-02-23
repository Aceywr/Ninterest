<!DOCTYPE html>
<html>
<head>
	<title>index</title>
	<script src='js/jquery-3.1.1.min.js'></script>
	<script src='js/bootstrap.js'></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<div class="container-fluid">
	<?php
		session_start();
		if(isset($_SESSION['user'])){
			echo "<h1>已发布的文章</h1>
						<table class='table table-hover table-bordered'>
						<thead>
						  <tr>
						  	<th>ID</th>
						  	<th>标题</th>
						  	<th>作者</th>
						  	<th>发布时间</th>
						  	<th>文章类型</th>
						  	<th>操作</th>
						  </tr>
						</thead>  
						  <tbody>";
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = 'root';
			$conn = new mysqli($dbhost, $dbuser, $dbpass);
			mysqli_select_db($conn, "users");
			$sql = "SELECT id, title, time, auther,cate
					FROM article";
			$retval = mysqli_query($conn, $sql, MYSQLI_USE_RESULT);
			while ($row = mysqli_fetch_array($retval, MYSQL_NUM)) {

				echo "<tr id='{$row[0]}'><td>{$row[0]}</td>
						  		<td>{$row[1]}</td>
						  		<td>{$row[3]}</td>
						  		<td>{$row[2]}</td>
						  		<td>{$row[4]}</td>
						  		<td><a onclick='dele($row[0])'>删除这篇文章</a></td></tr>";
				
			}
			echo "</tbody></table><a href='' id='logout'>【退出登录】</a>";
			mysqli_close($conn);
		}else{?>
				<div class='login'>
					<div class='form' >
						<p>管理员登录</p>
						<input type='text' placeholder='用戶名' name='user' id="user">
						<input type='password' placeholder='密碼' name='pass' id="pass">
						<div class="sub">
						<input type="submit" class="logbtn" value="登錄"/>
						</div>
					</div>
				</div>	

	<?php }?>
	</div>
<script src="js/index1.js"></script>
</body>
</html>