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
@$time=iconv("UTF-8","gbk",$_POST['v2']);
@$site=iconv("UTF-8","gbk",$_POST['v3']);
@$url=iconv("UTF-8","gbk",$_POST['v4']);
@$detail=iconv("UTF-8","gbk",$_POST['v5']);

$request=mysql_query("select * from idget",$con);
$row=mysql_fetch_array($request);
$id=$row['perid'];
$id++;
mysql_query("update idget set perid=$id",$con);
$t=time(); //获取当前时间
$addtime=date("Y-m-d H:i:s",$t); 

$request=mysql_query("insert into employinfo(id,date,name,site,url,time,detail,addtime) values('$id','$date','$name','$site','$url','$time','$detail','$addtime')",$con);
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