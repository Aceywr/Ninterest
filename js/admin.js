$(document).on('click',"#upload",function(){
	editor.sync();
	var title = $('#title').val();
	var content = $('#editor_id').val();
	var cate = $('#cate').val();
	var filetype = ['jpg','jpeg','png','gif'];
	if($('.image').get(0).files){
	  	fi = $('.image').get(0).files[0];
	  	var fname = fi.name.split('.');
	  	if(filetype.indexOf(fname[1].toLowerCase()) == -1){
        	alert('文件格式不支持');
        	return ;
      	}
      	var fr = new FileReader();
      	fr.readAsDataURL(fi);
      	fr.onload = function(frev){
      		pic = frev.target.result;
		$.ajax({
			
			type: "POST",
			url: "input.php",
			dataType: "json",
			data: {
				message:pic,
	            filename:fname[0],
	            filetype:fname[1],
	            filesize:fi.size,
	            "title":title,
	            "content":content,
	            "cate":cate
	        },
			beforeSend: function(){

				$('<div id="msg"/>').html("正在上传...").appendTo('.sub').fadeOut(2000);	
			},
			success: function(data){
				console.log(data);
				if(data.success==1){
					$('<div id="msg"/>').html("<p>"+data.msg+"</p>").appendTo('.sub').fadeOut(5000);
				}else{
					$("#msg").remove();
					$("<div id = 'errmsg' />").html("<p>上传失败</p>").appendTo('.sub').fadeOut(2000);
					return false;
				}
			}
			
		});
	}
}
});

$(function(){
	$("#user").focus();
});
$(document).on("click",".logbtn",function(){
		var user = $("#user").val();
		var pass = $("#pass").val();
		if(user == ''){
			$('<div id="msg"/>').html("用户名不能为空！").appendTo('.sub').fadeOut(2000);
			$("#user").focus();
			return false;
		}
		else{
			if (pass == ''){
				$('<div id="msg"/>').html("密码不能为空！").appendTo('.sub').fadeOut(2000);
				$("#pass").focus();
				return false;
			}
		}
		$.ajax({
			
			type: "POST",
			url: "login.php?action=login",
			dataType: "json",
			data: {"user":user,"pass":pass},
			beforeSend: function(){

				$('<div id="msg"/>').html("正在登錄...").appendTo('.sub').fadeOut(2000);	
			},
			success: function(data){
				console.log(data);
				if(data.success==1){
					location.reload();
					

				}else{
					$("#msg").remove();
					$("<div id = 'errmsg' />").html(data.msg).appendTo('.sub').fadeOut(2000);
					return false;
				}
			}
			
		});
});	