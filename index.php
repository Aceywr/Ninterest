<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>index</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <script src='js/jquery-3.1.1.min.js'></script>
  <script src="js/nav.js"></script>
  
  <script src="js/prefixfree/prefixfree.min.js"></script>

</head>
<?php

			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = 'root';
			$conn = new mysqli($dbhost, $dbuser, $dbpass);

			$sql = "SELECT id, title, content, time, cover, cate, auther
					FROM article";
			mysqli_select_db($conn, "users");
			$retval = mysqli_query($conn, $sql, MYSQLI_USE_RESULT);
?>
<body style="background: url(img/bg.jpg);">
	<div class="scroll">
	<div class="cover">
		<div class="esc"><b></b></div>
	</div>
	<div class="deta"></div>
	</div>
	<div class="wrap">
	<div class="login">
	<div class="container">
	<h1>Welcome</h1>
	
	<div class="form">
		<input type='text' placeholder="Username" name='user' id="user">
		<input type='password' placeholder="Password" name='pass' id="pass">
		<div class="sub">
		<button type="submit" class="logbtn">登錄</button>
		<button type="submit" class="regbtn">注册</button>
		</div>
	</div>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
	</div>
	<nav class="nav">
				<a href="#" class="logo">Ninterest</a>
				<div class="mobile-toggle">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<ul>
					<li><a id="home">HOME</a></li>
					<li><a id="te">SCIENCE</a></li>
					<li><a id="cul">CULTURE</a></li>
					<li><a id="game">GAME</a></li>
				</ul>
				
				<div class="lo">
				<?php
					session_start();
					if(isset($_SESSION['user'])){
				?>
				<a href="userPage.php"><?php echo $_SESSION['user'];?></a><span> </span><a href="" class="logout">[退出登录]</a>
				<?php }else{?>
				<a href="#" id="log">登录</a>
				<?php }?>
				</div>				
			</nav>
  	<div id="columns">
  	<?php
  	while ($row = mysqli_fetch_array($retval, MYSQL_NUM)) {

				//$img = str_replace("/", "\\", $row[4]);
				$img = mb_substr($row[1], 0, 4);
				echo "<figure onclick='myjs($row[0])' class='fig {$row[5]}'><img src='{$row[4]}{$img}.jpg'><figcaption>{$row[1]}</figcaption><span>{$row[3]}</span>
	</figure>";
			}
			mysqli_close($conn);
  	?>
	

	</div>
	</div>
<script src="index.js"></script>

  
</body>
</html>
