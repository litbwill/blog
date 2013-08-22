<?php
  /**
   * 注册页
   */
 ?>
<?php
    ob_start();
	session_start();
	require "Conn/conn.php";
	require "header.php";
	if($_POST['submit']=='Reg')
	{
		$time = date('Y-m-d H:i:s',time());
		$sql="insert into user (uname,password,email,create_time) values('".$_POST['username']."','".$_POST['pwd']."','".$_POST[email]."','".$time."')";
		$result=mysql_query($sql);
		if($result)
		{
			header("Location:".$config_basedir."deal.php?deal=7"); //到 deal.php 中进行处理 处理号 4  登陆成功
		}
	}
?>
<form action="" method="post" onSubmit="return chkinput_login(this)">
<table>
	<tr>
	<td>用户名</td>
    <td><input name="username" type="text" /></td>
    </tr>
    <tr>
    <td>密码</td>
    <td><input name="pwd" type="password" /></td>
    <tr>
    <td>确认密码</td>
    <td><input name="pwd2" type=""/></td>
    </tr>
    <tr>
    <td>EMAIL</td>
    <td><input name="email" type="text" /></td>
    </tr>
    <td><input name="submit" type="submit" value="Reg" /></td>
</table>    
</form>
<script language="javascript">
function chkinput_login(form){ //断用户是否输入了用户名
    
   if(form.username.value==""){
         alert("请输入用户名！");  //如果没输入用户名，则弹出一个提示框提示未输入用户名
         form.usernc.focus();      //重新使用户昵称输入框获取焦点
         return(false);
     }
    if(form.pwd.value==""){
        alert("请输入注册密码！");
	    form.userpwd1.focus();
	    return(false);
     }
     
     if(form.pwd2.value==""){
       alert("请输入确认密码！");
       form.userpwd2.focus();
       return(false);
     }
    if(form.pwd.value!=form.pwd2.value){  //判断密码与确认密码是否相同
       alert("注册密码于确认密码不同！");
	    form.pwd.focus();
	    return(false);
     }
     if(form.pwd.value.length<6){     //判断密码长度是否大于或等于6位
        alert("注册密码应大于6位！");
	    form.userpwd1.focus();
	    return(false);
     }
     if(form.email.value==""){
       alert("请输入E-mail地址！");
       form.email.focus();
    return(false);
     }
     
     if(form.email.value.match(/^(.+)@(.+)$/)==null){             //判断邮件地址的格式是否正确
       alert("请输入正确的E-mail地址！");
       form.email.focus();
       return(false);
     }
  
      return(true); //如果满足上述条件，则返回True值，并提交表单
    }
</script>

<?php	
	require "footer.php";
?>