<?php
	require "Conn/config.php";
	
	if(isset($_GET['id'])==true)
	{
		if(is_numeric($_GET['id'])==false)	
		{
			$error=2;
			header("Location:".$config_error."?error=".$error);
		}
		else
			$cat_id=$_GET['id'];	
	}
	else
		$cat_id=1;
?>  
<?php
	require "Conn/conn.php";
	require "header.php";
	require "session.php";
	$sql="select categories.cat from categories where id=".$cat_id."";
	$result=mysql_query($sql);
	$result=mysql_fetch_assoc($result);
	echo "<hr/><b>当前位置: ".$result['cat']."</b><hr>";
	$sql="select * from entries  where cat_id=".$cat_id." order by dateposted DESC";	
	$result=mysql_query($sql);
	$num_row_entries=mysql_num_rows($result);
	echo "该类别共有 ".$num_row_entries."  个博客:";
	echo "<ul>";
	if($num_row_entries==0)
		echo "<li>No entries!</li>";
	else
	{
		while($entries_row=mysql_fetch_assoc($result))
		{
			echo "<li><a href='view_entries.php?id=".$entries_row['id']."'>".$entries_row['subject']."</a>   <i>时间:".$entries_row['dateposted']."</i></li> ";
		}	
	}
	require "footer.php";
?>