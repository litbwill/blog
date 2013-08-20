<?php
	require "Conn/config.php";
	
	if(isset($_GET['id'])==true)
	{
		if(is_numeric($_GET['id'])==false)	
		{
			$error=1;
			header("Location:".$config_error."?error=".$error);
		}
		else
			$entries_id=$_GET['id'];	
	}
	else
		$entries_id=0;
?>  
<?php
	require "Conn/conn.php";
	require "header.php";
	require "session.php";
	if($entries_id==0)
		$sql="select entries.*,categories.cat from entries,categories where entries.cat_id=categories.id order by dateposted DESC limit 1;";	
	else
		$sql="select entries.*,categories.cat from entries,categories where entries.cat_id=categories.id and entries.id=".$entries_id." order by dateposted DESC limit 1;";	
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	
	$sql_1=mysql_query("select categories.* from categories,entries where categories.id=entries.cat_id and entries.id=".$entries_id."");
	$row_1=mysql_fetch_assoc($sql_1);             //获取类别名称
	$sql_2=mysql_query("select logins.*  from logins,entries where logins.id=entries.user and entries.id=".$entries_id."");
	$row_2=mysql_fetch_assoc($sql_2);             //获取博文者名称
	echo "<hr/>";
	echo "<b>当前位置: ".$row_1['cat']."</b>---->".$row['subject']."<hr/>";
	echo "<img  height='80px' width='80px'  src='images/face/".$row_2['face']."'>";
	echo "用户: ".$row_2['username']."<br/>";
	echo "Title :".$row['subject']."<br/>";
	echo "内容: ".$row['body']."<br/>";
	echo "<i>In <a href='view_cat.php?id=".$row['cat_id']."'>".$row['cat']."</a> - Posted on ".date("D jS F Y g.iA",strtotime($row['dateposted']))."</i><hr/><hr/>";
	
	$sql_comment="select logins.*,comments.* from comments,logins  where logins.id=comments.user and comments.blog_id=".$row['id']." order by dateposted DESC;";
	$result_comment=mysql_query($sql_comment);
	$num_comment=mysql_num_rows($result_comment);
	if($num_comment==0)
		echo "<p>No comments.</p>";
	else
	{
		echo "(<strong>".$num_comment."</strong>) comments :<br/>";	
		$i=1;
		while($comment=mysql_fetch_assoc($result_comment))
		{
			echo "<hr/><img  height='60px' width='60px'  src='images/face/".$comment['face']."'>";
			echo "用户: ".$comment['username']."<br/>";
			echo "Title :".$comment['name']."<br/>";	
			echo "评论: ".$comment['comment']."<br/>";
			echo "评论时 IP: ".$comment['user_ip']."<br/>";
			echo "<i>评论时间:".$comment['dateposted']."</i><br/>";
			$i++;
		}
	}
?>

<?php 
	require "add_comment.php"; //添加评论 
?>
<?php
	require "footer.php";
?>