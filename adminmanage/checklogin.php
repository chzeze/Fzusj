<?php
session_start();
header('Content-Type: text/html; charset=gb2312');
include('conn.php');
@$user=$_POST['username'];
@$pwd=$_POST['password'];
$md5pass=md5($pwd);
//��¼��¼����ip��ַ
$time=date("Y-m-d H:i:s");//��ȡ��ǰ��¼ʱ�侫ȷ����
$iipp=$_SERVER["REMOTE_ADDR"];//��ȡip
$req=mysql_query("insert into  pre_loginip(aptip,aptime) values('$iipp','$time')",$con);
if(!$req)echo mysql_error();

if($_SESSION["yzm_code"]!=@$_POST['yzm_code'])
{
	$arr['success']=2;//��֤�����
	$arr['msg']=@$_POST['yzm_code'];
}
else
{
	
	//��ֹSQLע��
	$request=mysql_query("select * from pre_useradmin where password='$md5pass' and username='$user'",$con);
	if($row=mysql_fetch_array($request))
	{
		$_SESSION['username']=$row['username'];
		$_SESSION['password']=$row['password'];
		$arr['success']=1;
		$arr['msg']='Login Success';
		$arr['name']=$user;
		
		$request=mysql_query("select userid,loginnum from pre_useradmin where username='$user'",$con);//��ȡ��ǰ�û�id�͵�¼����
		$row=mysql_fetch_array($request);
		$id=$row['userid'];
		$num=$row['loginnum'];
		$time=date("Y-m-d H:i:s");//��ȡ��ǰ��¼ʱ�侫ȷ����
		$iipp=$_SERVER["REMOTE_ADDR"];//��ȡip
		mysql_query("insert into per_logintime(loginid,user_id,logintime_var,loginip_var) values('$num','$id','$time','$iipp')",$con);//���뵱ǰ�û��˴��ĵ�¼ʱ��
		$num++;
		mysql_query("update pre_useradmin set loginnum='$num' where username='$user'",$con);//���µ�¼����
	}
	else
	{
		$arr['success']=0;
		$arr['msg']='Login Failed';
		$arr['error']=mysql_error();
	}
}
/*$arr['success']=1;
$arr['msg']='Login success';*/
echo json_encode($arr);
?>