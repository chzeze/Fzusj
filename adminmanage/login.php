<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>�Ǻ�̨����Ա¼��֤</title>
<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
 <script type="text/javascript">
 	function create_code(){
    document.getElementById('code').src = 'yanz/verification.php?n='+Math.random()*10000;
}
</script>
</head>
<body>
<?php
	/*$iipp=$_SERVER["REMOTE_ADDR"];//��ȡip
	if($iipp=="218.106.145.10")
	{	
		echo "<script>while(1){alert('�Ǻ�')};window.location.href='http://weibo.com/u/2764151121';</script>";
	}*/
?>
<div class="container-fluid">
  <div class="row-fluid">
  <div class="span12">
      <h3 class="text-center muted"> ����Ա��¼ </h3>
    </div>
    <div class="span4"> </div>
	<center>
    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="inputEmail"></label>
        <div class="controls">
          <input id="inputname" type="text" placeholder="�������û���"/>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword"></label>
        <div class="controls">
          <input id="inputpassword" type="password"  placeholder="����������"/>
        </div>
      </div>
	  <div class="control-group">
        <label class="control-label" for="inputPassword"></label>
        <div class="controls">
          <input type="text" maxlength="4" id="srand" name="yzm_code" placeholder="��������֤��"><br>

		<img  id="code" name="code" src="yanz/verification.php"  onclick="create_code()" title="���ͼƬˢ����֤��" onclick="change_rand();">
		<a onclick="create_code();">�����壿��ͼƬ</a><br />
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <button id="submitlogin" type="submit" class="btn">��¼</button>
        </div>
      </div>
    </div>
	</center>
    <div class="span4"> </div>
  </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../js/jquery.min.js"></script>
<script>
$(document).ready(function(){
  //alert("initial");
  $("#submitlogin").click(function(){
  	//alert("click");
    var username=$("#inputname").val();
	var userpwd=$("#inputpassword").val();
	var yanz=$("#srand").val();
	if(username.indexOf(" ") > 0||username.indexOf("'")>0||username.indexOf("-") > 0||userpwd.indexOf(" ") > 0||userpwd.indexOf("'")>0||userpwd.indexOf("-") > 0||username.length>20||userpwd.length>20)
	{
    	alert('�����ʽ�쳣,����������');
	}
	else if(yanz=='')
	{
		alert('��������֤��');
	}
	else
	{
		$.ajax({ //һ��Ajax���� 
		type: "post",  //��post��ʽ���̨��ͨ
		url : "checklogin.php", //���phpҳ�湵ͨ
		dataType:'json',//��php���ص�ֵ�� JSON��ʽ ����
		data: 'username='+username+'&password='+userpwd+'&yzm_code='+yanz, //����php������������ֱ������洫����u��p   
		success: function(json)
		{//�������php�ɹ�
		   //alert(json.username+'\n'+json.password); //��php�еķ���ֵ��json.username���� alert����
		  // alert(json.success);
		   if(json.success==1)
		   {		
				window.location.href='admintable.php';
		   }
		   else	 if(json.success==2)
		   {
				//document.getElementById("error").click();
		   		alert('��֤�����');
				window.location.href='login.php';
		   }
		   else	 
		   {
				//document.getElementById("error").click();
		   		alert('�û������������!'+json.error);
				window.location.href='login.php';
		   }
		}   
        });
	}
	
  });
});
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256517219).'" width="0" height="0"/>';?>
</body>
</html>
