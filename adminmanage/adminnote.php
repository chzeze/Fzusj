<?php
	session_start();
	if(!isset($_SESSION['username'])||!isset($_SESSION['password']))
	{
		echo "<script>window.location.href='login.php';</script>";
		exit();
	}
	$admin=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
<title>管理通知</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#submit").click(function(){
	var detail_var=$("#detail").val();

	detail_var=detail_var.replace(/&/ig,"%26");

	alert(detail_var);
	if(detail_var=='')
		alert('通知消息为空！');
	else
	{
		//alert(date_var+name_var);
		$.ajax({ //一个Ajax过程 
		type: "post",  //以post方式与后台沟通
		url : "addnotice.php", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		data: 'v0='+detail_var, //发给php的数据有两项，分别是上面传来的u和p     
		success: function(json)
		{//如果调用php成功
		   if(json.success==1)
		   {		
				window.location.href='adminnote.php';
				alert('添加成功');
		   }
		   else
		   {
				//document.getElementById("error").click();
				alert("mysql error:"+json.error);
		   		alert('添加失败!');
		   }
		}   
        });
	}
	
  });
  $("#clean").click(function(){
	var detail_var='';
	alert('首页通知将清空，显示图片');
	
	//alert(date_var+name_var);
	$.ajax({ //一个Ajax过程 
	type: "post",  //以post方式与后台沟通
	url : "addnotice.php", //与此php页面沟通
	dataType:'json',//从php返回的值以 JSON方式 解释
	data: 'v0='+detail_var, //发给php的数据有两项，分别是上面传来的u和p     
	success: function(json)
	{//如果调用php成功
	   if(json.success==1)
	   {		
			window.location.href='adminnote.php';
			alert('清空成功');
	   }
	   else
	   {
			//document.getElementById("error").click();
			alert("mysql error:"+json.error);
			alert('清空失败!');
	   }
	}   
	});	
  });
});
</script>
</head>
<body>
<?php 
include('conn.php');
$request=mysql_query("select * from pre_useradmin where username='$admin'",$con);//查找上一次登录时间
$row=mysql_fetch_array($request);
$loginnum=$row['loginnum'];
$loginnum-=2;
$loguid=$row['userid'];

$request=mysql_query("select * from per_logintime where user_id='$loguid' and loginid='$loginnum'",$con);
$row=mysql_fetch_array($request);
$time=$row['logintime_var'];
$lognum=$row['loginid'];
$lognum++;
?>

<div class="container-fluid">
  <center>
    <form class="form-inline">
      <fieldset>
      <legend><span style="color:#993300; font-size:14px; font-weight:bold">您好,管理员:</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$admin?></span> 
	  <span style="color:#993300; font-size:14px; font-weight:bold">上次登录时间为：</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$time?></span><p>
	  <span style="color:#993300; font-size:14px; font-weight:bold">历史登录次数：</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$lognum?>次</span>
	  &nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="unlogin.php" style="font-size:12px">退出登录</a></legend> 
      <p> 通知内容:
        <textarea id="detail" class="form-control" rows="13" placeholder="填写首页通知提醒，清空通知则默认显示图片"></textarea>
      </p>
      <button id=submit class="btn btn-success" type="button">添加通知</button>
	  <button id=clean class="btn btn-danger" type="button">清空通知</button>
      </fieldset>
    </form>
  </center>

</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
