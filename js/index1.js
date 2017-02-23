function dele(str){
	$.ajax({
			
			type: "GET",
			url: "dele.php",
			dataType: "json",
			data: {"id":str},
			success: function(data){
				if(data.success==1){			
					location.reload();
				}
			}
			
		});
}

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
			success: function(data){
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

$(document).on('click',"#logout",function(){
	$.post("login.php?action=logout",function(msg){
		if(msg==1){
			$(".login").remove();
			var div = "<div class='login'><div class='form'><p>管理员登录</p><input type='text' placeholder='用戶名' name='user' id='user'><input type='password' placeholder='密碼' name='pass' id='pass'><div class='sub'><input type='submit' class='logbtn' value='登錄'/></div></div>"
			$("body").append(div);
		}
	});
});
