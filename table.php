<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>��Ƹ�ճ�</title>
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
if(is_numeric($info_id)==false)//��ֹSQLע��
{
	$time=date("Y-m-d H:i:s");//��ȡ��ǰ��¼ʱ�侫ȷ����
	$iipp=$_SERVER["REMOTE_ADDR"];//��ȡip
	$req=mysql_query("insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$info_id\",'$time')",$con);
	if(!$req)echo mysql_error();
	echo "<script>alert('�Ƿ�����!����ip�ѱ���¼���Ժ����ǻ�������ϵ');window.location.href='http://weibo.com/u/2764151121';</script>";
	exit();
}
else
{
	$currentRow = empty($_GET['page']) ? 0 : ($_GET['page']-1)* $pagesize;
	$sql="select * from employinfo order by date desc limit $currentRow, $pagesize";
	$arr=$conndb->queryarr($sql);
}
?>
<h1 class="text-center muted">��Ƹ�ճ���Ϣ</h1>
<table class="table table-bordered table-hover table-condensed">
  <thead>
    <tr>
      <th>����</th>
      <th> ��Ƹ��λ</th>
      <th> �ص�</th>
      <th> ����ʱ�� </th>
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
			  ?> style="color:#0000FF" data-toggle="tooltip" title="������" target="_blank">
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
<div>��[<B>
  <?=$total?>
  </B>]����¼ ��[
  <?=$PageCount?>
  ]ҳ ��ǰ��[
  <?=(($Page-1)*$pagesize+1)?>
  -<?php echo $Page*$pagesize>$total?$total:$Page*$pagesize;?>]��
  <?php
			if($Page>1) 
				echo "[<a href='table.php?page=".($Page-1)."'><span style='color:blue'>ǰһҳ</span></a>]";
			else 
				echo "[<span style='color:grey'>ǰһҳ</span>]";
			?>
  <?php
			if($Page<$PageCount) 
				echo "[<a href='table.php?page=".($Page+1)."'><span style='color:blue'>��һҳ</span></a>]";
			else 
				echo "[<span style='color:grey'>��һҳ</span>]";
			?>
  <SELECT id="page" onChange="location.href='table.php?page='+document.getElementById('page').value;">
    <?php
			for($i=1;$i<=$PageCount;$i++)
			{
				if($Page==$i) echo "<option selected='selected' value='".$i."'>��".$i."ҳ</option>";
				else echo "<option value='".$i."'>��".$i."ҳ</option>";;
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
