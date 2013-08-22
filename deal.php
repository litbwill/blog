<?php
	ob_start();
	require "Conn/config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	switch($_GET['deal']){
		case 2:  //插入新帖子
			echo "<meta http-equiv=refresh content='1;url=my_space.php'>";	
			break;
		case 3:  //插入新评论
			 $entries_id=$_GET['id'];
			echo "<meta http-equiv=refresh content='1;url=view_entries.php?id=".$entries_id."'>";	
			break;
		case 4:  //登陆成功
			break;
		case 5:   //登陆失败
			break;
		case 6:
			echo "<meta http-equiv=refresh content='1;url=index.php'>";	
			break;
		case 7:
			echo "<meta http-equiv=refresh content='1;url=index.php'>";	
			break;
	}
	
?>
  <!-- 隔 5 S 后自动转向 --->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提交成功</title>
</head>
<body>
<center>
<div style="padding:15px 60px;border:1px solid #c7e1ef;background:#F3FCFF ; text-align:center; margin:20% auto auto; width:55%">
	<a href="<?php echo $config_basedir ;?>"><?php echo $config_blogname; ?></a> &raquo; 提示信息<br />
    <?php 
		switch($_GET['deal']){
		case 2:  //插入新帖子
			echo "[发帖成功]<br/>";
			echo "<a href='".$config_basedir."my_space.php')>
				[如果您的浏览器没有自动跳转,请点击这里 ]</a><br />";
			break;
		case 3:  //插入新评论
			echo "[回复完毕]<br/>";
			echo "<a href='".$config_basedir."view_entries.php?id=".$entries_id."  ')>
				[如果您的浏览器没有自动跳转,请点击这里 ]</a><br />";
			break;
		case 4:  //登陆成功
			header("Location:".$config_basedir."index.php");
			break;
		case 5:   //登陆失败
			header("Location:".$config_basedir."login.php");
			break;
		case 6:
			echo "[感谢您的留言！]<br/>";
			echo "<a href='index.php')>
				[如果您的浏览器没有自动跳转,请点击这里 ]</a><br />";
		case 7:
		    echo "[感谢您的注册！]<br/>";
			echo "<a href='index.php')>
				[如果您的浏览器没有自动跳转,请点击这里 ]</a><br />";
	}	
	?>
</div>
</center>

</html>
<!---->
<html>