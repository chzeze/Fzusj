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
<title>����֪ͨ</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#submit").click(function(){
	var detail_var=$("#detail").val();

	detail_var=detail_var.replace(/&/ig,"%26");

	alert(detail_var);
	if(detail_var=='')
		alert('֪ͨ��ϢΪ�գ�');
	else
	{
		//alert(date_var+name_var);
		$.ajax({ //һ��Ajax���� 
		type: "post",  //��post��ʽ���̨��ͨ
		url : "addnotice.php", //���phpҳ�湵ͨ
		dataType:'json',//��php���ص�ֵ�� JSON��ʽ ����
		data: 'v0='+detail_var, //����php������������ֱ������洫����u��p     
		success: function(json)
		{//�������php�ɹ�
		   if(json.success==1)
		   {		
				window.location.href='adminnote.php';
				alert('��ӳɹ�');
		   }
		   else
		   {
				//document.getElementById("error").click();
				alert("mysql error:"+json.error);
		   		alert('���ʧ��!');
		   }
		}   
        });
	}
	
  });
  $("#clean").click(function(){
	var detail_var='';
	alert('��ҳ֪ͨ����գ���ʾͼƬ');
	
	//alert(date_var+name_var);
	$.ajax({ //һ��Ajax���� 
	type: "post",  //��post��ʽ���̨��ͨ
	url : "addnotice.php", //���phpҳ�湵ͨ
	dataType:'json',//��php���ص�ֵ�� JSON��ʽ ����
	data: 'v0='+detail_var, //����php������������ֱ������洫����u��p     
	success: function(json)
	{//�������php�ɹ�
	   if(json.success==1)
	   {		
			window.location.href='adminnote.php';
			alert('��ճɹ�');
	   }
	   else
	   {
			//document.getElementById("error").click();
			alert("mysql error:"+json.error);
			alert('���ʧ��!');
	   }
	}   
	});	
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
	  <a href="unlogin.php" style="font-size:12px">�˳���¼</a></legend> 
      <p> ֪ͨ����:
        <textarea id="detail" class="form-control" rows="13" placeholder="��д��ҳ֪ͨ���ѣ����֪ͨ��Ĭ����ʾͼƬ"></textarea>
      </p>
      <button id=submit class="btn btn-success" type="button">���֪ͨ</button>
	  <button id=clean class="btn btn-danger" type="button">���֪ͨ</button>
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
