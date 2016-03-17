// JavaScript Document
var time=20;//毫秒数
var step = 1; // 移动的像素
var y = -1; // 垂直移动的方向，-1表示向上，1表示向下
var x = 1; // 水平移动的方向，-1表示向左，1表示向右
function myFloat()
{
var img = document.getElementById("myImg");
// 获取图片和当前浏览器窗口上边距，由于img.style.top获取的值带px单位
var top = img.style.top.replace("px", "");
// top = top - 100;
// img.style.top = top + "px";
// 获取图片和当前浏览器窗口左边距
var left = img.style.left.replace("px", "");
// left = left - 100;
// img.style.left = left + "px";
// 上下移动
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
// 左右移动
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
if(time<25000)//设置悬浮广告时间
setTimeout("myFloat()", 20);
else
document.getElementById("myImg").style.display = "none";//隐藏广告
	
}