// JavaScript Document
var time=20;//������
var step = 1; // �ƶ�������
var y = -1; // ��ֱ�ƶ��ķ���-1��ʾ���ϣ�1��ʾ����
var x = 1; // ˮƽ�ƶ��ķ���-1��ʾ����1��ʾ����
function myFloat()
{
var img = document.getElementById("myImg");
// ��ȡͼƬ�͵�ǰ����������ϱ߾࣬����img.style.top��ȡ��ֵ��px��λ
var top = img.style.top.replace("px", "");
// top = top - 100;
// img.style.top = top + "px";
// ��ȡͼƬ�͵�ǰ�����������߾�
var left = img.style.left.replace("px", "");
// left = left - 100;
// img.style.left = left + "px";
// �����ƶ�
if(top <= 0)
{
y = 1;
}
if(top >= document.body.clientHeight)
{
y = -1;
}
top = (top*1) + (step * y);
img.style.top = top + "px";
// �����ƶ�
if(left <= 0)
{
x = 1;
}
// alert(img.clientWidth);
if(left >= (document.body.clientWidth - img.clientWidth))
{
x = -1;
}
left = (left*1) + (step * x);
img.style.left = left + "px";
time+=20;
if(time<25000)//�����������ʱ��
setTimeout("myFloat()", 20);
else
document.getElementById("myImg").style.display = "none";//���ع��
	
}