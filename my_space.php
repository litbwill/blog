<?php
    ob_start();
	require "Conn/conn.php";
	require "header.php";
	require "session.php";
?> 
<style type="text/css">
 
      #itemlist{
      	text-align: center;
      }	
      #list{
      	padding-left: 20px;
      	vertical-align: 50px;
      }
  
</style> 

<?php
    /**
     * 分类
     */
    $sql="select * from tag";
	$result=mysql_query($sql);
	echo "<hr>";
	while($cat=mysql_fetch_assoc($result))
	{
		echo "<a href='view_cat.php?tid=".$cat['tid']."&user=use'>".$cat['tname']."</a>     ||    ";	
	}
	echo "<hr>";
?>


<div id="itemList">
<br/><b>我的博客</b>
<?php 
    /**
     * 文章列表页
     */
	if(isset($_SESSION['USERNAME']) == TRUE)
	{	
?>
<br/>
<tr>
  <td>最近发表的贴子:</td>
</tr>
<table id="list">
    <tr>
      <td width="100px"></td>
      <td width="100px"></td>
      <td width="100px"></td>
      <td width="100px"></td>
    </tr>
	<?php 
	$sql="select a.*, t.*, u.*, uar.reprint_time, uar.reprinted from article a, tag t, user u, article_tag_relation atr, user_article_relation uar where a.aid = atr.aid and t.tid = atr.tid and u.uid = uar.uid and a.aid = uar.aid and u.uid=".$_SESSION['USERID'];
	$result=mysql_query($sql);
	$num_row_entries=mysql_num_rows($result);
	?>
    <?php 
		while($row=mysql_fetch_assoc($result))
		{
			echo "<tr>";
				echo "<td><a href='view_entries.php?id=".$row['aid']."'>".$row['title']."</a></td>";
				echo "<td>分类: ".$row['tag']." - 发表日期： ".$row['time']."</i></td>";	
			echo "</tr>";	
		}
	?> 
</table>
<?php
			
}
	else 
	{	
		echo "<script language='javascript'>alert('您还没有登陆,登陆后可发表博文!'); history.go(-1); </script>";	
		//后退返回之前页面
	}
?>
</div>
<?php
	require "footer.php";
?>