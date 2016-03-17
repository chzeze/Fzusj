// JavaScript Document
$(document).ready(function(){
 	var worth=$("#worth").val();//获取当前净值
	var total=$("#total").val();//获取申购总额
	var buyworth=$("#buyworth").val();//获取买入的净值
	
	var share=total/(1.003*buyworth);//计算份额
	var mange=total*0.002991027;//0.3%申购费
	var tot=total/1.003;//计算购入总额
	var real=share*worth;//计算当前市值
	var back_fee=real*0.0005;//计算赎回费
	var earning=(worth*0.9995-buyworth)*total/(1.003*buyworth)-mange;//计算实际收益[卖出净值*(1-赎回费率)-买入净值]*总申购金额/[(1+申购费率)*申购净值]
	
	
	share=share.toFixed(2);
	$("#share").text(share);//打印份额	
	mange=mange.toFixed(2);
	$("#mange_fee").text(mange);//打印申购费
	tot=tot.toFixed(2);
	$("#total_pre").text(tot);//打印购入总额
	real=real.toFixed(2);
	$("#real_value").text(real);//打印当前市值
	back_fee=back_fee.toFixed(2);
	$("#back_fee").text(back_fee);//打印赎回费
	earning=earning.toFixed(2);
     $("#test1").text(earning);//打印实际收益
	 

  $("#total").blur(function(){//申购总额失去焦点触发
							
  	var worth=$("#worth").val();//获取当前净值
	var total=$("#total").val();//获取申购总额
	var buyworth=$("#buyworth").val();//获取买入的净值
	
	var share=total/(1.003*buyworth);//计算份额
	var mange=total*0.002991027;//0.3%申购费
	var tot=total/1.003;//计算购入总额
	var real=share*worth;//计算当前市值
	var back_fee=real*0.0005;//计算赎回费
	var earning=(worth*0.9995-buyworth)*total/(1.003*buyworth)-mange;//计算实际收益[卖出净值*(1-赎回费率)-买入净值]*总申购金额/[(1+申购费率)*申购净值]
	
	
	share=share.toFixed(2);
	$("#share").text(share);//打印份额	
	mange=mange.toFixed(2);
	$("#mange_fee").text(mange);//打印申购费
	tot=tot.toFixed(2);
	$("#total_pre").text(tot);//打印购入总额
	real=real.toFixed(2);
	$("#real_value").text(real);//打印当前市值
	back_fee=back_fee.toFixed(2);
	$("#back_fee").text(back_fee);//打印赎回费
	earning=earning.toFixed(2);
     $("#test1").text(earning);//打印实际收益
  });
  
   $("#buyworth").blur(function(){//买入净值失去焦点触发
								
   var worth=$("#worth").val();//获取当前净值
	var total=$("#total").val();//获取申购总额
	var buyworth=$("#buyworth").val();//获取买入的净值
	
	var share=total/(1.003*buyworth);//计算份额
	var mange=total*0.002991027;//0.3%申购费
	var tot=total/1.003;//计算购入总额
	var real=share*worth;//计算当前市值
	var back_fee=real*0.0005;//计算赎回费
	var earning=(worth*0.9995-buyworth)*total/(1.003*buyworth)-mange;//计算实际收益[卖出净值*(1-赎回费率)-买入净值]*总申购金额/[(1+申购费率)*申购净值]
	
	
	share=share.toFixed(2);
	$("#share").text(share);//打印份额	
	mange=mange.toFixed(2);
	$("#mange_fee").text(mange);//打印申购费
	tot=tot.toFixed(2);
	$("#total_pre").text(tot);//打印购入总额
	real=real.toFixed(2);
	$("#real_value").text(real);//打印当前市值
	back_fee=back_fee.toFixed(2);
	$("#back_fee").text(back_fee);//打印赎回费
	earning=earning.toFixed(2);
     $("#test1").text(earning);//打印实际收益
  });
});