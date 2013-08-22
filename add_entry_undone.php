<?php 
    ob_start();
	require "header.php"; 
	require "session.php";

	if ($_POST['submit']=="提交")
	{
		if($_SESSION['USERNAME']=='')
			echo "<script language='javascript'> alert('您当前的身份是游客,无法创建新文章!');</script>";
		else 
		{
			mysql_query("start transaction");
			$ip=$_SERVER["REMOTE_ADDR"];
			$sql=mysql_query("insert into article (cat_id,user,user_ip,dateposted,subject,body) 
				values(".$_POST['category_id'].",".$_SESSION['USERID'].",'".$ip."',NOW(),'".$_POST['subject']."','".$_POST['body']."')");
			if(!$sql)
			{
				mysql_query("rollback");
				echo "<script language='javascript'>alert('创建失败！请重试')</script>";	
			}	
			else
			{
				mysql_query("commit");
				$s="Location:".$config_basedir."deal.php?deal=2";  //到deal.php中处理 处理号为 2
				header($s);
			}
			
		}
		  $errorcount=0;
  if (!trim($_POST['nickname'])) {
      echo "<br /><b>Nickname</b> is required.";
     $errorcount++;
  }
  
  if (!trim($_POST['title'])) {
      echo "<br /><b>Title</b> is required.";
     $errorcount++;
  }
  
  if ($errors > 0)
      echo "<br /><br />Please use your browser's back button " .
        "to return to the form, and correct error(s)"
	}
?>
<form action="" method="post">
<table>
	<tr>
    	<td>Type</td>
        <td>
        	<select name="tname">
            	<?php 
					$sql="select * from tag";
					$result=mysql_query($sql);
						while ($row=mysql_fetch_assoc($result)){
							echo "<option value='".$row['tid']."'>".$row['tname']."</option>";		
						}
				?>
       	    </select>
      </td>
    </tr>
	<tr>
    	<td>Title</td>
        <td><input name="subject" type="text" value="" maxlength="50"></td>
    </tr>
    <tr>
    	<td>Content</td>
        <td><textarea name="body" cols="100" rows="40"></textarea></td>
    </tr>
    <tr>
    	<td></td>
        <td><input name="submit" type="submit" value="Submit">
        </td>
    </tr>
</table>
</form>
<?php
	require "footer.php";
	?>
