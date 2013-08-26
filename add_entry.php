<?php 
    ob_start();
    require "Conn/conn.php";
	require "header.php"; 
	require "session.php";

	if ($_POST['submit']=="提交")
	{
		if($_SESSION['USERNAME']=='')
			echo "<script language='javascript'> alert('您当前的身份是游客,无法创建新文章!');</script>";
		else 
		{
			$time=date('Y-m-d H:i:s',time());
			$sql="insert into article (content,title,create_time)
				values('".$_POST['content']."','".$_POST['title']."','".$time."')";
            @mysql_query($sql);
            $sql1="select aid from article where create_time='".$time."'";
            $result=@mysql_query($sql1);
            $id=mysql_fetch_assoc($result);
            $aid=$id['aid'];
            $sql2="insert into article_tag_relation (aid,tid)
				    values(".intval($aid).",".intval($_POST['tid']).")";
			      @mysql_query($sql2);
            $reprinted=1;
			      $sql3="insert into user_article_relation (uid,aid,reprinted,reprint_time) values(".$_SESSION['USERID'].",".$aid.",".$reprinted.",now())";
			@mysql_query($sql3);
			if(mysql_error())
			{
				echo "<script language='javascript'>alert(".mysql_error()."</script>";	
			}	
			else
			{
				$s="Location:".$config_basedir."deal.php?deal=2";  //到deal.php中处理 处理号为 2
				header($s);
			}
			
		}
	}
/*
  以下内容可用来做校验参考
 
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
        "to return to the form, and correct error(s)";
	}
	*/
?>
<form action="" method="post">
<table>
	<tr>
    	<td>Type</td>
        <td>
        	<select name="tid">
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
        <td><input name="title" type="text" value="" maxlength="50"></td>
    </tr>
    <tr>
    	<td>Content</td>
        <td><textarea name="content" cols="100" rows="40"></textarea></td>
    </tr>
    <tr>
    	<td></td>
        <td><input name="submit" type="submit" value="提交">
        </td>
    </tr>
</table>
</form>
<?php
	require "footer.php";
	?>
