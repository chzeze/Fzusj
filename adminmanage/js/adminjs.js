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
		alert('请补全信息！');
	else
	{
		//alert(date_var+name_var);
		$.ajax({ //一个Ajax过程 
		type: "post",  //以post方式与后台沟通
		url : "addinfo.php", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		data: 'v0='+date_var+'&v1='+name_var+'&v2='+time_var+'&v3='+site_var+'&v4='+url_var+'&v5='+detail_var,  
		success: function(json)
		{//如果调用php成功
		   if(json.success==1)
		   {		
				window.location.href='admintable.php';
				alert('插入成功');
		   }
		   else
		   {
				//document.getElementById("error").click();
				alert("mysql error:"+json.error);
		   		alert('添加失败!');
		   }
		}   
        });
	}
	
  });
});