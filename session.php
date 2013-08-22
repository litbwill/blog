<style type="text/css">
#userInfo{
	width: 100%;
	background-color: gray;
	text-align: right;
}
</style>
<div id="userInfo">
<?php
	session_start();
	require "Conn/conn.php";
	if(isset($_SESSION['USERNAME']) == TRUE)
	{
		echo "当前用户:".$_SESSION['USERNAME']."  <a href='logout.php'>注销</a>";
		echo "  操作： <a href='my_space.php'>我的空间</a>";
	}
	else 
	{
		/*!!!!!!!!!!!!!!!!!!游客也可登陆!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
		echo "当前身份: 游客 <a href='login.php'>登陆</a>|<a href='reg.php'>注册</a>"; 
		/*!!!!!!!!!!!!!!!!!!禁止游客登陆!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
		/*
		echo "<script language='javascript'>alert('您还没有登陆,请登陆!'); </script>";	
		echo "<script language='javascript'>window.location.href ='login.php';</script>";
		*/
		/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
		
		/*
		echo "您还没有登陆,请登录...5 秒后将跳转至登陆页面!";
		echo "<META HTTP-EQUIV=Refresh CONTENT='5; URL=login.php'>;";
		*/ //另一种做法
		//header("Location:".$config_basedir."/login.php");  header 前命令不执行
	}
	echo " <a href='add_entry.php'>发布新博客</a>&nbsp;&nbsp;";
   ?>
  </div>