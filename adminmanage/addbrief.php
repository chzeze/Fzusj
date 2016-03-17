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
@$date=iconv("UTF-8","gbk",$_POST['v0']);
@$name=iconv("UTF-8","gbk",$_POST['v1']);
@$detail=iconv("UTF-8","gbk",$_POST['v2']);

$request=mysql_query("select * from briefid",$con);
$row=mysql_fetch_array($request);
$id=$row['id'];
$id++;
mysql_query("update briefid set id=$id",$con); 

$request=mysql_query("insert into brief(infoid,head,detail,time) values('$id','$name','$detail','$date')",$con);

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
echo json_encode($arr);
?>