<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>福大数计学院招聘日历</title>
<link rel="stylesheet" type="text/css" href="../css/template.css" />
<link rel="stylesheet" type="text/css" href="../css/ja.cssmenu.css" />
<link rel="stylesheet" href="../css/infostyle.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/jquery.fancybox-1.3.1.css" media="screen" />
<script type="text/javascript" src="../js/taij.js" charset="UTF-8"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="short icon" href="images/fzulogo1.png">
<script type="text/javascript" src="../js/float.js"></script>
</head>

<body id="bd" class="wide fs3" onLoad="myFloat();">
<!--<a href="#" > <img id="myImg" src='image/xuanchuan.jpg' style="position: absolute; left: 20px; top: 550px; border: solid 1px black;z-index:100;" /> </a>-->
<?php
include('../conn.php');
if(isset($_GET['infoid']))
{
	$info_id=$_GET['infoid'];
	if(is_numeric($info_id)==false)
	{
		$time=date("Y-m-d H:i:s");//获取当前登录时间精确到秒
		$iipp=$_SERVER["REMOTE_ADDR"].":".$_SERVER['REMOTE_PORT'];//获取ip和端口号
		//echo $iipp+$info_id+$time;
		$req=mysql_query("insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$info_id\",'$time')",$con);
		if(!$req)echo mysql_error();
		echo "<script>alert('非法参数!您的ip已被记录，稍后我们会与您联系');window.location.href='http://weibo.com/u/2764151121';</script>";
		exit();
	}
	else
	{
		$request=mysql_query("select * from brief where infoid=$info_id",$con);
		$row=mysql_fetch_array($request);
		$str=$row['detail'];
		$arr=explode("\n",$str);
		$str1=nl2br($str);//回车换成换行
	}
}
else
{
	echo "<script>alert('没有此条信息');window.location.href='other.php';</script>";
}
?>

<center>
		 <p><?=$str1?></p>
 </center> 
  <!--底部-->
  <div id="ja-footerwrap">
    <div class="clearfix" id="ja-footer"> <a href="http://cmcs.fzu.edu.cn/">学院网站</a> | <a href="http://120.25.60.106/fzusj/">福大数计学院招聘日历</a>| <a href="http://weibo.com/1729859463/">Designed & Developed  By 陈泽泽</a> <br />
      Copyright &copy; 2015-2016 Chzeze. All Rights Reserved. </div>
  </div>
  <!--end-->
</div>
<script src="../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/cmcsscript.js"></script>
<?php require_once '../cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
