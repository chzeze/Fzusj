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
<title>简报后台管理</title>
<!-- 以下为textarea的代码 -->
<style>
	form {
		margin: 0;
	}
	textarea {
		display: block;
	}
</style>
<link rel="stylesheet" href="../textarea/themes/default/default.css" />
<script charset="utf-8" src="../textarea/kindeditor-min.js"></script>
<script charset="utf-8" src="../textarea/lang/zh_CN.js"></script>
<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					allowFileManager : true
				});
			});
		</script>
<!-- 以上为textarea的代码 -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.min.js" charset="gb2312"></script>
<script>
$(document).ready(function(){
  $("#submit").click(function(){

    var date_var=$("#date").val();
	//alert(date_var);
	var name_var=$("#name").val();
	//alert(name_var);
	//var site_var=$("#site").val();
	//var url_var=$("#url").val();
	var detail_var=editor.html();//$("#detail").val();
	//alert(detail_var);
	//var time_var=$("#time").val();
	if(date_var==''||name_var=='')
		alert('请补全信息！');
	else
	{

		name_var=name_var.replace(/&/ig,"%26");
		//alert(name_var);
		detail_var=detail_var.replace(/&/ig,"%26");
		//alert(detail_var);
		//代码压缩
		var sourceLength = detail_var.length;
		var rep = /\n+/g;
		var repone = /<!--.*?-->/ig;
		var reptwo = /\/\*.*?\*\//ig;
		var reptree = /[ ]+</ig;
		var sourceZero = detail_var.replace(rep,"");
		var sourceOne = sourceZero.replace(repone,"");
		var sourceTwo = sourceOne.replace(reptwo,"");
		detail_var = sourceTwo.replace(reptree,"<");
		//------------
		//alert(name_var+"\n"+date_var+"\n"+detail_var);
		$.ajax({ //一个Ajax过程 
		type: "post",  //以post方式与后台沟通
		url : "addbrief.php", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		data: 'v0='+date_var+'&v1='+name_var+'&v2='+detail_var,   
		success: function(json)
		{//如果调用php成功
		   if(json.success==1)
		   {		
				window.location.href='adminbrief.php';
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
      <legend>
      <span style="color:#993300; font-size:14px; font-weight:bold">您好,管理员:</span> <span style="color:#FF0000; font-size:14px; font-weight:bold">
      <?=$admin?>
      </span> <span style="color:#993300; font-size:14px; font-weight:bold">上次登录时间为：</span> <span style="color:#FF0000; font-size:14px; font-weight:bold">
      <?=$time?>
      </span>
      <p> <span style="color:#993300; font-size:14px; font-weight:bold">历史登录次数：</span> <span style="color:#FF0000; font-size:14px; font-weight:bold">
        <?=$lognum?>
        次</span> &nbsp;&nbsp;&nbsp;&nbsp; <a href="unlogin.php" style="font-size:12px">退出登录</a>
      <p>添加简报信息
        </legend>
      <p> 简报日期：
        <input id=date type="date" value=""/>
        <span style="color:#FF0000">*</span> </p>
      <p> 简报标题：
        <input id=name type="text" placeholder="name..."/>
        <span style="color:#FF0000">*</span> </p>
      <p>
        <textarea id="detail" name="content" style="width:800px;height:400px;visibility:hidden;" placeholder="用于跳转详情面信息..."></textarea>
      </p>
      <button id=submit class="btn btn-success" type="button">添加</button>
      <br/>
      </fieldset>
    </form>
    <?php 
	include('conn.php');
	include('mysql.php');
	if(@$_GET['date']&&$_GET['del'])//删除
	{
		$y=$_GET['date'];
		$m=$_GET['del'];
		if(!is_numeric($y)||!is_numeric($m)||$m!=5026)//非法字符判断
		{
			$time=date("Y-m-d H:i:s");//获取当前登录时间精确到秒
			$iipp=$_SERVER["REMOTE_ADDR"];//获取ip
			//$req=mysql_query("insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$m\",'$time')",$con);
			$conndb=new ConnDB();
			$info=$y.$m;
			$sql="insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$info\",'$time')";
			$arr=$conndb->query($sql);
			//if(!$req) echo "error:".mysql_error();
			echo "<script>alert('非法参数!您的ip已被记录，稍后我们会与您联系');window.location.href='http://weibo.com/u/2764151121';</script>";
		}
		else
		{
			$delsql="delete from brief where infoid='".$_GET['date']."'";
			mysql_query($delsql);
			echo "<script>alert('删除成功')</script>";
			echo "<script>window.location.href='adminbrief.php'</script>";
		}
	}	
	?>
    <?php
include_once("mysql.php");
$conndb=new ConnDB();

$sql="select count(*) from brief";
$arr=$conndb->queryarr($sql);
$total=$arr[0][0];

$pagesize = 20;
$PageCount = ceil($total/ $pagesize);
if(isset($_GET["page"]))
{
	$Page = intval($_GET["page"]);
	if($Page<1) $Page=1;
}
else
{
	$Page=1;
}
$info_id=empty($_GET['page']) ? 0 : $_GET['page'] ;
if(is_numeric($info_id)==false)//防止SQL注入
{
	$time=date("Y-m-d H:i:s");//获取当前登录时间精确到秒
	$iipp=$_SERVER["REMOTE_ADDR"];//获取ip
	$req=mysql_query("insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$info_id\",'$time')",$con);
	if(!$req)echo mysql_error();
	echo "<script>alert('非法参数!您的ip已被记录，稍后我们会与您联系');window.location.href='http://weibo.com/u/2764151121';</script>";
}
else
{
	$currentRow = empty($_GET['page']) ? 0 : ($_GET['page']-1)* $pagesize;
	$sql="select * from brief order by time desc limit $currentRow, $pagesize";
	$arr=$conndb->queryarr($sql);
}
?>
    <table class="table table-bordered table-hover table-condensed">
      <thead>
        <tr>
          <th> 日期 </th>
          <th> 单位 </th>
          <th> 删除 </th>
        </tr>
      </thead>
      <tbody>
        <?php
	for($j=0;$j<count($arr);$j++)
			{
	?>
        <tr class="error">
          <td><?=$arr[$j]['time']?>
          </td>
          <td><a href=<?php
			   echo "../subject/detailinfo.php?infoid=".$arr[$j]['infoid']."#top";
			  ?>  style="color:#0000FF" data-toggle="tooltip" title="打开链接">
            <?=$arr[$j]['head']?>
            </a> </td>
          <td data-toggle="tooltip" title="点击删除"><a href=?date=<?php echo $arr[$j]['infoid']?>&&del=5026 style="color:#FF0000">删除</a></td>
        </tr>
        <?php
}
?>
      </tbody>
    </table>
    <div>共[<B>
      <?=$total?>
      </B>]条记录 
      共[
      <?=$PageCount?>
      ]页 当前是[
      <?=(($Page-1)*$pagesize+1)?>
      -<?php echo $Page*$pagesize>$total?$total:$Page*$pagesize;?>]条
      <?php
			if($Page>1) 
				echo "[<a href='admintable.php?page=".($Page-1)."'><span style='color:blue'>前一页</span></a>]";
			else 
				echo "[<span style='color:grey'>前一页</span>]";
			?>
      <?php
			if($Page<$PageCount) 
				echo "[<a href='admintable.php?page=".($Page+1)."'><span style='color:blue'>后一页</span></a>]";
			else 
				echo "[<span style='color:grey'>后一页</span>]";
			?>
      <SELECT id="page" onChange="location.href='admintable.php?page='+document.getElementById('page').value;">
        <?php
			for($i=1;$i<=$PageCount;$i++)
			{
				if($Page==$i) echo "<option selected='selected' value='".$i."'>第".$i."页</option>";
				else echo "<option value='".$i."'>第".$i."页</option>";;
			}
			?>
      </SELECT>
    </div>
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
