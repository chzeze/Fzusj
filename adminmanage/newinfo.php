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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>详情页</title>
<link rel="stylesheet" href="../css/infostyle.css" type="text/css" />
</head>
<body>
<?php
include('conn.php');
if(isset($_GET['infoid']))
{
	$info_id=$_GET['infoid'];
	if(is_numeric($info_id)==false)
	{
		$time=date("Y-m-d H:i:s");//获取当前登录时间精确到秒
		$iipp=$_SERVER["REMOTE_ADDR"];//获取ip
		$req=mysql_query("insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$info_id\",'$time')",$con);
		if(!$req)echo mysql_error();
		echo "<script>alert('非法参数!您的ip已被记录，稍后我们会与您联系');window.location.href='http://weibo.com/u/2764151121';</script>";
	}
	else
	{
		$request=mysql_query("select * from employinfo where id=$info_id",$con);
		$row=mysql_fetch_array($request);
		$str=$row['detail'];
		$arr=explode("\n",$str);
		$str1=nl2br($str);//回车换成换行
	}
}
else
{
	echo "<script>alsert('没有此条信息');window.location.href='index.php';</script>";
}
?>
<div id="formwrapper">
  <center>
    <h1> <font style="color:#090"><strong>
      <?=$row['name']?>
      </strong></font> </h1>
  </center>
  <fieldset>
  <div class="mainContext">
    <div class="leftContext">
      <legend>时间</legend>
    </div>
    <font style="color:#F00" size="+1"><strong>
    <?=$row['date']?>
    &nbsp;
    <?=$row['time']?>
    </strong></font> </div>
  </fieldset>
  <fieldset>
  <div class="mainContext">
    <div class="leftContext">
      <legend>地点</legend>
    </div>
    <font style="color:#F0F" size="+1"><strong>
    <?=$row['site']?>
    </strong></font> </div>
  </fieldset>
  <fieldset>
  <div>
    <legend>详细信息</legend>
  </div>
  <span style="color:#FF0000">管理员最后更新时间：</span>
  <?=$row['addtime']?>
  <p>
    <?=$str1?>
  </p>
  </fieldset>
  <fieldset>
  <div class="mainContext">
    <div class="leftContext">
      <legend>相关链接</legend>
    </div>
    <font style="color:#33F" size="+1"><strong><a href=<?=$row['url']?> ><u>
    <?=$row['url']?>
    </u></a></strong></font> </div>
  </fieldset>
</div>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
