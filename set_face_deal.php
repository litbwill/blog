<?php
    ob_start();
	include "Conn/conn.php";
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=refresh content='1;url=my_space.php'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传成功</title>
</head>

<body>
<?php
	if($_POST['submit']=='上传')
	{
		global $error;
		if(($_FILES["file"]["error"] >0 ))
			$error=1;
		else if (!($_FILES["file"]["type"]=='image/jpeg'))
			$error=2;
		else
		{
			$file=$_SESSION['USERNAME'].".jpg";
	 		move_uploaded_file($_FILES["file"]["tmp_name"],"images/face/".$file);
			
			mysql_query("start transaction");
			$sql=mysql_query("update logins set face='".$file."' where id=".$_SESSION['USERID']."");
			if(!$sql)
			{
				mysql_query("rollback");
				$error=4;
			}	
			else
			{
				mysql_query("commit");
			}
		}
	}
	
?>
<center>
<div style="padding:15px 60px;border:1px solid #c7e1ef;background:#F3FCFF ; text-align:center; margin:20% auto auto; width:55%">
	<a href="<?php echo $config_basedir ;?>"><?php echo $config_blogname; ?></a> &raquo; 提示信息<br />
    <?php 
		if ($error==1)
			echo "[上传头像遇到错误]<br/>";
		else if($error==4)
			echo "[上传头像插入数据库失败]<br/>";
		else if($error==2)
			echo "[上传头像类型不匹配]<br/>";
		else
			echo "[上传头像成功]<br/>";
		echo "<a href='".$config_basedir."/my_space.php')>
			[如果您的浏览器没有自动跳转,请点击这里 ]</a><br />";
	?>
</div>
</center>
</body>
</html>
