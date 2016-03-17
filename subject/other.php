<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="gb2312">
<title>就业俱乐部</title>
</head>
<!-- 模版框架在里面-->
<link rel="stylesheet" type="text/css" href="css/template.css" />

<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/responsive-nav.js"></script>


<body>
<?php
include_once("../mysql.php");
include('../conn.php');
$conndb=new ConnDB();
$sql="select * from brief order by time desc limit 0, 5";
$arr=$conndb->queryarr($sql);
?>
<!--模块代码 -->
<p></p>
<p></p>
<div id="ja-botslwrap1">
<div class="clearfix" id="ja-botslwrap2">
<div class="ja-botsl">
<div style="width: 33.3%;" class="ja-box-left">
<div class="moduletable">
<h3><a href="">就业简报</a></h3><ul class="newsList">
 <?php
	for($j=0;$j<count($arr);$j++)
	{
	?>
	<li><a href=<?php
			   echo "detailinfo.php?infoid=".$arr[$j]['infoid']."#top";
			  ?> target="_blank"><?=$arr[$j]['head']?></a>&nbsp;&nbsp;&nbsp;&nbsp;[<?=$arr[$j]['time']?>]</li>
<?php
	}
	?>

</ul>
</div>
</div>
<div style="width: 33.3%;" class="ja-box-center">
<div class="moduletable">
<h3><a href="">简历基地</a></h3><ul class="newsList">
<li><a href="http://pan.baidu.com/s/1uQ6w2" target="_blank">蓝色音乐平台简历模板</a></li>
<li><a href="http://pan.baidu.com/s/1dDdPwXj" target="_blank">绿色线条创意简历模板</a></li>
<li><a href="http://pan.baidu.com/s/1jGvqgZW" target="_blank">啡白色_罗列式简历模板</a></li>
<li><a href="http://pan.baidu.com/s/1mgy9Q3m" target="_blank">水绿色清晰简历模板</a></li>
<li><a href="http://pan.baidu.com/s/1bnCz1SF" target="_blank">蓝色网页风格简历模板</a></li>
<li><a href="http://pan.baidu.com/s/1hq0dXZ2" target="_blank">蓝色创意一页式简历模板</a></li>
<li><a href="http://pan.baidu.com/s/1hqpoIX2" target="_blank">蓝色时间线简历模版</a></li>
<li><a href="http://pan.baidu.com/s/1bnjZhqJ" target="_blank">橙色灰色风格简历模板</a></li>
<li><a href=""></a></li>
</ul>
</div>
</div>
<div style="width: 33.3%;" class="ja-box-right">
<div class="moduletable">
<h3><a href=""></a></h3><ul class="newsList">
<div class="carousel slide" id="carousel-706659">
        <ol class="carousel-indicators">
          <li class="active" data-slide-to="0" data-target="#carousel-706659"> </li>
          <li data-slide-to="1" data-target="#carousel-706659"> </li>
          <li data-slide-to="2" data-target="#carousel-706659"> </li>
        </ol>
        <div class="carousel-inner">
        
         <div class="item"> <a href="http://pan.baidu.com/s/1mgy9Q3m" target="_blank"><img alt="" src="images/jl6.jpg" target="_blank"/></a>
                  <div class="carousel-caption">
                    <p>水绿色清晰一页式</p>
                  </div>
                </div>
                
          <div class="item"> <a href="http://pan.baidu.com/s/1uQ6w2" target="_blank"><img alt="" src="images/jl4.jpg" target="_blank" /></a>
                  <div class="carousel-caption">
                    <p>蓝色音乐平台</p>
                  </div>
                </div>
                
          <div class="item"> <a href="http://pan.baidu.com/s/1dDdPwXj" target="_blank"><img alt="" src="images/jl5.jpg" target="_blank" /></a>
                  <div class="carousel-caption">
                    <p>绿色线条创意</p>
                  </div>
                </div>
                
          <div class="item"> <a href="http://pan.baidu.com/s/1jGvqgZW" target="_blank"><img alt="" src="images/jl3.jpg" target="_blank"/></a>
                  <div class="carousel-caption">
                    <p>啡白色_罗列式</p>
                  </div>
                </div>
                
                    <div class="item"> <a href="http://pan.baidu.com/s/1bnCz1SF" target="_blank"><img alt="" src="images/jl7.jpg" target="_blank"/></a>
                  <div class="carousel-caption">
                    <p>蓝色网页风格</p>
                  </div>
                </div>
                
                          <div class="item"> <a href="http://pan.baidu.com/s/1hq0dXZ2" target="_blank"><img alt="" src="images/jl8.jpg" target="_blank"/></a>
                  <div class="carousel-caption">
                    <p>蓝色创意一页式</p>
                  </div>
                </div>
                
                          <div class="item active"> <a href="http://pan.baidu.com/s/1hqpoIX2" target="_blank"><img alt="" src="images/jl10.jpg" target="_blank"/></a>
                  <div class="carousel-caption">
                    <p>蓝色时间线</p>
                  </div>
                </div>
				<div class="item"> <a href="http://pan.baidu.com/s/1bnjZhqJ" target="_blank"><img alt="" src="images/jl11.jpg" target="_blank"/></a>
                  <div class="carousel-caption">
                    <p>橙色灰色风格</p>
                  </div>
                </div>

        </div>
        <a data-slide="prev" style="line-height: 40px;    font-size: 50px;" href="#carousel-706659" class="left carousel-control"><</a> <a data-slide="next" style="line-height: 40px;    font-size: 50px;" href="#carousel-706659" class="right carousel-control">></a> </div>
    </div>
