// JavaScript Document
$(document).ready(function(){
  $("#submit").click(function(){
    var date_var=$("#date").val();
	var name_var=$("#name").val();
	var site_var=$("#site").val();
	var url_var=$("#url").val();
	var detail_var=$("#detail").val();
	var time_var=$("#time").val();
	if(date_var==''||name_var=='')
		alert('�벹ȫ��Ϣ��');
	else
	{
		//alert(date_var+name_var);
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
				alert('����ɹ�');
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
});