<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��������ѧԺ��Ƹ����</title>
<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/ja.cssmenu.css" />
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
$request=mysql_query("select * from noticvar order by notid desc",$con);
$row=mysql_fetch_array($request);//��ȡ����֪ͨ
$notic=$row['notic'];//iconv("gb2312","UTF-8",$row['notic']);
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
         <!-- <li class="havechild"> <a href="about.php" target="myframe"><span>��������</span></a> </li>-->
        </ul>
      </div>
    </div>
  </div>
  <!--end-->
  <!--template float_div-->
  <div id="ja-containerwrap">
    <center>
	<!--
      <div class="float_div float_div_right">
        <div class="float_div_con"><span style="font-size:16px; color:#FF0000; font-weight:bold">
          <?php
				if($notic=='')
					echo "<img src=\"image/notice.jpg\" style=\"width:100px; height:300px;\">";
				else
					echo $notic;
			
			?>
          </span></div>
        <a href="#" class="float_div_close">���ر�</a> </div>
	-->
      <iframe src="rili.php" name="myframe" id="iframepage" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" onLoad="iFrameHeight()"></iframe>
    </center>
  </div>
  <!--�ײ�-->
  <div id="ja-footerwrap">
    <div class="clearfix" id="ja-footer"> <a href="http://cmcs.fzu.edu.cn/">ѧԺ��վ</a> | <a href="http://www.fjrclh.com/">���ݴ�ѧ��ҵָ������</a>| <a href="http://weibo.com/1729859463/">Designed & Developed  By Zeze</a> <br />
      Copyright &copy; 2015-2016 Chzeze. All Rights Reserved. </div>
  </div>
  <!--end-->
</div>

<script type="text/javascript" language="javascript">   
function iFrameHeight() {   
var ifm= document.getElementById("iframepage");   
var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;   
if(ifm != null && subWeb != null) {
   ifm.height = subWeb.body.scrollHeight;
   ifm.width = subWeb.body.scrollWidth;
}   
}   
</script>
<script src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/cmcsscript.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
