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
<?php
	require "Conn/conn.php";
	require "header.php";
	require "session.php";
?>
<?php
  /**
   * 提交修改
   */
  if ($_POST['submit']=="提交")
	{
		if($_SESSION['USERNAME']=='')
			$user=0;
		else 
			$user=$_SESSION['USERID'];
		mysql_query("start transaction");
		$ip=$_SERVER["REMOTE_ADDR"];
		$sql=mysql_query("update  article set content='".$_POST['content']."' where aid=".intval($_POST['aid']));
		if(!$sql)
		{
			mysql_query("rollback");
			echo "<script language='javascript'>alert('修改失败！事务被取消！')</script>";	
		}	
		else
		{
			mysql_query("commit");
			//$s="Location:".$config_basedir."deal.php?deal=8";  //到deal.php中处理 处理号为 6
			//header($s);
		}
	}

?>
<?php
	if($entries_id==-1)
		$sql="select a.*, t.*, u.*, uar.reprint_time from article a, tag t, user u, article_tag_relation atr, user_article_relation uar where a.aid = atr.aid and t.tid = atr.tid and u.uid = uar.uid and a.aid = uar.aid order by uar.reprint_time DESC limit 1;";	
	else
		$sql="select a.*, t.*, u.*, uar.reprint_time from article a, tag t, user u, article_tag_relation atr, user_article_relation uar where  a.aid=".$entries_id." and a.aid = atr.aid and t.tid = atr.tid and u.uid = uar.uid and a.aid = uar.aid ;";	
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	$c_user=($_SESSION['USERNAME'])?$_SESSION['USERNAME']:$str;
	echo "<hr/>";
	echo "<b>当前位置: ".$row['tname']."</b>---->".$row['title']."<hr/>";
	?>
<form action="" method="post">
	<table>
		<?php
		echo "<tr><td>Title :</td><td>".$row['title']."</tr>";
		echo "<tr><td>内容:</td><td>";
		?>
		<textarea id="text1" rows="10" cols="50" name="content" readonly><?php echo $row['content']?></textarea></td></tr>
		<tr>
			<td><input id="edit" type="button" value="编辑" onclick="check()"></td>
			<td><input id="sub" name="submit" type="hidden"  value="提交" ></td>
			<input type="hidden" name="aid" value='<?php echo $row['aid'] ?>'>
		</tr>
	</table>
</form>
	<?php
	echo "<i>In <a href='view_cat.php?id=".$row['tid']."'>".$row['tname']."</a> - Posted on ".date("D jS F Y g.iA",strtotime($row['reprint_time']))."</i><hr/><hr/>";
?>

<script type="text/javascript">
	
function check() {
   <!--
	var login_name = '<?php echo $_SESSION['USERNAME'] ?>';
	var art_name = '<?php echo $row[uname] ?>';
	-->
		if( login_name == art_name){
			document.getElementById("sub").type="submit";
			document.getElementById("text1").readOnly=false;
		}else{
             alert('无此权限');
		}
	}
</script>
<?php
	require "footer.php";
?>