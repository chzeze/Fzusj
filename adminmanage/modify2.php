<?php
	session_start();
	if(!isset($_SESSION['username'])||!isset($_SESSION['password']))
	{
		echo "<script>window.location.href='login.php';</script>";
	}
	$admin=$_SESSION['username'];
	if(!isset($_GET['inid']))
	{
		echo "<script>window.location.href='admintable.php';</script>";
	}
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
<script>
$(document).ready(function(){
   //alert("yes");
  //$("#error").hide();
  $("#submit").click(function(){
    var date_var=$("#date").val();
	var name_var=$("#name").val();
	var site_var=$("#site").val();
	var url_var=$("#url").val();
	var detail_var=$("#detail").val();
	var time_var=$("#time").val();
	var id_var=$("#id").val();
	if(date_var==''||name_var=='')
		alert('�벹ȫ��Ϣ��');
	else
	{
		name_var=name_var.replace(/&/ig,"%26");
		site_var=site_var.replace(/&/ig,"%26");
		detail_var=detail_var.replace(/&/ig,"%26");
		alert(name_var+" \n"+date_var+"\n"+time_var+"\n"+detail_var);
		$.ajax({ //һ��Ajax���� 
		type: "post",  //��post��ʽ���̨��ͨ
		url : "updateinfo.php", //���phpҳ�湵ͨ
		dataType:'json',//��php���ص�ֵ�� JSON��ʽ ����
		data: 'm0='+date_var+'&m1='+name_var+'&m2='+time_var+'&m3='+site_var+'&m4='+url_var+'&m5='+detail_var+'&m6='+id_var, //����php������������ֱ������洫����u��p     
		success: function(json)
		{//�������php�ɹ�
		   if(json.success==1)
		   {		
				window.location.href='admintable.php';
				alert('�޸ĳɹ�');
		   }
		   else
		   {
				alert('�޸�ʧ��!'+"mysql error:"+json.error);
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
include('conn.php');//��ֵ


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

$infoid=$_GET['inid'];
$request=mysql_query("select * from employinfo where id='$infoid'",$con);
$row=mysql_fetch_array($request);
$var_date=$row['date'];//iconv("gb2312","UTF-8",$row['date']);
$var_name=$row['name'];//iconv("gb2312","UTF-8",$row['name']);
$var_site=$row['site'];//iconv("gb2312","UTF-8",$row['site']);
$var_url=$row['url'];//iconv("gb2312","UTF-8",$row['url']);
$var_time=$row['time'];//iconv("gb2312","UTF-8",$row['time']);//$row['time'];
$var_detail=$row['detail'];//iconv("gb2312","UTF-8",$row['detail']);
//echo $var_date.$var_name.$var_site.$var_url.$var_time.$var_detail;
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
	  <a href="unlogin.php" style="font-size:12px">�˳���¼</a></legend> <p>
	  �޸���Ϣ��
      <p> ��Ƹ���ڣ�
        <input id=date type="date" value=<?=$var_date?> />
        <span style="color:#FF0000">*</span> </p>
      <p> ��ҵ���ƣ�
        <input id=name type="text" placeholder="name..." value=<?=$var_name?> />
        <span style="color:#FF0000">*</span> </p>
      <p> ����ʱ�䣺
        <input id=time type="time" placeholder="00-00" value=<?=$var_time?> />
        <span style="color:#FF0000">*</span> </p>
      <p> ��Ƹ�ص㣺
        <input id=site type="text" placeholder="place..." value=<?=$var_site?> />
        <span style="color:#FF0000">*</span> </p>
      <p> ������ӣ�
        <input id=url type="text" placeholder="http://...(ѡ��)" value=<?=$var_url?> >
        <span>&nbsp;</span> </p>
      <p> ��ϸ��Ϣ:
        <textarea id="detail" class="form-control" rows="13" placeholder="������ת��������Ϣ..."><?=$var_detail?></textarea>
      </p>
	  <input id=id type="hidden" value="<?=$infoid?>">
      <button id=submit class="btn btn-success" type="button">�޸�</button><br/>
<a href=modify.php?inid=<?php echo $_GET['inid']?>><font style="color:blue" size="3"><br/>���븻�ı��༭ģʽ</font></a>

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
