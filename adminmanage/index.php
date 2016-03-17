<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>招聘日历后台管理</title>
<link rel="stylesheet" type="text/css" href="../css/template.css" />
<link rel="stylesheet" type="text/css" href="../css/ja.cssmenu.css" />
<link rel="stylesheet" type="text/css" href="../css/jquery.fancybox-1.3.1.css" media="screen" />
<script type="text/javascript" src="../js/taij.js" charset="UTF-8"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="short icon" href="../images/fzulogo1.png">
</head>

<body id="bd" class="wide fs3">

<div id="ja-wrapper">
 <!--头部图片-->
  <div id="ja-headerwrap">  
   <div class="clearfix" id="ja-header">	
	  	<a href="./index.php">
	  	<img src="image/logo.png" alt="数学与计算机科学学院" style="margin-top:10px;float:left; padding-left:150px" />
	  	</a>
	</div>
  </div>
  <!--end-->
  <!--头部导航-->
  <div id="ja-mainnavwrap">
    <div class="clearfix" id="ja-mainnav">
      <div id="ja-mainnav-right">
        
        <ul id="ja-cssmenu" class="clearfix">
          <!--隐藏显示顺序超过500的频道菜单-->
          <li><a href="../index.php"><span>网站首页</span></a></li>
		  <li class="havechild"> <a href="./index.php"><span>后台管理</span></a>
          </li>
		</ul>
      </div>
    </div>
  </div>
   <!--end-->
  
  
  <!--template float_div-->
  <div id="ja-containerwrap">
   <center>
		<iframe frameborder="0" height="1400px" width="950px" src="frameindex.php" name="adminframe"></iframe>
  </center>

  </div>
  
  
  <!--底部-->
  <div id="ja-footerwrap">
  	
    <div class="clearfix" id="ja-footer">
	
      
	  <a href="http://cmcs.fzu.edu.cn/">学院网站</a> | 
	  <a href="http://www.fjrclh.com/">福州大学就业指导中心</a>|
	  <a href="http://weibo.com/1729859463/">Designed & Developed  By Zeze</a> <br />
	  Copyright &copy; 2015-2016 Chzeze. All Rights Reserved.

	  
    </div>
	
  </div>
  <!--end-->
  
 
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/cmcsscript.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
