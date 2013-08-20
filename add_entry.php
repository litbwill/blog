<?php 
	if ($_POST['submit']=="提交")
	{
		if($_SESSION['USERNAME']=='')
			echo "<script language='javascript'> alert('您当前的身份是游客,无法回复!');</script>";
		else 
		{
			mysql_query("start transaction");
			$ip=$_SERVER["REMOTE_ADDR"];
			$sql=mysql_query("insert into entries (cat_id,user,user_ip,dateposted,subject,body) 
				values(".$_POST['category_id'].",".$_SESSION['USERID'].",'".$ip."',NOW(),'".$_POST['subject']."','".$_POST['body']."')");
			if(!$sql)
			{
				mysql_query("rollback");
				echo "<script language='javascript'>alert('插入失败！事务被取消！')</script>";	
			}	
			else
			{
				mysql_query("commit");
				$s="Location:".$config_basedir."deal.php?deal=2";  //到deal.php中处理 处理号为 2
				header($s);
			}
			
		}
	}
?>
<form action="" method="post">
<table>
	<tr>
    	<td>类别</td>
        <td>
        	<select name="category_id">
            	<?php 
					$sql="select * from categories";
					$result=mysql_query($sql);
						while ($row=mysql_fetch_assoc($result)){
							echo "<option value='".$row['id']."'>".$row['cat']."</option>";		
						}
				?>
       	    </select>
      </td>
    </tr>
	<tr>
    	<td>帖子标题</td>
        <td><input name="subject" type="text" value="" maxlength="50"></td>
    </tr>
    <tr>
    	<td>帖子内容</td>
        <td><textarea name="body" cols="50" rows="10"></textarea></td>
    </tr>
    <tr>
    	<td></td>
        <td><input name="submit" type="submit" value="提交">
        </td>
    </tr>
</table>
</form>