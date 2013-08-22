<?php
    ob_start();
	session_start();
	//require "session.php";
	session_destroy();//销毁会话
	require "header.php";
	echo "<hr>已注销用户!<hr>";
	echo "<a href='login.php'>登陆</a>";
	require "footer.php";
?>