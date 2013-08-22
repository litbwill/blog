<?php
    ob_start();
	require "Conn/conn.php";
	require "header.php"; 
	require "session.php";

	$sql="select * from tag";
	$result=mysql_query($sql);
	echo "<hr><b>分类：&nbsp;&nbsp</b>";
	while($cat=mysql_fetch_assoc($result))
	{
		echo "<a href='view_cat.php?id=".$cat['tid']."'>".$cat['tname']."</a>&nbsp;&nbsp ";	
	}
	echo "<hr>";
	
	echo "<table bgcolor='#999' style='width:100%'>";
	echo "<tr>";
	echo "<td>";
	echo "搜索结果<br/>";
	if(isset($_GET['userName'])==true)
	{
			$cat_user_name=$_GET['userName'];
	}	
	$sql="select a.*, t.*, u.*, uar.reprint_time from article a, tag t, user u, article_tag_relation atr, user_article_relation uar 
		where a.aid = atr.aid and t.tid = atr.tid and u.uid = uar.uid and a.aid = uar.aid and u.uname like '%".$cat_user_name."%'
		order by uar.reprint_time desc limit 8";
	$result=mysql_query($sql);
	echo "<table>";
	while ($row=mysql_fetch_assoc($result))
	{
		echo "<tr>";
		echo "<td><a href='view_entries.php?id=".$row['aid']."'>".$row['title']."</a><br/>属于分类：<a href='view_cat.php?id=".$row['tid']."'>".$row['tname']."</a>&nbsp;&nbsp;发布时间：".$row['reprint_time']."&nbsp;&nbsp;发布者".$row['uname']."</td>";	
		//echo "<br/>";
		//echo "<td></td>";		
		echo "</tr>";
	}
	echo "</table>";
	echo "</td>";
	/*echo "<td>";
	$sql="SELECT*  FROM leavemessage order by dateposted desc";
	$result=mysql_query($sql);
	echo "<table border='1'>";
	echo "<tr><td>留言人</td><td>内容</td><td>时间</td><td>IP</td></tr>";
	while ($row=mysql_fetch_assoc($result))
	{
		echo "<tr>";
		if ($row['user']==0)
			echo "<td>游客</td>";
		else 
			echo "<td>".$row['user']."</td>";
		echo "<td>".$row['message']."</td>";
		echo "<td><i>Posted on ".$row['dateposted']."</i></td>";
		echo "<td>".$row['ip']."</td>";		
		echo "</tr>";
	}
	echo "</table>";
	echo "</td>";*/
	echo "</table>";
	
	require "footer.php";
?>