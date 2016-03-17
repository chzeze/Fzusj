<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>福大数计学院招聘日历</title>
<link rel="short icon" href="images/fzulogo1.png">
</head>
<body>
<?php
include('mysql.php');
include('conn.php');
	/** 
	* PHP万年历 
	*/ 
class Calendar{ 
		protected $_table;//table表格 
		protected $_currentDate;//当前日期 
		protected $_year; //年 
		protected $_month; //月
		protected $_day;//日
		protected $_days; //给定的月份应有的天数 
		protected $_dayofweek;//给定月份的 1号 是星期几
		protected $_monthdayof;//输出给定月份的剩余的空白日期 
		 
		/** 
		* 构造函数 
		*/ 
		public function __construct() 
		{ 
			$this->
			_table="";
			//$y=$_GET['y'];
			//$m=$_GET['m'];
			$this->_year = isset($_GET["y"])?$_GET["y"]:date("Y"); 
			$this->_month = isset($_GET["m"])?$_GET["m"]:date("m"); 
			$this->_day=date("d");
			if ($this->_month>12){//处理出现月份大于12的情况 
			$this->_month=1; 
			$this->_year++; 
			} 
			if ($this->_month<1){//处理出现月份小于1的情况 
			$this->_month=12; 
			$this->_year--; 
			} 
			$this->_currentDate = $this->_year.'年'.$this->_month.'月份';//当前得到的日期信息 
			$this->_days = date("t",mktime(0,0,0,$this->_month,1,$this->_year));//得到给定的月份应有的天数 
			$this->_dayofweek = date("w",mktime(0,0,0,$this->_month,1,$this->_year));//得到给定的月份的 1号 是星期几 
			$this->_monthdayof=35-($this->_dayofweek)-($this->_days);//输出给定月份的剩余的空白日期 
			if($this->_monthdayof<0)
				$this->_monthdayof+=7; 
		} 
		/** 
		* 输出标题和表头信息 
		*/ 
		protected function _showTitle() { 
		$this->_table="
		<center>
		  <div style=\"width:890px;padding:5px;border:1px  solid; color=\"#ddf0f2\";text-align:center\">
			<div style=\"padding:5px;border:1px  dotted; color=\"#ddf0f2\"\"><span style=\"color:blue\">当前月份是：</span> <font color=#FF0000><b>$this->_currentDate</b></font>
			  <center>
			  <h3><a href='?y=".($this->_year)."&m=".($this->_month-1)."'>上一月</a> "; 
		       $this->_table.="<a href='?y=".($this->_year)."&m=".($this->_month+1)."'>下一月</a>
			   </h3>
			  </center>
			</div>
		  </div>
		</center>";
		$this->_table.="
		<table width=\"900\" cellspacing=\"1\" bgcolor=\"#FF3366\" align=\"center\">
		  <tr align=\"center\">
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>星期日</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>星期一</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>星期二</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>星期三</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>星期四</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>星期五</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>星期六</b></td>
		  </tr>
		 
		  <tr height=\"70\" align=\"center\">"; 
		}
		  /** 
		  * 输出日期信息 
		  * 根据当前日期输出日期信息 
		  */ 
		  protected function _showDate() {
		   
		  $nums=$this->_dayofweek+1; 
		  for ($i=1;$i<=$this->_dayofweek;$i++){//输出1号之前的空白日期 
		  $this->_table.="
		  <td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#FFFFFF\"><font color=#000000></font><br>
		  <font  face=\"仿宋\" color=green></font>
		   </td>
			"; 
			} 
			for ($i=1;$i<=$this->_days;$i++)
			{//输出天数信息
				$y=$this->_year;
				$m=$this->_month;
				if(!is_numeric($y)||!is_numeric($m))//非法字符判断
				{
					$time=date("Y-m-d H:i:s");//获取当前登录时间精确到秒
					$iipp=$_SERVER["REMOTE_ADDR"];//获取ip
					//$req=mysql_query("insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$m\",'$time')",$con);
					$conndb=new ConnDB();
					$info=$y.$m;
					$sql="insert into  pre_hackers(attackip,attackinfo,attacktime) values('$iipp',\"$info\",'$time')";
					$arr=$conndb->query($sql);
					//if(!$req) echo "error:".mysql_error();
					echo "<script>alert('非法参数!您的ip已被记录，稍后我们会与您联系');window.location.href='http://weibo.com/u/2764151121';</script>";
					break;
				}
				else
				{
					$conndb=new ConnDB();
					$sql="select * from employinfo where date='$this->_year-$this->_month-$i' order by time";
					$arr=$conndb->queryarr($sql);
				}
				//echo $sql."<br>";
				$info_i="";
				//var_dump($arr);
				if(count($arr))
				{
					$info_i.="<span style=\"color:grey\">$i</span></br>";
					for($j=0;$j<count($arr);$j++)
					{
					/*	if($arr[$j]['url']=='')//链接是否为空，非空跳转外链
							$info_i.="
							<div>
							  <div><span style=\"color:red\"><center>".$arr[$j]['time']."</center></span></div>"."
							   <div>
								<center>
								 <a data-toggle=\"tooltip\" title=\"点击查看更多\" style=\"color:black\" href=newinfo.php?infoid=".$arr[$j]['id']."><font size=1px>".$arr[$j]['name']."</font></a>
								 </center>
								<div>
							  </div>";
						else*/
							$info_i.="
							<div>
								<div><span style=\"color:red\"><center>".$arr[$j]['time']."</center></span></div>"."
								<div>
								 <center>
									<a data-toggle=\"tooltip\" title=\"点击查看更多\" style=\"color:black\" href=newinfo.php?infoid=".$arr[$j]['id']."#top target=\"_blank\"><font size=1>".$arr[$j]['name']."</font></a>
								  </center>
								<div>
							</div>";
					}
					
				}
				else
				{
					$info_i="<div><center><span style=\"color:grey\">$i</span></center></div>";
				}
				
				if ($nums%7==0)//当前时间$this->_year / $this->_month /  $this->_day 
				{//换行处理：7个一行 
					if($this->_day==$i)
					$this->_table.="
					<td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#fcfdd5\"><font color=#000000>$info_i</font><br>
					<font  face=\"仿宋\" color=green></font>
					</td>
					</tr>"; 
					else
					$this->_table.="
					<td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#ebfdee\"><font color=#000000>$info_i</font><br>
					<font  face=\"仿宋\" color=green></font>
					</td>
					</tr>"; 
				}
				else
				{ 
					if($this->_day==$i)
					$this->_table.="
					<td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#fcfdd5\"><font color=#000000>$info_i</font><br>
					<font  face=\"仿宋\" color=green></font>
					</td>"; 
					else
					$this->_table.="
					<td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#ebfdee\"><font color=#000000>$info_i</font><br>
					<font  face=\"仿宋\" color=green></font>
					</td>"; 
				} 
				$nums++; 
			}
		  for ($i=1;$i<=$this->_monthdayof;$i++){//输出给定月份的剩余的空白日期 
		  $this->_table.="
		  <td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#FFFFFF\"><font color=#000000></font><br>
		  <font  face=\"仿宋\" color=green></font>
		  </td>
			"; 
			} 
			$this->_table.="
		</table>
		"; 
	} 
	/** 
	* 输出日历 
	*/ 
	public function showCalendar(){
 
	$this->_showTitle(); 
	$this->_showDate(); 
	echo $this->_table; 
	} 
} 
$calc=new Calendar(); 
$calc->showCalendar(); 
?>
<?php require_once 'cs.php';echo '<img src="'._cnzzTrackPageView(1256556083).'" width="0" height="0"/>';?>
</body>
</html>