<?php
    ob_start();
	require "Conn/conn.php"; 
	require "header.php";
	require "session.php";

	//显示分类名称
	$sql="select * from tag where tid=".$_GET['tid'];//需要改的接口
	$result=mysql_query($sql);
	echo "<hr>";
	while($cat=mysql_fetch_assoc($result))
	{
		echo $cat['tname'].'>>';
	}
	echo "<hr>";
	
	echo "<table bgcolor='#FFED8B' >";
	echo "<tr>";	
	echo "<td>";
	echo "<br/>";
	
	//显示标题，作者，时间
	$sql="select a.*, t.*, u.*, uar.reprint_time, uar.reprinted from article a, tag t, user u, article_tag_relation atr, user_article_relation uar where a.aid = atr.aid and t.tid = atr.tid and u.uid = uar.uid and a.aid = uar.aid and t.tid=".$_GET['tid'];
	//需要改的接口
	$result=mysql_query($sql);
	echo "<table>";
	while ($row=mysql_fetch_assoc($result))
	{
		echo "<tr>";
		echo "<td><a href='view_entries.php?id=".$row['aid']."'>".$row['title']."</a></td>";//需要修改的地方
		echo "<td>".'author:'.$row['uname']."</td> ";
		echo "<td>".'----'.$row['create_time']."</td>";		
		echo "</tr>";
	}
	echo "</table>";
	echo "</td>";		
	
	echo "</table>";
	echo "<br/>";
	require "footer.php";
?>