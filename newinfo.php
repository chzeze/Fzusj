<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��������ѧԺ��Ƹ����</title>
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
		$time=date("Y-m-d H:i:s");//��ȡ��ǰ��¼ʱ�侫ȷ����
		$iipp=$_SERVER["REMOTE_ADDR"].":".$_SERVER['REMOTE_PORT'];//��ȡip�Ͷ˿ں�
		//echo $iipp+$info_id+$time;
		$req=mysql_query("insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$info_id\",'$time')",$con);
		if(!$req)echo mysql_error();
		echo "<script>alert('�Ƿ�����!����ip�ѱ���¼���Ժ����ǻ�������ϵ');window.location.href='http://weibo.com/u/2764151121';</script>";
		exit();
	}
	else
	{
		$request=mysql_query("select * from employinfo where id=$info_id",$con);
		$row=mysql_fetch_array($request);
		$str=$row['detail'];
		$arr=explode("\n",$str);
		$str1=nl2br($str);//�س����ɻ���
	}
}
else
{
	echo "<script>alert('û�д�����Ϣ');window.location.href='index.php';</script>";
}
?>

<div id="ja-wrapper">
  <!--ͷ��ͼƬ-->
  <div id="ja-headerwrap">
    <div class="clearfix" id="ja-header"> <a href="./index.php"> 
	<img src="images/logo.png" alt="��ѧ��������ѧѧԺ" style="margin-top:10px;float:left; padding-left:180px" /> </a> </div>
  </div>
  <!--end-->
  <!--ͷ������-->
  <div id="ja-mainnavwrap">
    <div class="clearfix" id="ja-mainnav">
      <div id="ja-mainnav-right">
        <ul id="ja-cssmenu" class="clearfix">
          <!--������ʾ˳�򳬹�500��Ƶ���˵�-->
          <li><a href="index.php"><span>&nbsp;&nbsp;</span></a></li>
          <li class="havechild"> <a href="index.php"><span>��Ƹ����</span></a> </li>
          <li class="havechild"> <a href="table.php" target="myframe"><span>��Ƹ�ճ�</span></a> </li>
          <li class="havechild"> <a href="subject/other.php" target="myframe"><span>��ҵר��</span></a> </li>
	  <li class="havechild"> <a href="http://cmcs.fzu.edu.cn" ><span>ѧԺ��ҳ</span></a> </li>
          <!--<li class="havechild"> <a href="about.php" target="myframe"><span>��������</span></a> </li>-->
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
     ����ʱ�䣺<?=$row['addtime']?>
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
      <legend>�������</legend>
    </div>
    <font style="color:#33F" size="+1"><strong><a href=<?=$row['url']?> ><u><?=$row['url']?></u></a></strong></font> </div>
  </fieldset>
</div>
  </div>
  <!--�ײ�-->
  <div id="ja-footerwrap">
    <div class="clearfix" id="ja-footer"> <a href="http://cmcs.fzu.edu.cn/">ѧԺ��վ</a> | <a href="http://www.fjrclh.com/">���ݴ�ѧ��ҵָ������</a>| <a href="http://weibo.com/1729859463/">Designed & Developed  By Zeze</a> <br />
      Copyright &copy; 2015-2016 Chzeze. All Rights Reserved. </div>
  </div>
  <!--end-->
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/cmcsscript.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
