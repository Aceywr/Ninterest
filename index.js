$(document).on("click","#home",function(){
	$(".SCIENCE").removeClass("alpha").addClass("ini");
	$(".CULTURE").removeClass("alpha").addClass("ini");
	$(".GAME").removeClass("alpha").addClass("ini");
})
$(document).on("click","#te",function(){
	$(".CULTURE").removeClass("ini").addClass("alpha");
	$(".GAME").removeClass("ini").addClass("alpha");
	$(".SCIENCE").removeClass("alpha").addClass("ini");
})
$(document).on("click","#cul",function(){
	$(".SCIENCE").removeClass("ini").addClass("alpha");
	$(".GAME").removeClass("ini").addClass("alpha");
	$(".CULTURE").removeClass("alpha").addClass("ini");
})
$(document).on("click","#game",function(){
	$(".SCIENCE").removeClass("ini").addClass("alpha");
	$(".CULTURE").removeClass("ini").addClass("alpha");
	$(".GAME").removeClass("alpha").addClass("ini");
})
function myjs(str){
	$.ajax({
			
			type: "GET",
			url: "deta.php",
			dataType: "json",
			data: {"id":str},
			success: function(data){
				if(data.success==1){	
					var div = "<div class='dt'><div class='t'>"+data.title+"</div><div class='a'>"+data.time+"<span> 发布者：</sapn>"+data.auther+"</div><div class='c'><img src='"+data.cover+"'/>"+data.content+"</div></div>";		
					$('.deta').html(div);
				}
			}
			
		});
}

$(document).on("click",".fig",function(){
	$(".scroll").addClass("scro");
	$(".cover").addClass("in");
	$(".esc").addClass("in");
	$(".wrap").addClass('alpha');
	$(".deta").addClass("in");
})
$(document).on("click",".esc",function(){
	location.reload();
})
$(document).on("click",".ok",function(){
	location.reload();
})

$(document).on("click","#log",function(){
	$(".cover").addClass("in");
	$(".esc").addClass("in");
	$(".wrap").addClass('al');
	$(".login").addClass("in");
})

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
		$('form').fadeOut(500);
		$('.login').addClass('form-success');
		$.ajax({
			
			type: "POST",
			url: "login.php?action=login",
			dataType: "json",
			data: {"user":user,"pass":pass},
			success: function(data){
				console.log(data);
				if(data.success==1){	
					$(".form").remove().fadeOut(500);
					if(data.login_counts == 1){
							$(".container").append("<div class='form'><p><strong>"+data.user+"</strong>，欢迎光临!</p><p>您是本站的第"+data.id+"位用户</p><p>您是第1次登录本站！</p><button class='ok'>确定</button></div>");
						}else{
							$(".container").append("<div class='form'><p><strong>"+data.user+"</strong>，欢迎回来!</p><p>您是本站的第"+data.id+"位用户</p><p>这是您第<span>"+data.login_counts+"</span>次登录本站</p><p>上次登录本站的时间是：<span>"+data.login_time+"</span></p><button class='ok'>确定</button></div>");
						}
				}else{
					$("#msg").remove();
					$("<div id = 'errmsg' />").html(data.msg).appendTo('.sub').fadeOut(2000);
					return false;
				}
			}
			
		});
});	

$(document).on('click',".logout",function(){
	$.post("login.php?action=logout",function(msg){
		if(msg==1){
			location.reload();
		}
	});
});

$(document).on('click',".logi",function(){
	$(".container").remove().fadeOut(500);
	var div = "<div class='container'><h1>Welcome</h1><div class='form'><input type='text' placeholder='Username' name='user' id='user'><input type='password' placeholder='Password' name='pass' id='pass'><div class='sub'><button type='submit' class='logbtn'>登錄</button><button type='submit' class='onreg'>注册</button></div></div></div>"
	$(".login").append(div).fadeIn(500);
});

$(document).on('click',".regbtn",function(){
	$(".container").remove().fadeOut(500);
	var div = "<div class='container'><h1>Register</h1><div class='form'><input type='text' placeholder='Username' name='user' id='user'><input type='password' placeholder='Password' name='pass' id='pass'><input type='password' placeholder='Password again' name='repass' id='repass'><div class='sub'><button type='submit' class='onreg'>注册</button></div></div></div>"
	$(".login").append(div).fadeIn(500);
})

$(document).on('click','.onreg',function(){
	var user = $("#user").val();
	var pass = $("#pass").val();
	var repass = $("#repass").val();
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
			}else{
				if (repass == ''){
					$('<div id="msg"/>').html("确认密码不能为空！").appendTo('.sub').fadeOut(2000);
					$("#repass").focus();
					return false;
				}
			}
		}
	if(pass != repass){
		$('<div id="msg"/>').html("俩个密码不相同！").appendTo('.sub').fadeOut(2000);
		return false;
	}
	$.ajax({
			
			type: "POST",
			url: "reg.php",
			dataType: "json",
			data: {"user":user,"pass":pass},
			success: function(data){
				console.log(data);
				if(data.success==1){
					$(".form").fadeOut(500);
					$(".container").append("<div class='form'><p>"+data.msg+"</p><p>恭喜你成为本站第"+data.id+"位用户</p><p><button class='logi'>现在快登录吧!</button></p></div>").fadeIn(500);
	
				}else{
					$("#msg").remove();
					$("<div id = 'errmsg' />").html(data.msg).appendTo('.sub').fadeOut(2000);
					return false;
				}
			}
			
		});


});
