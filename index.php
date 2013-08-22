<?php
    ob_start();
	require "Conn/conn.php";
	require "header.php"; 
	require "session.php";

	$sql="select * from categories";
	$result=mysql_query($sql);
	echo "<hr>";
	while($cat=mysql_fetch_assoc($result))
	{
		echo "<a href='view_cat.php?id=".$cat['id']."'>".$cat['cat']."</a>     ||    ";	
	}
	echo "<hr>";
	
	echo "<table bgcolor='#ABED8B' >";
	echo "<tr>";
	echo "<td>";
	echo "<i> >>最近更新<< </i><br/>";
	$sql="select entries.*,categories.cat from entries,categories where entries.cat_id=categories.id 
order by entries.dateposted desc limit 8";
	$result=mysql_query($sql);
	echo "<table>";
	while ($row=mysql_fetch_assoc($result))
	{
		echo "<tr>";
		echo "<td><a href='view_entries.php?id=".$row['id']."'>".$row['subject']."</a></td>";
		echo "<td><i>In <a href='view_cat.php?id=".$row['cat_id']."'>".$row['cat']."</a> - Posted on ".$row['dateposted']."</i></td>";		
		echo "</tr>";
	}
	echo "</table>";
	echo "</td>";
	echo "<td>";
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
	echo "</td>";
	echo "</table>";
	
	require "footer.php";
?>