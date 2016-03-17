<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>登后台管理员录验证</title>
<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
 <script type="text/javascript">
 	function create_code(){
    document.getElementById('code').src = 'yanz/verification.php?n='+Math.random()*10000;
}
</script>
</head>
<body>
<?php
	/*$iipp=$_SERVER["REMOTE_ADDR"];//获取ip
	if($iipp=="218.106.145.10")
	{	
		echo "<script>while(1){alert('呵呵')};window.location.href='http://weibo.com/u/2764151121';</script>";
	}*/
?>
<div class="container-fluid">
  <div class="row-fluid">
  <div class="span12">
      <h3 class="text-center muted"> 管理员登录 </h3>
    </div>
    <div class="span4"> </div>
	<center>
    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="inputEmail"></label>
        <div class="controls">
          <input id="inputname" type="text" placeholder="请输入用户名"/>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword"></label>
        <div class="controls">
          <input id="inputpassword" type="password"  placeholder="请输入密码"/>
        </div>
      </div>
	  <div class="control-group">
        <label class="control-label" for="inputPassword"></label>
        <div class="controls">
          <input type="text" maxlength="4" id="srand" name="yzm_code" placeholder="请输入验证码"><br>

		<img  id="code" name="code" src="yanz/verification.php"  onclick="create_code()" title="点击图片刷新验证码" onclick="change_rand();">
		<a onclick="create_code();">看不清？换图片</a><br />
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <button id="submitlogin" type="submit" class="btn">登录</button>
        </div>
      </div>
    </div>
	</center>
    <div class="span4"> </div>
  </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../js/jquery.min.js"></script>
<script>
$(document).ready(function(){
  //alert("initial");
  $("#submitlogin").click(function(){
  	//alert("click");
    var username=$("#inputname").val();
	var userpwd=$("#inputpassword").val();
	var yanz=$("#srand").val();
	if(username.indexOf(" ") > 0||username.indexOf("'")>0||username.indexOf("-") > 0||userpwd.indexOf(" ") > 0||userpwd.indexOf("'")>0||userpwd.indexOf("-") > 0||username.length>20||userpwd.length>20)
	{
    	alert('输入格式异常,请重新输入');
	}
	else if(yanz=='')
	{
		alert('请输入验证码');
	}
	else
	{
		$.ajax({ //一个Ajax过程 
		type: "post",  //以post方式与后台沟通
		url : "checklogin.php", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		data: 'username='+username+'&password='+userpwd+'&yzm_code='+yanz, //发给php的数据有两项，分别是上面传来的u和p   
		success: function(json)
		{//如果调用php成功
		   //alert(json.username+'\n'+json.password); //把php中的返回值（json.username）给 alert出来
		  // alert(json.success);
		   if(json.success==1)
		   {		
				window.location.href='admintable.php';
		   }
		   else	 if(json.success==2)
		   {
				//document.getElementById("error").click();
		   		alert('验证码错误！');
				window.location.href='login.php';
		   }
		   else	 
		   {
				//document.getElementById("error").click();
		   		alert('用户名或密码错误!'+json.error);
				window.location.href='login.php';
		   }
		}   
        });
	}
	
  });
});
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256517219).'" width="0" height="0"/>';?>
</body>
</html>
