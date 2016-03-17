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
<script type="text/javascript" src="../js/jquery.min.js" charset="UTF-8"></script>
<script src="js/adminjs.js"></script>
</head>
<body>
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
		$delsql="delete from employinfo where id='".$_GET['date']."'";
		mysql_query($delsql);
		echo "<script>alert('删除成功')</script>";
		echo "<script>window.location.href='admintable.php'</script>";
	}
}

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
      <legend><span style="color:#993300; font-size:14px; font-weight:bold">您好,管理员:</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$admin?></span> 
	  <span style="color:#993300; font-size:14px; font-weight:bold">上次登录时间为：</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$time?></span><p>
	  <span style="color:#993300; font-size:14px; font-weight:bold">历史登录次数：</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$lognum?>次</span>
	  &nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="unlogin.php" style="font-size:12px">退出登录</a></legend>   
  </center>
  <?php
include_once("mysql.php");
$conndb=new ConnDB();

$sql="select count(*) from employinfo";
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
	$sql="select * from employinfo order by date desc limit $currentRow, $pagesize";
	$arr=$conndb->queryarr($sql);
}
?>
  <h3 class="muted text-center"> 招聘信息表格 </h3>
  <table class="table table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th> 日期 </th>
        <th> 单位 </th>
        <th> 地点 </th>
        <th> 时间 </th>
		<th> 修改 </th>
        <th> 删除 </th>
      </tr>
    </thead>
    <tbody>
      <?php
	for($j=0;$j<count($arr);$j++)
			{
	?>
      <tr class="error">
        <td><?=$arr[$j]['date']?>
        </td>
        <td><a href=<?php
			  
			   //$jump=$arr[$j]['url'];
			   //if($jump=='')
			   echo "newinfo.php?infoid=".$arr[$j]['id']."#top";
			  // else
			  // echo $jump;
			  ?>  style="color:#0000FF" data-toggle="tooltip" title="打开链接">
          <?=$arr[$j]['name']?>
          </a> </td>
        <td><?=$arr[$j]['site']?>
        </td>
        <td><span style="color:#FF33CC">
          <?=$arr[$j]['time']?>
        </td>
		
		 <td data-toggle="tooltip" title="点击修改"><a href=modify.php?inid=<?php echo $arr[$j]['id']?> style="color:#0000FF">修改</a></td>
		 
        <td data-toggle="tooltip" title="点击删除"><a href=?date=<?php echo $arr[$j]['id']?>&&del=5026 style="color:#FF0000">删除</a></td>
      </tr>
      <?php
}
?>
    </tbody>
  </table>
  <center>
  <div>共[<B><?=$total?></B>]条记录 
  共[<?=$PageCount?>]页 当前是[<?=(($Page-1)*$pagesize+1)?>-<?php echo $Page*$pagesize>$total?$total:$Page*$pagesize;?>]条
  
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
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
