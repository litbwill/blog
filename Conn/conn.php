<?php
	require "config.php";
	$db=mysql_connect($dbhost,$dbuser,$dbpassword) or die("数据库连接失败！".mysql_error());
	mysql_select_db($dbdatabase,$db);
	/*
	if(mysql_select_db($dbdatabase,$db))
		echo "<b>Connection Ok!</b>";
	else
		echo "<b>Connection False</b>".mysql_error();
	*/
    mysql_query('set names utf8');
	//echo "<hr/>";
?>