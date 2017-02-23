<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<meta charset="utf-8">
	<script type="text/javascript" src='js/jquery-3.1.1.min.js'></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel='stylesheet' href='editor/themes/default/default.css' />
	
</head>
<body>
	<div class='input container-fluid'>
	<?php
		session_start();
		if(isset($_SESSION['user'])){
	?>
	<h3>上传文章</h3>
	<input type='text' placeholder='标题' name='title' id='title' class="form-control">
	<textarea id='editor_id' name='content' class="form-control" style='height:300px;'></textarea>
	<span>封面图片：</span><input type='file' name='image' id='image' class='image btn btn-default'><br>
	<span>文章类型：</span>
	<select id="cate" class="btn btn-default dropdown-toggle">
		<option value="SCIENCE">SCIENCE</option>
		<option value="CULTURE">CULTURE</option>
		<option value="GAME">GAME</option>
	</select>
	<div class="sub">
	<input type='submit' id='upload' class="col-md-1 btn btn-success" value='上传'/>
	<a href='index.php'><h3>【现在查看】</h3></a>
	</div>
	
	<?php }else{?>
	
				
					<div class='form' >
						<p>用户登录</p>
						<input type='text' placeholder='用戶名' name='user' id="user">
						<input type='password' placeholder='密碼' name='pass' id="pass">
						<div class="sub">
						<input type="submit" class="logbtn" value="登錄"/>
						<input type="submit" class="regbtn" value="注册"/>
						</div>
					</div>
					

				
	<?php }?>
	</div>
	<script charset='utf-8' src='editor/kindeditor.js'></script>
	<script charset='utf-8' src='editor/lang/zh-CN.js'></script>
	<script charset='utf-8'>
	window.editor = KindEditor.create('#editor_id');
	</script>
	<script src="js/admin.js"></script>
</body>
</html>