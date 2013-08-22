<?php
    ob_start();
	require "header.php";
	require "session.php";
	switch($_GET['error'])
	{
		case 1:
			echo "<b>对不起,您访问的文章不存在!</b>";	
			break;
		case 2:
			echo "<b>对不起,您访问的类别不存在!</b>";
			break;
		default:
			echo "<b>对不起,您浏览的网页出现未知错误!</b>";
			break;
	}
	require "footer.php";
?>