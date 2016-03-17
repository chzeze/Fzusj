<?php
	session_start();
	if(!isset($_SESSION['username'])||!isset($_SESSION['password']))
	{
		echo "<script>window.location.href='login.php';</script>";
		exit();
	}
	$admin=$_SESSION['username'];
?>
<?php
	session_start();
	session_destroy();
	echo "<script>window.location.href='login.php'</script>";
?>