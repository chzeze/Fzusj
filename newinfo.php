<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>福大数计学院招聘日历</title>
<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/ja.cssmenu.css" />
<link rel="stylesheet" href="css/infostyle.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-1.3.1.css" media="screen" />
<script type="text/javascript" src="js/taij.js" charset="UTF-8"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="short icon" href="images/fzulogo1.png">
<script type="text/javascript" src="js/float.js"></script>
</head>

<body id="bd" class="wide fs3" onLoad="myFloat();">
<!--<a href="#" > <img id="myImg" src='image/xuanchuan.jpg' style="position: absolute; left: 20px; top: 550px; border: solid 1px black;z-index:100;" /> </a>-->
<?php
include('conn.php');
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
		$request=mysql_query("select * from employinfo where id=$info_id",$con);
		$row=mysql_fetch_array($request);
		$str=$row['detail'];
		$arr=explode("\n",$str);
		$str1=nl2br($str);//回车换成换行
	}
}
else
{
	echo "<script>alert('没有此条信息');window.location.href='index.php';</script>";
}
?>

<div id="ja-wrapper">
  <!--头部图片-->
  <div id="ja-headerwrap">
    <div class="clearfix" id="ja-header"> <a href="./index.php"> 
	<img src="images/logo.png" alt="数学与计算机科学学院" style="margin-top:10px;float:left; padding-left:180px" /> </a> </div>
  </div>
  <!--end-->
  <!--头部导航-->
  <div id="ja-mainnavwrap">
    <div class="clearfix" id="ja-mainnav">
      <div id="ja-mainnav-right">
        <ul id="ja-cssmenu" class="clearfix">
          <!--隐藏显示顺序超过500的频道菜单-->
          <li><a href="index.php"><span>&nbsp;&nbsp;</span></a></li>
          <li class="havechild"> <a href="index.php"><span>招聘日历</span></a> </li>
          <li class="havechild"> <a href="table.php" target="myframe"><span>招聘日程</span></a> </li>
          <li class="havechild"> <a href="subject/other.php" target="myframe"><span>就业专区</span></a> </li>
	  <li class="havechild"> <a href="http://cmcs.fzu.edu.cn" ><span>学院首页</span></a> </li>
          <!--<li class="havechild"> <a href="about.php" target="myframe"><span>关于我们</span></a> </li>-->
        </ul>
      </div>
    </div>
  </div>
  <!--end-->
  <!--template float_div-->
  <div id="ja-containerwrap">
    <div id="formwrapper">
  <center>
    <h1> <font style="color:#090"><strong><?=$row['name']?></strong></font> </h1>
     发布时间：<?=$row['addtime']?>
  </center>
  <fieldset>
  <div class="mainContext">
    <div class="leftContext">
      <legend>Time</legend>
    </div>
    <font style="color:#F00" size="+1"><strong><?=$row['date']?> &nbsp;<?php if($row['time']!="00:00") echo $row['time']?></strong></font> </div>
  </fieldset>
  <fieldset>
  <div class="mainContext">
    <div class="leftContext">
      <legend>More</legend>
    </div>
    <font style="color:#F0F" size="+1"><strong><?=$row['site']?></strong></font> </div>
  </fieldset>
  <fieldset>
  <div>
    <legend>Detail</legend>
  </div>
  <p><?=$str1?></p>
  </fieldset>
  <fieldset>
  <div class="mainContext">
    <div class="leftContext">
      <legend>相关链接</legend>
    </div>
    <font style="color:#33F" size="+1"><strong><a href=<?=$row['url']?> ><u><?=$row['url']?></u></a></strong></font> </div>
  </fieldset>
</div>
  </div>
  <!--底部-->
  <div id="ja-footerwrap">
    <div class="clearfix" id="ja-footer"> <a href="http://cmcs.fzu.edu.cn/">学院网站</a> | <a href="http://www.fjrclh.com/">福州大学就业指导中心</a>| <a href="http://weibo.com/1729859463/">Designed & Developed  By Zeze</a> <br />
      Copyright &copy; 2015-2016 Chzeze. All Rights Reserved. </div>
  </div>
  <!--end-->
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/cmcsscript.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
