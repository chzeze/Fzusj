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
@$date=iconv("UTF-8","gbk",$_POST['m0']);
@$name=iconv("UTF-8","gbk",$_POST['m1']);
@$time=iconv("UTF-8","gbk",$_POST['m2']);
@$site=iconv("UTF-8","gbk",$_POST['m3']);
@$url=iconv("UTF-8","gbk",$_POST['m4']);
@$detail=iconv("UTF-8","gbk",$_POST['m5']);
@$id=iconv("UTF-8","gbk",$_POST['m6']);

$t=time(); //获取当前时间
$addtime=date("Y-m-d H:i:s",$t); 

$request=mysql_query("update employinfo set date='$date',name='$name',site='$site',url='$url',time='$time',detail='$detail',addtime='$addtime' where id='$id'",$con);
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