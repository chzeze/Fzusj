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
<title>后台管理</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.min.js" charset="gb2312"></script>
<script>
$(document).ready(function(){
  $("#submit").click(function(){
    var date_var=$("#date").val();
	var name_var=$("#name").val();
	var site_var=$("#site").val();
	var url_var=$("#url").val();
	var detail_var=$("#detail").val();
	var time_var=$("#time").val();
	if(date_var==''||name_var==''||time_var=='')
		alert('请补全信息！');
	else
	{
		//alert(date_var+name_var);

		name_var=name_var.replace(/&/ig,"%26");
		site_var=site_var.replace(/&/ig,"%26");
		detail_var=detail_var.replace(/&/ig,"%26");

		alert(name_var+"\n"+date_var+"\n"+time_var+"\n"+detail_var);
		$.ajax({ //一个Ajax过程 
		type: "post",  //以post方式与后台沟通
		url : "addinfo.php", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		data: 'v0='+date_var+'&v1='+name_var+'&v2='+time_var+'&v3='+site_var+'&v4='+url_var+'&v5='+detail_var,   
		success: function(json)
		{//如果调用php成功
		   if(json.success==1)
		   {		
				window.location.href='admintable.php';
				alert('添加成功');
		   }
		   else
		   {
				alert("mysql error:"+json.error);
		   		alert('添加失败');
		   }
		}   
        });
	}
	
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
	  <a href="unlogin.php" style="font-size:12px">退出登录</a>
	  <p>添加招聘信息</legend>
      <p> 招聘日期：
        <input id=date type="date" value=""/>
        <span style="color:#FF0000">*</span> </p>
      <p> 企业名称：
        <input id=name type="text" placeholder="name..."/>
        <span style="color:#FF0000">*</span> </p>
      <p> 具体时间：
        <input id=time type="time" placeholder="00-00"/>
        <span style="color:#FF0000">*</span> </p>
      <p> 招聘地点：
        <input id=site type="text" placeholder="place..."/>
        <span style="color:#FF0000">*</span> </p>
      <p> 相关链接：
        <input id=url type="text" placeholder="http://...(选填)"/>
        <span>&nbsp;</span> </p>
      <p> 详细信息:
        <textarea id="detail" class="form-control" rows="13" placeholder="用于跳转详情面信息..."></textarea>
      </p>
      <button id=submit class="btn btn-success" type="button">添加</button><br/>
<a href="adminaddinfo.php"><font style="color:blue" size="3"><br/>进入富文本编辑模式</font></a><br/>
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
