<!DOCTYPE html>
<html>
<head>
	<title>userPage</title>
	
	<script src='js/jquery-3.1.1.min.js'></script>
  	<script src="js/nav.js"></script>
  	<script src="js/prefixfree/prefixfree.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="css/user.css">
</head>

<body style="background: url(img/bg.jpg);">


			<nav class="nav">
				<a href="#" class="logo">logo</a>
				<div class="mobile-toggle">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<ul>
					<li><a href="#">HOME</a></li>
					<li><a href="#">LAB</a></li>
					<li><a href="#">BLOG</a></li>
					<li><a href="#">ABOUT</a></li>
				</ul>
				<div class="lo">
				<?php
					session_start();
					if(isset($_SESSION['user'])){
				?>
				<a href="#" id="name"><?php echo $_SESSION['user'];?></a>
				<?php }else{?>
				<a href="#" id="log">登录</a>
				<?php }?>
				</div>				
			</nav>
			<div class="all">
			<div class="ban" style="background: url(img/ban.jpg);">
				<div class="us">
				<div class="avater"><img src="img/avater.jpg"</div>
				<div class="nmin"><?php echo $_SESSION['user'];?></div>
				<div class="motto">这是你的个性签名</div>
				</div>
			</div>
			</div>	
			<div class="list">
				<div class="btn">
				<div class="li_nav topBotomBordersIn">
					
					<a href="#">发布</a>
					<a href="#">收藏</a>
					<a href="#">设置</a>
					
				</div>
				<div class="issue"><a href="upload.php">上传文章</a></div>
				</div>
				<div class="issued">
				<div class="iword">您已发布的文章</div>
				<div id="columns">
					<?php
								$dbhost = 'localhost';
								$dbuser = 'root';
								$dbpass = 'root';
								$conn = new mysqli($dbhost, $dbuser, $dbpass);

								$sql = "SELECT id, title, content, time, cover
										FROM article
										where auther = '".$_SESSION['user']."'";
								mysqli_select_db($conn, "users");
								$retval = mysqli_query($conn, $sql, MYSQLI_USE_RESULT);
					
				  				while ($row = mysqli_fetch_array($retval, MYSQL_NUM)) {

								$constract = mb_substr($row[2], 0, 200) . "......";
								//$img = str_replace("/", "\\", $row[4]);
								
								echo "<figure><img src='{$row[4]}{$row[1]}.jpg'><figcaption>{$row[1]}</figcaption><p>{$constract}</p></figure>";
								}
								mysqli_close($conn);
				  	?>
				</div>
				</div>
				<div class="issued">
					<div class="iword">您收藏的文章</div>
				</div>
			</div>
			</div>

</body>
</html>