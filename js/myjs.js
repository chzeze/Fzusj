// JavaScript Document
$(document).ready(function(){
 	var worth=$("#worth").val();//��ȡ��ǰ��ֵ
	var total=$("#total").val();//��ȡ�깺�ܶ�
	var buyworth=$("#buyworth").val();//��ȡ����ľ�ֵ
	
	var share=total/(1.003*buyworth);//����ݶ�
	var mange=total*0.002991027;//0.3%�깺��
	var tot=total/1.003;//���㹺���ܶ�
	var real=share*worth;//���㵱ǰ��ֵ
	var back_fee=real*0.0005;//������ط�
	var earning=(worth*0.9995-buyworth)*total/(1.003*buyworth)-mange;//����ʵ������[������ֵ*(1-��ط���)-���뾻ֵ]*���깺���/[(1+�깺����)*�깺��ֵ]
	
	
	share=share.toFixed(2);
	$("#share").text(share);//��ӡ�ݶ�	
	mange=mange.toFixed(2);
	$("#mange_fee").text(mange);//��ӡ�깺��
	tot=tot.toFixed(2);
	$("#total_pre").text(tot);//��ӡ�����ܶ�
	real=real.toFixed(2);
	$("#real_value").text(real);//��ӡ��ǰ��ֵ
	back_fee=back_fee.toFixed(2);
	$("#back_fee").text(back_fee);//��ӡ��ط�
	earning=earning.toFixed(2);
     $("#test1").text(earning);//��ӡʵ������
	 

  $("#total").blur(function(){//�깺�ܶ�ʧȥ���㴥��
							
  	var worth=$("#worth").val();//��ȡ��ǰ��ֵ
	var total=$("#total").val();//��ȡ�깺�ܶ�
	var buyworth=$("#buyworth").val();//��ȡ����ľ�ֵ
	
	var share=total/(1.003*buyworth);//����ݶ�
	var mange=total*0.002991027;//0.3%�깺��
	var tot=total/1.003;//���㹺���ܶ�
	var real=share*worth;//���㵱ǰ��ֵ
	var back_fee=real*0.0005;//������ط�
	var earning=(worth*0.9995-buyworth)*total/(1.003*buyworth)-mange;//����ʵ������[������ֵ*(1-��ط���)-���뾻ֵ]*���깺���/[(1+�깺����)*�깺��ֵ]
	
	
	share=share.toFixed(2);
	$("#share").text(share);//��ӡ�ݶ�	
	mange=mange.toFixed(2);
	$("#mange_fee").text(mange);//��ӡ�깺��
	tot=tot.toFixed(2);
	$("#total_pre").text(tot);//��ӡ�����ܶ�
	real=real.toFixed(2);
	$("#real_value").text(real);//��ӡ��ǰ��ֵ
	back_fee=back_fee.toFixed(2);
	$("#back_fee").text(back_fee);//��ӡ��ط�
	earning=earning.toFixed(2);
     $("#test1").text(earning);//��ӡʵ������
  });
  
   $("#buyworth").blur(function(){//���뾻ֵʧȥ���㴥��
								
   var worth=$("#worth").val();//��ȡ��ǰ��ֵ
	var total=$("#total").val();//��ȡ�깺�ܶ�
	var buyworth=$("#buyworth").val();//��ȡ����ľ�ֵ
	
	var share=total/(1.003*buyworth);//����ݶ�
	var mange=total*0.002991027;//0.3%�깺��
	var tot=total/1.003;//���㹺���ܶ�
	var real=share*worth;//���㵱ǰ��ֵ
	var back_fee=real*0.0005;//������ط�
	var earning=(worth*0.9995-buyworth)*total/(1.003*buyworth)-mange;//����ʵ������[������ֵ*(1-��ط���)-���뾻ֵ]*���깺���/[(1+�깺����)*�깺��ֵ]
	
	
	share=share.toFixed(2);
	$("#share").text(share);//��ӡ�ݶ�	
	mange=mange.toFixed(2);
	$("#mange_fee").text(mange);//��ӡ�깺��
	tot=tot.toFixed(2);
	$("#total_pre").text(tot);//��ӡ�����ܶ�
	real=real.toFixed(2);
	$("#real_value").text(real);//��ӡ��ǰ��ֵ
	back_fee=back_fee.toFixed(2);
	$("#back_fee").text(back_fee);//��ӡ��ط�
	earning=earning.toFixed(2);
     $("#test1").text(earning);//��ӡʵ������
  });
});