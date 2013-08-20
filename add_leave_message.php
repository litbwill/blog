<?php
	require "Conn/conn.php";
	require "header.php";
	require "session.php";
?>
<?php 
	if ($_POST['submit']=="提交")
	{
		if($_SESSION['USERNAME']=='')
			$user=0;
		else 
			$user=$_SESSION['USERID'];
		mysql_query("start transaction");
		$ip=$_SERVER["REMOTE_ADDR"];
		$sql=mysql_query("insert into leavemessage(message,user,dateposted,ip) 
			values('".$_POST['message']."',".$user.",NOW(),'".$ip."')");
		if(!$sql)
		{
			mysql_query("rollback");
			echo "<script language='javascript'>alert('插入失败！事务被取消！')</script>";	
		}	
		else
		{
			mysql_query("commit");
			$s="Location:".$config_basedir."deal.php?deal=6";  //到deal.php中处理 处理号为 6
			header($s);
		}
	}
?>
<form action="" method="post">
<table>
    <tr>
    	<td>留言内容</td>
        <td><textarea name="message" cols="50" rows="10"></textarea></td>
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