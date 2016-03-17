<?php
	session_start();
	if(!isset($_SESSION['username'])||!isset($_SESSION['password']))
	{
		echo "<script>window.location.href='login.php';</script>";
		exit();
	}
	$admin=$_SESSION['username'];
?>
<?php
header('Content-Type: text/html; charset=gb2312');
include('conn.php');
if(isset($_POST['v0']))
	@$detail=iconv("UTF-8","gbk",$_POST['v0']);
else
	echo "error!";

$request=mysql_query("select * from noticvar order by notid desc",$con);
$row=mysql_fetch_array($request);
$id=$row['notid'];//获取当前的通知id号
$id++;

$request=mysql_query("insert into noticvar(notid,notic) values('$id','$detail')",$con);
if($request)
{
	$arr['success']=1;
	$arr['msg']='Login Success';
}
else
{
	$arr['error']=mysql_error();
	$arr['success']=0;
	$arr['msg']='Login Failed';
}
/*$arr['success']=1;
$arr['msg']='Login success';*/
echo json_encode($arr);
?>