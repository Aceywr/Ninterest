<?php
	//include_once 'simple_html_dom.php';
	$html = file_get_contents('http://news-at.zhihu.com/api/4/news/latest');
	$html = json_decode($html, true)["stories"];
	foreach($html as $key){
		$title = $key["title"];
		echo $title;
		$co = $key["images"][0];
		$cover = "img/zhihu/";
		$id = $key["id"];
		$url = "http://news-at.zhihu.com/api/4/news/".$id;
		echo $url;
		$det = file_get_contents($url);
		$content = json_decode($det, true)["body"];
		$t = iconv("UTF-8", "GBK", $title); 
		$img = mb_substr($t, 0, 4, "GBK");
		$saveto = "C:\wamp64\www\php\img\zhihu\\".$img.".jpg";
		$d = file_get_contents($co);
		file_put_contents($saveto, $d);
		/*$dir = "C:\wamp64\www\php\img\zhihu\\".$img;
		if (!is_dir($dir)) mkdir($dir);
		$allimg = $content->find("img");
		$m = 0;
		foreach($allimg as $i){
			$im = $i->src;
			if(!empty($im)){
				$sa = "C:\wamp64\www\php\img\zhihu\\".$img."\\".(string)$m.".jpg";
				file_put_contents($sa, file_get_contents($im));
				$imge = iconv("GBK", "UTF-8", $img); 
				$content->find("img", $m)->src = $cover.$imge."/".(string)$m.".jpg";
				$m = $m + 1;
			}	
		}*/
		$now = time();
		$time = date("Y-m-d", $now);
		$auther = "chule";
		$cate = "CULTURE";
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
	}

?>