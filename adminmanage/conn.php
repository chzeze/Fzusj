<?php
	$con=mysql_connect("127.0.0.1","root","zeze123");
	if(!$con)
	{	
		die('Could not connet :'.mysql_error());
	}
	else
	{
		mysql_select_db("app_fzusj",$con);
		mysql_query("set names 'gb2312'");
	}
 ?>