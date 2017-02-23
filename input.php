<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	$con = new mysqli("localhost","root",'root');
	mysqli_select_db($con , "users");

	$title = stripslashes(trim($_POST['title']));
	$content = stripslashes(trim($_POST['content']));
	$cate = stripslashes(trim($_POST['cate']));
	$time = date('y-m-d', time());
	session_start();
	$auther = $_SESSION['user'];
	$furl = "C:/wamp64/www/php/img/".$auther."/";
	$url = "img/".$auther."/";
	$cover = $url;

	$imgtype = array(
  	'gif'=>'gif',
  	'png'=>'png',
  	'jpg'=>'jpeg',
  	'jpeg'=>'jpeg'
	);
	$ftype = $_POST['filetype'];
	$message = $_POST['message'];
	if(empty($title)){
		exit;
	}
	if(empty($content)){
		exit;
	}

	
	$sql =  "INSERT INTO `article` (`title`,`content`,`time`,`auther`,`cover`,`cate`) VALUES ("
			."'"
			.$title		."','"
			.$content	."','"
			.$time		."','"
			.$auther	."','"
			.$cover		."','"
			.$cate
			."'"
			.");";
	mysqli_query($con, $sql, MYSQLI_USE_RESULT);
	//$sql1 = "SELECT id FROM article where title ="."'".$title;
	//$row = mysqli_query($con, $sql1, MYSQLI_USE_RESULT);
	$message = base64_decode(substr($message,strlen('data:image/'.$imgtype[strtolower($ftype)].';base64,')));
	$title = mb_substr($title, 0, 4);
	$title = iconv('utf-8', 'gbk', $title);
	
	$filename = $title.".".$ftype;
	
	if(is_dir($furl) === false){mkdir($furl);};
	$file = fopen($furl.$filename,"wb");
	if(fwrite($file,$message) === false){
	$arr["success"] = 0;
	$arr["msg"] = "上传失败";
	}
	$arr["success"] = 1;
	$arr["msg"] = "上传成功";
	echo json_encode($arr);
	mysqli_close($con);
?>
