<?php 
session_start();
//调用函数生成4位数字验证码
get_code(4,80,30);
function get_code($num,$w,$h) {
	$code ="";
	//循环拼接验证码字符串，其中$num表示验证码个数
	for ($i = 0; $i<$num; $i++) {
		$code .= rand(0, 9);
	}

	//将生成的验证码写入session，备验证时用
	$_SESSION["yzm_code"] = $code;
    //定义图片头部
	header("Content-type: image/PNG");
	$im = imagecreate($w, $h);
	//创建图片，定义颜色值
	$black = imagecolorallocate($im, 0,153, 51);
	$gray = imagecolorallocate($im, 200, 200, 200);
	$bgcolor = imagecolorallocate($im, 255, 255, 255);
	//填充背景
	imagefill($im, 0, 0, $gray);
 
	//画边框
	imagerectangle($im, 0, 0, $w-1, $h-1, $black);
 
	//随机绘制两条虚线，起干扰作用
	$style = array ($black,$black,$black,$black,$black,
		$gray,$gray,$gray,$gray,$gray
	);
	imagesetstyle($im, $style);
	$y1 = rand(0, $h);
	$y2 = rand(0, $h);
	$y3 = rand(0, $h);
	$y4 = rand(0, $h);
	imageline($im, 0, $y1, $w, $y3, IMG_COLOR_STYLED);
	imageline($im, 0, $y2, $w, $y4, IMG_COLOR_STYLED);
 
	//在画布上随机生成大量黑点，起干扰作用;
	for ($i = 0; $i<80; $i++) {
		imagesetpixel($im, rand(0, $w), rand(0, $h), $black);
	}
	//将数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成
	$strx = rand(8, 12);
	for ($i = 0; $i<$num; $i++) {
		$strpos = rand(3, 10);
		imagestring($im, 15, $strx, $strpos, substr($code, $i, 1), $black);
		$strx += rand(12, 18);
	}
	imagepng($im);//输出图片
	imagedestroy($im);//释放图片所占内存
}
?>