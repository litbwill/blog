<?php
    ob_start();
	session_start();
	require "Conn/conn.php";
	if($_POST['submit']=='Login')
	{
		$sql="select * from user where uname='".$_POST['username']."' and password='".$_POST['pwd']."' ";
		$result=mysql_query($sql);
		$numrows=mysql_num_rows($result);
		if($numrows==1)
		{
			$row=mysql_fetch_assoc($result);
			session_register("USERNAME");
			session_register("USERID");	
			
			$_SESSION['USERNAME']=$row['uname'];
			$_SESSION['USERID']=$row['uid'];
			header("Location:"."deal.php?deal=4"); //到 deal.php 中进行处理 处理号 4  登陆成功
		}
		else
		{
			header("Location:"."login.php?error=1"); // 登陆失败
		}
	}
	else
	{
		switch($_GET['error']){
			case 1: //登录失败
			//header("Location:"."deal.php?deal=5"); //到 deal.php 中进行处理 处理号 5  登陆失败
			echo "<script>alert('用户名或密码错误!!');</script>";
		}
	}
?>
<?php
	require "header.php";
?>
<form action="" method="post">
<table>
	<tr>
	<td>用户名</td>
    <td><input name="username" type="text" /></td>
    </tr>
	<tr>
    <td>密码</td>
    <td><input name="pwd" type="password" /></td>
	</tr>
    <tr>
    <td></td>
    <td><input name="submit" type="submit" value="Login" /></td>
	<td><a href='reg.php')>
				新用户？请先注册</a></td>
	</tr>
</table>    
</form>
<?php	
	require "footer.php";
?>