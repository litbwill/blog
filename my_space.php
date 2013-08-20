<?php
	require "Conn/conn.php";
	require "header.php";
	require "session.php";
?> 
<?php 
	echo "<br/><b>My Space</b>";
	if(isset($_SESSION['USERNAME']) == TRUE)
	{	
		$sql="select * from logins  where id=".$_SESSION['USERID']." ";	
		$result=mysql_query($sql);
		$user_face=mysql_fetch_assoc($result);
		echo "<img height='60px' width='60px' src='images/face/".$user_face['face']."'>";
		echo " ||  [<a href='my_space.php?id=1'>发布新博客</a>]";
		echo " ||  [<a href='my_space.php?id=2'>更换头像</a>]";
?>
	<table>
		<tr>
			<td>
				<?php 
					if($_GET['id']==1)
						require "add_entry.php";
					if($_GET['id']==2)
						require "set_face.php";
				?>		
			</td>
			<td>
				<table>
				<?php 
				$sql="select * from entries  where user=".$_SESSION['USERID']." order by dateposted DESC";	
				$result=mysql_query($sql);
				$num_row_entries=mysql_num_rows($result);
				?>
				<tr>
    			<td>最近发表的贴子:</td>
        		<td><?php 
						if($num_row_entries>0 ) 
							echo "共有 ".$num_row_entries." 个帖子"; 
						else
							echo "尚未发帖!";
					?>       
               	</td>
    			</tr>
                <?php 
					while($entry=mysql_fetch_assoc($result))
					{
						echo "<tr>";
							echo "<td><a href='view_entries.php?id=".$entry['id']."'>".$entry['subject']."</a></td>";
							echo "<td>".$entry['dateposted']."</td>";
						echo "</tr>";	
					}
				?>
    
</table>
</td>
</tr>
</table>
<?php
			
	}
	else 
	{	
		echo "<script language='javascript'>alert('您还没有登陆,登陆后可发表博文!'); history.go(-1); </script>";	
		//后退返回之前页面
	}
?>

<?php
	require "footer.php";
?>