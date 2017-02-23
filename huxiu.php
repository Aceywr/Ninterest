<?php
	include_once 'simple_html_dom.php';
	$html = file_get_html('https://www.huxiu.com/');

	$listData=$html->find(".mod-thumb a");
	$listData=array_chunk($listData, 8);
	$listData=$listData[0];
	foreach($listData as $key){
		$url = $key->href;
		$title = $key->title;
		$http = "https://www.huxiu.com".$url;
		echo $http;
		$info = file_get_html($http);
		$cover = "img/huxiu/";
		$content = $info->find("#article_content",0);
		if(!empty($content)){
			$c = $info->find(".article-img-box img",0);
			$co = $info->find(".article-img-box img",0)->src;
			$t = iconv("UTF-8", "GBK", $title); 
			$img = mb_substr($t, 0, 4, "GBK");
			$saveto = "C:\wamp64\www\php\img\huxiu\\".$img.".jpg";
			$d = file_get_contents($co);
			file_put_contents($saveto, $d);	
			$content->class = "the-content";
			$now = time();
			$time = date("Y-m-d", $now);
			$auther = "huxiu";
			$cate = "SCIENCE";
			$con = new mysqli("localhost","root",'root');
			mysqli_select_db($con , "users");
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
			mysqli_close($con);
			echo "爬取成功！<br/>";
		}else{
			echo "爬取失败！<br/>";
		}
	}

?>