</ul>
</div>
</div>
</div>
</div>
<div class="clearfix" id="ja-botslwrap3">
<div class="ja-botsl">
<div style="width: 33.3%;" class="ja-box-left">
<div class="moduletable">
<h3><a href="">资讯直通车</a></h3><ul class="newsList">
<li><a href="http://mp.weixin.qq.com/s?__biz=MjM5NDI0Nzk0MQ==&mid=225264196&idx=3&sn=254545ad8fd1cd1f29af69ec6b96fa99&scene=23&srcid=1013j1yxp0uBdPr9TjuzO97G#rd" target="_blank">求职,考研,考公,留学大事件</a></li>
<li><a href="http://mp.weixin.qq.com/s?__biz=MjM5NDI0Nzk0MQ==&mid=225264196&idx=2&sn=ffe2b2bc7a02462eed3521ed35ae046b&scene=23&srcid=1013EdZi9nbqaKTSvWWmgyM2#rd" target="_blank">2016各大银行校招报名截止时间</a></li>
<li><a href="http://mp.weixin.qq.com/s?__biz=MjM5NDI0Nzk0MQ==&mid=225265329&idx=3&sn=6ac2bd335185e632fe3737667c49d232&scene=23&srcid=1014cmC2Y5S4sYvVPfhg4HZr#rd" target="_blank">10.11-10.18福州大学企业专场招聘会解析</a></li>
<li><a href="http://mp.weixin.qq.com/s?__biz=MjM5NDI0Nzk0MQ==&mid=225265329&idx=4&sn=6789617b8a708ee533570ff0b6eba9aa&scene=23&srcid=10145YWX6lFdGE7ocslKqOdF#rd" target="_blank">2016年度考试录用公务员公告</a></li>
<li><a href="http://mp.weixin.qq.com/s?__biz=MjM5NDI0Nzk0MQ==&mid=225265329&idx=2&sn=6ad9a502a349088393263d5263f9a43a&scene=23&srcid=1014BRJJPz522OCybirSFEYB#rd" target="_blank">高校教师资格认定网上报名</a></li>
<li><a href="" target="_blank"></a></li>
<li><a href="" target="_blank"></a></li>
<li><a href="" target="_blank"></a></li>
</ul>
</div>
</div>
<div style="width: 33.3%;" class="ja-box-center">
<div class="moduletable">
<h3><a href="">求职导向标</a></h3><ul class="newsList">
<li><a href="http://www.fjrclh.com/newsshownew.asp?articleid=28551" target="_blank">职业生涯成功路</a></li>
<li><a href="http://www.fjrclh.com/newsshownew.asp?articleid=27683" target="_blank">初涉职场：慎防十大“地雷区”</a></li>
<li><a href="http://www.fjrclh.com/newsshownew.asp?articleid=26565" target="_blank">简历制作容易出错的4个小细节</a></li>
<li><a href="http://www.fjrclh.com/newsshownew.asp?articleid=27307" target="_blank">面试时6种小动作绝不能做</a></li>
<li><a href="http://www.fjrclh.com/newsshownew.asp?articleid=27711" target="_blank">个人简历的九大注意事项</a></li>
<li><a href="http://mp.weixin.qq.com/s?__biz=MjM5NDI0Nzk0MQ==&mid=225618648&idx=2&sn=22410920beeab7f25425ee9fe61ae276&scene=23&srcid=1017S8uNjuUA38VyRWoiWWiG#rd" target="_blank">什么时候投递简历最好</a></li>
<li><a href="http://mp.weixin.qq.com/s?__biz=MjM5NDI0Nzk0MQ==&mid=224922030&idx=2&sn=d7c10225253ed59cf79616d6ec0c37d3&scene=23&srcid=1017CWi5s8r5nhd6lZWcXZaG#rd" target="_blank">面试穿着技巧(图解)</a></li>
<li><a href="http://mp.weixin.qq.com/s?__biz=MjM5NDI0Nzk0MQ==&mid=224620104&idx=1&sn=70649ea6152ba56ff621222125755032&scene=23&srcid=1017KnhAVWmB5aUqz9S37fi8#rd" target="_blank">如何准备面试</a></li>
<li><a href="http://mp.weixin.qq.com/s?__biz=MjM5NDI0Nzk0MQ==&mid=224289336&idx=3&sn=101420711a7894a392561eff95bf868c&scene=23&srcid=1017Y2UnUpJXJlYX4NJNWFov#rd" target="_blank">如何拿到银行offer？(网申篇)</a></li>

</ul>
</div>
</div>
<div style="width: 33.3%;" class="ja-box-right">
<div class="moduletable">
<h3><a href=""></a></h3><ul class="newsList">

</ul>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
