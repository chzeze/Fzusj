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
<title>�򱨺�̨����</title>
<!-- ����Ϊtextarea�Ĵ��� -->
<style>
	form {
		margin: 0;
	}
	textarea {
		display: block;
	}
</style>
<link rel="stylesheet" href="../textarea/themes/default/default.css" />
<script charset="utf-8" src="../textarea/kindeditor-min.js"></script>
<script charset="utf-8" src="../textarea/lang/zh_CN.js"></script>
<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					allowFileManager : true
				});
			});
		</script>
<!-- ����Ϊtextarea�Ĵ��� -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.min.js" charset="gb2312"></script>
<script>
$(document).ready(function(){
  $("#submit").click(function(){

    var date_var=$("#date").val();
	//alert(date_var);
	var name_var=$("#name").val();
	//alert(name_var);
	//var site_var=$("#site").val();
	//var url_var=$("#url").val();
	var detail_var=editor.html();//$("#detail").val();
	//alert(detail_var);
	//var time_var=$("#time").val();
	if(date_var==''||name_var=='')
		alert('�벹ȫ��Ϣ��');
	else
	{

		name_var=name_var.replace(/&/ig,"%26");
		//alert(name_var);
		detail_var=detail_var.replace(/&/ig,"%26");
		//alert(detail_var);
		//����ѹ��
		var sourceLength = detail_var.length;
		var rep = /\n+/g;
		var repone = /<!--.*?-->/ig;
		var reptwo = /\/\*.*?\*\//ig;
		var reptree = /[ ]+</ig;
		var sourceZero = detail_var.replace(rep,"");
		var sourceOne = sourceZero.replace(repone,"");
		var sourceTwo = sourceOne.replace(reptwo,"");
		detail_var = sourceTwo.replace(reptree,"<");
		//------------
		//alert(name_var+"\n"+date_var+"\n"+detail_var);
		$.ajax({ //һ��Ajax���� 
		type: "post",  //��post��ʽ���̨��ͨ
		url : "addbrief.php", //���phpҳ�湵ͨ
		dataType:'json',//��php���ص�ֵ�� JSON��ʽ ����
		data: 'v0='+date_var+'&v1='+name_var+'&v2='+detail_var,   
		success: function(json)
		{//�������php�ɹ�
		   if(json.success==1)
		   {		
				window.location.href='adminbrief.php';
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
      <legend>
      <span style="color:#993300; font-size:14px; font-weight:bold">����,����Ա:</span> <span style="color:#FF0000; font-size:14px; font-weight:bold">
      <?=$admin?>
      </span> <span style="color:#993300; font-size:14px; font-weight:bold">�ϴε�¼ʱ��Ϊ��</span> <span style="color:#FF0000; font-size:14px; font-weight:bold">
      <?=$time?>
      </span>
      <p> <span style="color:#993300; font-size:14px; font-weight:bold">��ʷ��¼������</span> <span style="color:#FF0000; font-size:14px; font-weight:bold">
        <?=$lognum?>
        ��</span> &nbsp;&nbsp;&nbsp;&nbsp; <a href="unlogin.php" style="font-size:12px">�˳���¼</a>
      <p>��Ӽ���Ϣ
        </legend>
      <p> �����ڣ�
        <input id=date type="date" value=""/>
        <span style="color:#FF0000">*</span> </p>
      <p> �򱨱��⣺
        <input id=name type="text" placeholder="name..."/>
        <span style="color:#FF0000">*</span> </p>
      <p>
        <textarea id="detail" name="content" style="width:800px;height:400px;visibility:hidden;" placeholder="������ת��������Ϣ..."></textarea>
      </p>
      <button id=submit class="btn btn-success" type="button">���</button>
      <br/>
      </fieldset>
    </form>
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
			$delsql="delete from brief where infoid='".$_GET['date']."'";
			mysql_query($delsql);
			echo "<script>alert('ɾ���ɹ�')</script>";
			echo "<script>window.location.href='adminbrief.php'</script>";
		}
	}	
	?>
    <?php
include_once("mysql.php");
$conndb=new ConnDB();

$sql="select count(*) from brief";
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
	$sql="select * from brief order by time desc limit $currentRow, $pagesize";
	$arr=$conndb->queryarr($sql);
}
?>
    <table class="table table-bordered table-hover table-condensed">
      <thead>
        <tr>
          <th> ���� </th>
          <th> ��λ </th>
          <th> ɾ�� </th>
        </tr>
      </thead>
      <tbody>
        <?php
	for($j=0;$j<count($arr);$j++)
			{
	?>
        <tr class="error">
          <td><?=$arr[$j]['time']?>
          </td>
          <td><a href=<?php
			   echo "../subject/detailinfo.php?infoid=".$arr[$j]['infoid']."#top";
			  ?>  style="color:#0000FF" data-toggle="tooltip" title="������">
            <?=$arr[$j]['head']?>
            </a> </td>
          <td data-toggle="tooltip" title="���ɾ��"><a href=?date=<?php echo $arr[$j]['infoid']?>&&del=5026 style="color:#FF0000">ɾ��</a></td>
        </tr>
        <?php
}
?>
      </tbody>
    </table>
    <div>��[<B>
      <?=$total?>
      </B>]����¼ 
      ��[
      <?=$PageCount?>
      ]ҳ ��ǰ��[
      <?=(($Page-1)*$pagesize+1)?>
      -<?php echo $Page*$pagesize>$total?$total:$Page*$pagesize;?>]��
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
<script src="../js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>
