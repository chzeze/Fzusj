<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>招聘日程</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<?php
include_once("mysql.php");
include('conn.php');
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
	exit();
}
else
{
	$currentRow = empty($_GET['page']) ? 0 : ($_GET['page']-1)* $pagesize;
	$sql="select * from employinfo order by date desc limit $currentRow, $pagesize";
	$arr=$conndb->queryarr($sql);
}
?>
<h1 class="text-center muted">招聘日程信息</h1>
<table class="table table-bordered table-hover table-condensed">
  <thead>
    <tr>
      <th>日期</th>
      <th> 招聘单位</th>
      <th> 地点</th>
      <th> 具体时间 </th>
    </tr>
  </thead>
  <tbody>
    <?php
	for($j=0;$j<count($arr);$j++)
			{
	?>
    <tr class="success">
      <td><?=$arr[$j]['date']?>
      </td>
      <td><a href=<?php
			  
			   //$jump=$arr[$j]['url'];
			  // if($jump=='')
			   echo "newinfo.php?infoid=".$arr[$j]['id']."#top";
			  // else
			   //echo $jump;
			  ?> style="color:#0000FF" data-toggle="tooltip" title="打开链接" target="_blank">
        <?=$arr[$j]['name']?>
        </a> </td>
      <td><?=$arr[$j]['site']?>
      </td>
      <td><span style="color:#FF0000">
        <?=$arr[$j]['time']?>
        </span> </td>
    </tr>
    <?php
}
?>
  </tbody>
</table>
<center>
<div>共[<B>
  <?=$total?>
  </B>]条记录 共[
  <?=$PageCount?>
  ]页 当前是[
  <?=(($Page-1)*$pagesize+1)?>
  -<?php echo $Page*$pagesize>$total?$total:$Page*$pagesize;?>]条
  <?php
			if($Page>1) 
				echo "[<a href='table.php?page=".($Page-1)."'><span style='color:blue'>前一页</span></a>]";
			else 
				echo "[<span style='color:grey'>前一页</span>]";
			?>
  <?php
			if($Page<$PageCount) 
				echo "[<a href='table.php?page=".($Page+1)."'><span style='color:blue'>后一页</span></a>]";
			else 
				echo "[<span style='color:grey'>后一页</span>]";
			?>
  <SELECT id="page" onChange="location.href='table.php?page='+document.getElementById('page').value;">
    <?php
			for($i=1;$i<=$PageCount;$i++)
			{
				if($Page==$i) echo "<option selected='selected' value='".$i."'>第".$i."页</option>";
				else echo "<option value='".$i."'>第".$i."页</option>";;
			}
			?>
  </SELECT>
</div>
</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
