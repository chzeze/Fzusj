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
<!-- ����3��meta��ǩ*����*������ǰ�棬�κ��������ݶ�*����*������� -->
<title>��̨����</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.min.js" charset="UTF-8"></script>
<script src="js/adminjs.js"></script>
</head>
<body>
<?php 
include('conn.php');
include('mysql.php');
if(@$_GET['date']&&$_GET['del'])//ɾ��
{
	$y=$_GET['date'];
	$m=$_GET['del'];
    if(!is_numeric($y)||!is_numeric($m)||$m!=5026)//�Ƿ��ַ��ж�
	{
		$time=date("Y-m-d H:i:s");//��ȡ��ǰ��¼ʱ�侫ȷ����
		$iipp=$_SERVER["REMOTE_ADDR"];//��ȡip
		//$req=mysql_query("insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$m\",'$time')",$con);
		$conndb=new ConnDB();
		$info=$y.$m;
		$sql="insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$info\",'$time')";
		$arr=$conndb->query($sql);
		//if(!$req) echo "error:".mysql_error();
		echo "<script>alert('�Ƿ�����!����ip�ѱ���¼���Ժ����ǻ�������ϵ');window.location.href='http://weibo.com/u/2764151121';</script>";
	}
	else
	{
		$delsql="delete from employinfo where id='".$_GET['date']."'";
		mysql_query($delsql);
		echo "<script>alert('ɾ���ɹ�')</script>";
		echo "<script>window.location.href='admintable.php'</script>";
	}
}

$request=mysql_query("select * from pre_useradmin where username='$admin'",$con);//������һ�ε�¼ʱ��
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
      <legend><span style="color:#993300; font-size:14px; font-weight:bold">����,����Ա:</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$admin?></span> 
	  <span style="color:#993300; font-size:14px; font-weight:bold">�ϴε�¼ʱ��Ϊ��</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$time?></span><p>
	  <span style="color:#993300; font-size:14px; font-weight:bold">��ʷ��¼������</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$lognum?>��</span>
	  &nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="unlogin.php" style="font-size:12px">�˳���¼</a></legend>   
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
if(is_numeric($info_id)==false)//��ֹSQLע��
{
	$time=date("Y-m-d H:i:s");//��ȡ��ǰ��¼ʱ�侫ȷ����
	$iipp=$_SERVER["REMOTE_ADDR"];//��ȡip
	$req=mysql_query("insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$info_id\",'$time')",$con);
	if(!$req)echo mysql_error();
	echo "<script>alert('�Ƿ�����!����ip�ѱ���¼���Ժ����ǻ�������ϵ');window.location.href='http://weibo.com/u/2764151121';</script>";
}
else
{
	$currentRow = empty($_GET['page']) ? 0 : ($_GET['page']-1)* $pagesize;
	$sql="select * from employinfo order by date desc limit $currentRow, $pagesize";
	$arr=$conndb->queryarr($sql);
}
?>
  <h3 class="muted text-center"> ��Ƹ��Ϣ��� </h3>
  <table class="table table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th> ���� </th>
        <th> ��λ </th>
        <th> �ص� </th>
        <th> ʱ�� </th>
		<th> �޸� </th>
        <th> ɾ�� </th>
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
			  ?>  style="color:#0000FF" data-toggle="tooltip" title="������">
          <?=$arr[$j]['name']?>
          </a> </td>
        <td><?=$arr[$j]['site']?>
        </td>
        <td><span style="color:#FF33CC">
          <?=$arr[$j]['time']?>
        </td>
		
		 <td data-toggle="tooltip" title="����޸�"><a href=modify.php?inid=<?php echo $arr[$j]['id']?> style="color:#0000FF">�޸�</a></td>
		 
        <td data-toggle="tooltip" title="���ɾ��"><a href=?date=<?php echo $arr[$j]['id']?>&&del=5026 style="color:#FF0000">ɾ��</a></td>
      </tr>
      <?php
}
?>
    </tbody>
  </table>
  <center>
  <div>��[<B><?=$total?></B>]����¼ 
  ��[<?=$PageCount?>]ҳ ��ǰ��[<?=(($Page-1)*$pagesize+1)?>-<?php echo $Page*$pagesize>$total?$total:$Page*$pagesize;?>]��
  
  <?php
			if($Page>1) 
				echo "[<a href='admintable.php?page=".($Page-1)."'><span style='color:blue'>ǰһҳ</span></a>]";
			else 
				echo "[<span style='color:grey'>ǰһҳ</span>]";
			?>
  <?php
			if($Page<$PageCount) 
				echo "[<a href='admintable.php?page=".($Page+1)."'><span style='color:blue'>��һҳ</span></a>]";
			else 
				echo "[<span style='color:grey'>��һҳ</span>]";
			?>
  <SELECT id="page" onChange="location.href='admintable.php?page='+document.getElementById('page').value;">
    <?php
			for($i=1;$i<=$PageCount;$i++)
			{
				if($Page==$i) echo "<option selected='selected' value='".$i."'>��".$i."ҳ</option>";
				else echo "<option value='".$i."'>��".$i."ҳ</option>";;
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
