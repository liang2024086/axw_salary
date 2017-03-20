<!DOCTYPE html>

<?php
/*
	if (isset($_COOKIE['aixinwuSalaryUser'])){?>
		<script type="text/javascript">
			window.location.href="login.html";
		</script>
<?php	}
*/
?>

<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>登录-爱心屋工资</title>
		<link type="text/css" rel="stylesheet" href="moke8/login.css">

<link type="text/css" rel="stylesheet" href="moke8/global.css">
<link type="text/css" rel="stylesheet" href="moke8/asyncbox.css">
<link type="text/css" rel="stylesheet" href="moke8/front.css">
<link type="text/css" rel="stylesheet" href="moke8/main_2.css">


		<script type="text/javascript" src="moke8/jquery-1.js"></script>
<script type="text/javascript" src="moke8/utils.js"></script>
<script type="text/javascript" src="moke8/AsyncBox.js"></script>
<script type="text/javascript" src="moke8/common.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery.datetimepicker.js"></script>
<script src="js/show.js"></script>

 <script>

  function get(stuId){
  	$.ajax({
		 type:'POST',
		 url:'php/getPWD.php',
		 data: "stuId="+stuId,
		 success:function(data){
		     alert(data.split("|")[1]);
//			 document.getElementById("aaa").innerHTML = data;
		 }
		});
  }
  function getPWD(){
     var stuId = document.getElementById("account").value;
     if (stuId == ''){
         alert("请输入学号");
     }
     else{
		 get(stuId);
     }
  }
</script>

	</head>
<body class="body-login">
<div id = "aaa"> </div>
<div class="loginbj">
<div class="wrapper">
	<div class="m-login is-login">
		<div class="formArea">
			<form method="post" action="login.php" name="aform" id="aform">
				<input name="furl" value="" type="hidden">
			<div class="m-from">
				<div class="item item-custips">
					<span class="form-tips form-tips-error"></span>
				</div>
				<div class="item">
					<div class="m-ipt-txt">
						<input class="ipt-txt ipt-txt-mail" id="account" onKeyDown="javaScript:if(event.keyCode == 13){signUp();}" placeholder="学号" name="account" maxlength="50" type="text">
					</div>
				</div>
				<div class="item">
					<div class="m-ipt-txt">
						<input class="ipt-txt ipt-txt-pwd" id="pwd" onKeyDown="javaScript:if(event.keyCode == 13){signUp();}" placeholder="密码" name="pwd" maxlength="30" type="password">
					</div>
				</div>
				<div class="item">
					<input value="1" name="overtime" id="overtimeInput" type="hidden">
				</div>
				<div class="item item-submit">
					<a class="btn_blueA" href="javascript:;" onClick="signUp();">立即登录</a>
					<span class="form-tips"><a style="cursor:pointer;" onclick = "getPWD();">忘记密码了？</a></span>
				</div>
			</div>
			</form>
		</div>
		<div class="logoArea">
			<a class="logo" href="http://aixinwu.sjtu.edu.cn/">爱心屋 aixinwu.sjtu.edu.cn</a>
		</div>
	</div>
</div>
</div>
<!--云滚动-->
<div id="demo" class="cloud-pic">
<table cellspace="0" align="left" border="0" cellpadding="0"><tbody><tr><td id="demo1" valign="top"><img src="moke8/cloud-bj.png"><img src="moke8/cloud-bj.png"></td><td id="demo2" valign="top"><img src="moke8/cloud-bj.png"><img src="moke8/cloud-bj.png"></td></tr></tbody></table></div>


<script>
  var speed=60
  demo2.innerHTML=demo1.innerHTML
  function Marquee(){
  if(demo2.offsetWidth-demo.scrollLeft<=0)
  demo.scrollLeft-=demo1.offsetWidth
  else{
  demo.scrollLeft++
  }
  }
  var MyMar=setInterval(Marquee,speed)
  demo.onmouseover=function() {clearInterval(MyMar)}
  demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
  </script>
  <!--云滚动-->
<script>
	//交互demo
	$(".m-ipt-txt").bind({
		click:function(){
			var _this = $(this),
			ipt_txt = _this.find(".ipt-txt"),
			ipt_tips = _this.find(".ipt-tips");
			$(".form-tips-error").html("");
			
			ipt_tips.hide();
			ipt_txt.focus();
			ipt_txt.bind({
				blur:function(w){
					if($(this).val() == ""){
						ipt_tips.show();
					}
					$(this).unbind("blur");
				}
			});
		}
	});

	//7天免验证
	 $("#overtimeDiv").click(function() {
		  if($(this).hasClass("m-ckbox-checked")){
		  		$(this).removeClass("m-ckbox-checked");
		  		$("#overtimeInput").val(0);
		  }else{
		  		$(this).addClass("m-ckbox-checked");
		  		$("#overtimeInput").val(1);
		  }
	  });

	function signUp(){
		var account = trim($("#account").val());
		var pwd = trim($("#pwd").val());
		if(account.length<10){
			$(".form-tips-error").html("请填写正确学号");
			return;
		}
		if((pwd.length<6||pwd.length>30)){
			$(".form-tips-error").html("密码长度请控制在6-30位字符以内");
			return;
		}
		$("#aform").submit();
	}

</script>

<div id="asyncbox_cover" unselectable="on" style="opacity:0.9;filter:alpha(opacity=90);background:#333"><!--[if IE 6]><div><iframe></iframe></div><div></div><![endif]--></div><div id="asyncbox_clone"></div><div id="asyncbox_focus"></div><div id="asyncbox_load"><div><span></span></div></div></body></html>
