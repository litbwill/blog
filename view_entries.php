<?php
    ob_start();
	require "Conn/config.php";
	
	if(isset($_GET['aid'])==true)
	{
		if(is_numeric($_GET['aid'])==false)	
		{
			$error=1;
			header("Location:".$config_error."?error=".$error);
		}
		else
			$entries_id=$_GET['aid'];	
	}
	else
		$entries_id=-1;
?>  
<script type="text/javascript">
	//doucument.getElementById(edit).style.display=none;
	function check(){
		if($_SESSION['USERNAME']== '<?php echo $row[uname];?>')
		{
			 alert('edit');
		}
	}
</script>
<?php
	require "Conn/conn.php";
	require "header.php";
	require "session.php";
	if($entries_id==-1)
		$sql="select a.*, t.*, u.*, uar.reprint_time from article a, tag t, user u, article_tag_relation atr, user_article_relation uar where a.aid = atr.aid and t.tid = atr.tid and u.uid = uar.uid and a.aid = uar.aid order by uar.reprint_time DESC limit 1;";	
	else
		$sql="select a.*, t.*, u.*, uar.reprint_time from article a, tag t, user u, article_tag_relation atr, user_article_relation uar where  a.aid=".$entries_id." and a.aid = atr.aid and t.tid = atr.tid and u.uid = uar.uid and a.aid = uar.aid ;";	
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	
	echo "<hr/>";
	echo "<b>当前位置: ".$row['tname']."</b>---->".$row['title']."<hr/>";
	echo "Title :".$row['title']."<br/>";
	echo "内容: <br/>";
	?>
	<textarea id="content" rows="10" cols="50" readonly="readonly"><?php echo $row['content']?></textarea>
	<br/>

	<input id="edit" type="button" value="编辑" onclick="check()"/>
	<input id="sub" type="button" disabled="true" value="提交" />
	<?php
	echo "<i>In <a href='view_cat.php?id=".$row['tid']."'>".$row['tname']."</a> - Posted on ".date("D jS F Y g.iA",strtotime($row['reprint_time']))."</i><hr/><hr/>";
	
	/*$sql_comment="select logins.*,comments.* from comments,logins  where logins.id=comments.user and comments.blog_id=".$row['id']." order by dateposted DESC;";
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
	}*/
?>

<?php 
	//require "add_comment.php"; //添加评论 
?>
<?php
	require "footer.php";
?>