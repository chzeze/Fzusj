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
<script type="text/javascript" src="../js/jquery.min.js" charset="gb2312"></script>
<script>
$(document).ready(function(){
  $("#submit").click(function(){
    var date_var=$("#date").val();
	var name_var=$("#name").val();
	var site_var=$("#site").val();
	var url_var=$("#url").val();
	var detail_var=$("#detail").val();
	var time_var=$("#time").val();
	if(date_var==''||name_var==''||time_var=='')
		alert('�벹ȫ��Ϣ��');
	else
	{
		//alert(date_var+name_var);

		name_var=name_var.replace(/&/ig,"%26");
		site_var=site_var.replace(/&/ig,"%26");
		detail_var=detail_var.replace(/&/ig,"%26");

		alert(name_var+"\n"+date_var+"\n"+time_var+"\n"+detail_var);
		$.ajax({ //һ��Ajax���� 
		type: "post",  //��post��ʽ���̨��ͨ
		url : "addinfo.php", //���phpҳ�湵ͨ
		dataType:'json',//��php���ص�ֵ�� JSON��ʽ ����
		data: 'v0='+date_var+'&v1='+name_var+'&v2='+time_var+'&v3='+site_var+'&v4='+url_var+'&v5='+detail_var,   
		success: function(json)
		{//�������php�ɹ�
		   if(json.success==1)
		   {		
				window.location.href='admintable.php';
				alert('��ӳɹ�');
		   }
		   else
		   {
				alert("mysql error:"+json.error);
		   		alert('���ʧ��');
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
    <form class="form-inline">
      <fieldset>
      <legend><span style="color:#993300; font-size:14px; font-weight:bold">����,����Ա:</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$admin?></span> 
	  <span style="color:#993300; font-size:14px; font-weight:bold">�ϴε�¼ʱ��Ϊ��</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$time?></span><p>
	  <span style="color:#993300; font-size:14px; font-weight:bold">��ʷ��¼������</span>
	  <span style="color:#FF0000; font-size:14px; font-weight:bold"><?=$lognum?>��</span>
	  &nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="unlogin.php" style="font-size:12px">�˳���¼</a>
	  <p>�����Ƹ��Ϣ</legend>
      <p> ��Ƹ���ڣ�
        <input id=date type="date" value=""/>
        <span style="color:#FF0000">*</span> </p>
      <p> ��ҵ���ƣ�
        <input id=name type="text" placeholder="name..."/>
        <span style="color:#FF0000">*</span> </p>
      <p> ����ʱ�䣺
        <input id=time type="time" placeholder="00-00"/>
        <span style="color:#FF0000">*</span> </p>
      <p> ��Ƹ�ص㣺
        <input id=site type="text" placeholder="place..."/>
        <span style="color:#FF0000">*</span> </p>
      <p> ������ӣ�
        <input id=url type="text" placeholder="http://...(ѡ��)"/>
        <span>&nbsp;</span> </p>
      <p> ��ϸ��Ϣ:
        <textarea id="detail" class="form-control" rows="13" placeholder="������ת��������Ϣ..."></textarea>
      </p>
      <button id=submit class="btn btn-success" type="button">���</button><br/>
<a href="adminaddinfo.php"><font style="color:blue" size="3"><br/>���븻�ı��༭ģʽ</font></a><br/>
      </fieldset>
    </form>
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
