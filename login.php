<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include "include/header.php";
header_send();
?>
<title>用户登录</title>
<style type="text/css">
    html{font-size:12px;}
    fieldset{width:520px; margin: 0 auto;}
    legend{font-weight:bold; font-size:14px;}
    label{float:left; width:70px; margin-left:10px;}
    .left{margin-left:80px;}
    .input{width:150px;}
    span{color: #666666;}
</style>
<script language=JavaScript>
<!--

function InputCheck(LoginForm)
{
  if (LoginForm.username.value == "")
  {
    alert("请输入用户名!");
    LoginForm.username.focus();
    return (false);
  }
  if (LoginForm.password.value == "")
  {
    alert("请输入密码!");
    LoginForm.password.focus();
    return (false);
  }
}

//-->
</script>
</head>
<body>
<div>
<fieldset>
<legend>用户登录</legend>
<form name="LoginForm" method="post" action="action.php?action=login" onSubmit="return InputCheck(this)">
<?php
	if (!empty($_GET["state"]))
	{
		echo "<p>";
		if ($_GET["state"]=="CheckUsernameAndPasswordError")
			echo "用户名或密码错误！";
		if ($_GET["state"]=="NotLogin")
			echo "请先登录！";
		if ($_GET["state"]=="Logout")
			echo "您已退出！";
		echo "</p>";
	}
?>
<p>
<label for="username" class="label">用户名:</label>
<input id="username" name="username" type="text" class="input" />
<p/>
<p>
<label for="password" class="label">密 码:</label>
<input id="password" name="password" type="password" class="input" />
<p/>
<p>
<input type="submit" name="submit" value="  确 定  " class="left" />
</p>
</form>
</fieldset>
</div>
</body>
</html>