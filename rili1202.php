<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��������ѧԺ��Ƹ����</title>
<link rel="short icon" href="images/fzulogo1.png">
</head>
<body>
<?php
include('mysql.php');
include('conn.php');
	/** 
	* PHP������ 
	*/ 
class Calendar{ 
		protected $_table;//table��� 
		protected $_currentDate;//��ǰ���� 
		protected $_year; //�� 
		protected $_month; //��
		protected $_day;//��
		protected $_days; //�������·�Ӧ�е����� 
		protected $_dayofweek;//�����·ݵ� 1�� �����ڼ�
		protected $_monthdayof;//��������·ݵ�ʣ��Ŀհ����� 
		 
		/** 
		* ���캯�� 
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
			if ($this->_month>12){//��������·ݴ���12����� 
			$this->_month=1; 
			$this->_year++; 
			} 
			if ($this->_month<1){//��������·�С��1����� 
			$this->_month=12; 
			$this->_year--; 
			} 
			$this->_currentDate = $this->_year.'��'.$this->_month.'�·�';//��ǰ�õ���������Ϣ 
			$this->_days = date("t",mktime(0,0,0,$this->_month,1,$this->_year));//�õ��������·�Ӧ�е����� 
			$this->_dayofweek = date("w",mktime(0,0,0,$this->_month,1,$this->_year));//�õ��������·ݵ� 1�� �����ڼ� 
			$this->_monthdayof=35-($this->_dayofweek)-($this->_days);//��������·ݵ�ʣ��Ŀհ����� 
			if($this->_monthdayof<0)
				$this->_monthdayof+=7; 
		} 
		/** 
		* �������ͱ�ͷ��Ϣ 
		*/ 
		protected function _showTitle() { 
		$this->_table="
		<center>
		  <div style=\"width:890px;padding:5px;border:1px  solid; color=\"#ddf0f2\";text-align:center\">
			<div style=\"padding:5px;border:1px  dotted; color=\"#ddf0f2\"\"><span style=\"color:blue\">��ǰ�·��ǣ�</span> <font color=#FF0000><b>$this->_currentDate</b></font>
			  <center>
			  <h3><a href='?y=".($this->_year)."&m=".($this->_month-1)."'>��һ��</a> "; 
		       $this->_table.="<a href='?y=".($this->_year)."&m=".($this->_month+1)."'>��һ��</a>
			   </h3>
			  </center>
			</div>
		  </div>
		</center>";
		$this->_table.="
		<table width=\"900\" cellspacing=\"1\" bgcolor=\"#FF3366\" align=\"center\">
		  <tr align=\"center\">
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>������</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>����һ</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>���ڶ�</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>������</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>������</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>������</b></td>
			<td width=\"80\" height=\"50\" valign=\"middle\" bgcolor=\"#FFFFFF\"><b>������</b></td>
		  </tr>
		 
		  <tr height=\"70\" align=\"center\">"; 
		}
		  /** 
		  * ���������Ϣ 
		  * ���ݵ�ǰ�������������Ϣ 
		  */ 
		  protected function _showDate() {
		   
		  $nums=$this->_dayofweek+1; 
		  for ($i=1;$i<=$this->_dayofweek;$i++){//���1��֮ǰ�Ŀհ����� 
		  $this->_table.="
		  <td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#FFFFFF\"><font color=#000000></font><br>
		  <font  face=\"����\" color=green></font>
		   </td>
			"; 
			} 
			for ($i=1;$i<=$this->_days;$i++)
			{//���������Ϣ
				$y=$this->_year;
				$m=$this->_month;
				if(!is_numeric($y)||!is_numeric($m))//�Ƿ��ַ��ж�
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
					/*	if($arr[$j]['url']=='')//�����Ƿ�Ϊ�գ��ǿ���ת����
							$info_i.="
							<div>
							  <div><span style=\"color:red\"><center>".$arr[$j]['time']."</center></span></div>"."
							   <div>
								<center>
								 <a data-toggle=\"tooltip\" title=\"����鿴����\" style=\"color:black\" href=newinfo.php?infoid=".$arr[$j]['id']."><font size=1px>".$arr[$j]['name']."</font></a>
								 </center>
								<div>
							  </div>";
						else*/
							$info_i.="
							<div>
								<div><span style=\"color:red\"><center>".$arr[$j]['time']."</center></span></div>"."
								<div>
								 <center>
									<a data-toggle=\"tooltip\" title=\"����鿴����\" style=\"color:black\" href=newinfo.php?infoid=".$arr[$j]['id']."#top target=\"_blank\"><font size=1>".$arr[$j]['name']."</font></a>
								  </center>
								<div>
							</div>";
					}
					
				}
				else
				{
					$info_i="<div><center><span style=\"color:grey\">$i</span></center></div>";
				}
				
				if ($nums%7==0)//��ǰʱ��$this->_year / $this->_month /  $this->_day 
				{//���д���7��һ�� 
					if($this->_day==$i)
					$this->_table.="
					<td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#fcfdd5\"><font color=#000000>$info_i</font><br>
					<font  face=\"����\" color=green></font>
					</td>
					</tr>"; 
					else
					$this->_table.="
					<td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#ebfdee\"><font color=#000000>$info_i</font><br>
					<font  face=\"����\" color=green></font>
					</td>
					</tr>"; 
				}
				else
				{ 
					if($this->_day==$i)
					$this->_table.="
					<td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#fcfdd5\"><font color=#000000>$info_i</font><br>
					<font  face=\"����\" color=green></font>
					</td>"; 
					else
					$this->_table.="
					<td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#ebfdee\"><font color=#000000>$info_i</font><br>
					<font  face=\"����\" color=green></font>
					</td>"; 
				} 
				$nums++; 
			}
		  for ($i=1;$i<=$this->_monthdayof;$i++){//��������·ݵ�ʣ��Ŀհ����� 
		  $this->_table.="
		  <td width=\"80\" height=\"80\" valign=\"middle\" bgcolor=\"#FFFFFF\"><font color=#000000></font><br>
		  <font  face=\"����\" color=green></font>
		  </td>
			"; 
			} 
			$this->_table.="
		</table>
		"; 
	} 
	/** 
	* ������� 
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