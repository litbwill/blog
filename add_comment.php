<hr/>
<i>给出你的看法吧!</i>
<?php 
	if ($_POST['submit']=="提交")
	{
		if($_SESSION['USERNAME']=='')
			echo "<script language='javascript'> alert('您当前的身份是游客,无法回复!');</script>";
		else 
		{
			mysql_query("start transaction");
			$ip=$_SERVER["REMOTE_ADDR"];
			$sql=mysql_query("insert into comments(blog_id,user,user_ip,dateposted,name,comment) 
				values(".$entries_id.",".$_SESSION['USERID'].",'".$ip."',NOW(),'".$_POST['name']."','".$_POST['comment']."')");
			if(!$sql)
			{
				mysql_query("rollback");
				echo "<script language='javascript'>alert('插入失败！事务被取消！')</script>";	
			}	
			else
			{
				mysql_query("commit");
				$s="Location:".$config_basedir."deal.php?deal=3&id=".$entries_id;  //到deal.php中处理 处理号为 3
				header($s);
			}
			
		}
	}
?>
<form action="" method="post">
<table>
	<tr>
    	<td>评论标题</td>
        <td><input name="name" type="text" value="<?php echo "RE:".$row['subject'];?>" maxlength="50"></td>
    </tr>
    <tr>
    	<td>评论内容</td>
        <td><textarea name="comment" cols="50" rows="10"></textarea></td>
    </tr>
    <tr>
    	<td></td>
        <td><input name="submit" type="submit" value="提交">
        </td>
    </tr>
</table>
</form>
