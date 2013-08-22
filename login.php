<?php
    ob_start();
	session_start();
	require "Conn/conn.php";
	if($_POST['submit']=='Login')
	{
		$sql="select * from logins where username='".$_POST['username']."' and password='".$_POST['pwd']."' ";
		$result=mysql_query($sql);
		$numrows=mysql_num_rows($result);
		if($numrows==1)
		{
			$row=mysql_fetch_assoc($result);
			session_register("USERNAME");
			session_register("USERID");	
			
			$_SESSION['USERNAME']=$row['username'];
			$_SESSION['USERID']=$row['id'];
			header("Location:".$config_basedir."deal.php?deal=4"); //到 deal.php 中进行处理 处理号 4  登陆成功
		}
		else
			header("Location:".$config_basedir."/login.php?error=1");
	}
	else
	{
		if($_GET['error'])
		{
			echo "<script language='javascript'>alert('用户名或密码错误!!');</script>";
			header("Location:".$config_basedir."deal.php?deal=5"); //到 deal.php 中进行处理 处理号 5  登陆失败
		}
	}
?>
<?php
	require "header.php";
?>
<form action="" method="post">
<table>
	<tr>
	<td>Username</td>
    <td><input name="username" type="text" /></td>
    </tr>
    <td>Password</td>
    <td><input name="pwd" type="password" /></td>
    <tr>
    <td></td>
    <td><input name="submit" type="submit" value="Login" /></td>
</table>    
</form>
<?php	
	require "footer.php";
?>