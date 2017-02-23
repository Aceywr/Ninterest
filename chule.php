<?php
	include_once 'simple_html_dom.php';
	$html = file_get_html('http://www.chuapp.com/');

	$listData=$html->find(".item a");
	$listData=array_chunk($listData, 9);
	$listData=$listData[0];
	foreach($listData as $key){
		$url = $key->href;
		$title = $key->title;
		$co = $key->find("img",0)->src;
		$http = "http://www.chuapp.com".$url;
		echo $http;
		$info = file_get_html($http);
		$cover = "img/chule/";
		$content = $info->find(".the-content",0);

		$t = iconv("UTF-8", "GBK", $title); 
		$img = mb_substr($t, 0, 4, "GBK");
		$saveto = "C:\wamp64\www\php\img\chule\\".$img.".jpg";
		$d = file_get_contents($co);
		file_put_contents($saveto, $d);
		$dir = "C:\wamp64\www\php\img\chule\\".$img;
		if (!is_dir($dir)) mkdir($dir);
		$allimg = $content->find("img");
		$m = 0;
		foreach($allimg as $i){
			$im = $i->src;
			if(!empty($im)){
				$sa = "C:\wamp64\www\php\img\chule\\".$img."\\".(string)$m.".jpg";
				file_put_contents($sa, file_get_contents($im));
				$imge = iconv("GBK", "UTF-8", $img); 
				$content->find("img", $m)->src = $cover.$imge."/".(string)$m.".jpg";
				$m = $m + 1;
			}	
		}
		$now = time();
		$time = date("Y-m-d", $now);
		$auther = "chule";
		$cate = "GAME";
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