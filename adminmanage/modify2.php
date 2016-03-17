<?php
	session_start();
	if(!isset($_SESSION['username'])||!isset($_SESSION['password']))
	{
		echo "<script>window.location.href='login.php';</script>";
	}
	$admin=$_SESSION['username'];
	if(!isset($_GET['inid']))
	{
		echo "<script>window.location.href='admintable.php';</script>";
	}
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
<script type="text/javascript" src="../js/jquery.min.js" charset="UTF-8"></script>
<script>
$(document).ready(function(){
   //alert("yes");
  //$("#error").hide();
  $("#submit").click(function(){
    var date_var=$("#date").val();
	var name_var=$("#name").val();
	var site_var=$("#site").val();
	var url_var=$("#url").val();
	var detail_var=$("#detail").val();
	var time_var=$("#time").val();
	var id_var=$("#id").val();
	if(date_var==''||name_var=='')
		alert('请补全信息！');
	else
	{
		name_var=name_var.replace(/&/ig,"%26");
		site_var=site_var.replace(/&/ig,"%26");
		detail_var=detail_var.replace(/&/ig,"%26");
		alert(name_var+" \n"+date_var+"\n"+time_var+"\n"+detail_var);
		$.ajax({ //一个Ajax过程 
		type: "post",  //以post方式与后台沟通
		url : "updateinfo.php", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		data: 'm0='+date_var+'&m1='+name_var+'&m2='+time_var+'&m3='+site_var+'&m4='+url_var+'&m5='+detail_var+'&m6='+id_var, //发给php的数据有两项，分别是上面传来的u和p     
		success: function(json)
		{//如果调用php成功
		   if(json.success==1)
		   {		
				window.location.href='admintable.php';
				alert('修改成功');
		   }
		   else
		   {
				alert('修改失败!'+"mysql error:"+json.error);
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
include('conn.php');//净值


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

$infoid=$_GET['inid'];
$request=mysql_query("select * from employinfo where id='$infoid'",$con);
$row=mysql_fetch_array($request);
$var_date=$row['date'];//iconv("gb2312","UTF-8",$row['date']);
$var_name=$row['name'];//iconv("gb2312","UTF-8",$row['name']);
$var_site=$row['site'];//iconv("gb2312","UTF-8",$row['site']);
$var_url=$row['url'];//iconv("gb2312","UTF-8",$row['url']);
$var_time=$row['time'];//iconv("gb2312","UTF-8",$row['time']);//$row['time'];
$var_detail=$row['detail'];//iconv("gb2312","UTF-8",$row['detail']);
//echo $var_date.$var_name.$var_site.$var_url.$var_time.$var_detail;
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
	  <a href="unlogin.php" style="font-size:12px">退出登录</a></legend> <p>
	  修改信息：
      <p> 招聘日期：
        <input id=date type="date" value=<?=$var_date?> />
        <span style="color:#FF0000">*</span> </p>
      <p> 企业名称：
        <input id=name type="text" placeholder="name..." value=<?=$var_name?> />
        <span style="color:#FF0000">*</span> </p>
      <p> 具体时间：
        <input id=time type="time" placeholder="00-00" value=<?=$var_time?> />
        <span style="color:#FF0000">*</span> </p>
      <p> 招聘地点：
        <input id=site type="text" placeholder="place..." value=<?=$var_site?> />
        <span style="color:#FF0000">*</span> </p>
      <p> 相关链接：
        <input id=url type="text" placeholder="http://...(选填)" value=<?=$var_url?> >
        <span>&nbsp;</span> </p>
      <p> 详细信息:
        <textarea id="detail" class="form-control" rows="13" placeholder="用于跳转详情面信息..."><?=$var_detail?></textarea>
      </p>
	  <input id=id type="hidden" value="<?=$infoid?>">
      <button id=submit class="btn btn-success" type="button">修改</button><br/>
<a href=modify.php?inid=<?php echo $_GET['inid']?>><font style="color:blue" size="3"><br/>进入富文本编辑模式</font></a>

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
