<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include "include/header.php";
check_login();
header_send();
?>
<script language=JavaScript>
<!--

function InputCheck(LoginForm)
{
  if (LoginForm.password_old.value == "")
  {
    alert("请输入旧密码!");
    LoginForm.password_old.focus();
    return (false);
  }
  if (LoginForm.password_new.value == "")
  {
    alert("请输入新密码!");
    LoginForm.password_new.focus();
    return (false);
  }
  if (LoginForm.password_again.value == "")
  {
    alert("请输入重复密码!");
    LoginForm.password_again.focus();
    return (false);
  }
  if (LoginForm.password_new.value != LoginForm.password_again.value)
  {
    alert("两次输入的密码不一致!");
    LoginForm.password_new.focus();
    return (false);
  }
}

//-->
</script>
<title>作业查询系统</title>
</head>
<body>
<p>This is a boring thing...</p>
<embed height="452" width="544" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" src="http://share.acg.tv/flash.swf" flashvars="aid=2129461&page=1" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>
<!-- 用户信息 -->

<fieldset><legend>用户信息</legend>
<p>
<?php
	include "include/conn.php";
	$id=$_SESSION['user_id'];
	include "include/userget.php";
	$name=GetUserByUserID($id);
	echo "欢迎您，$name!";
	if (GetUserLevelByUserID($id)>0)
	{
		echo "<a href=putweiji.php>登记违纪</a>  ";
	}
?>
<a href="action.php?action=logout">退出</a></p>
<fieldset><legend>修改密码</legend>
<?php
	switch($_GET["state"])
	{
		case "":
		{
			break;
		}
		case "PasswordNotTheSame":
		{
			echo "<br>两次输入的密码不一致！</br>";
			break;
		}
		case "PasswordNotProper":
		{
			echo "<br>密码不符合要求！</br>";
			break;
		}
		case "PasswordOldNewTheSame":
		{
			echo "<br>密码新旧一致！</br>";
			break;
		}
		case "Sucessful":
		{
			echo "<br>密码修改成功！</br>";
			break;
		}
		case "Failed":
		{
			echo "<br>代码执行失败23333</br>";
			break;
		}
		case "OldPasswordNotCorrect":
		{
			echo "<br>旧密码不正确！</br>";
			break;
		}
		default:
		{
			echo "<br>什么鬼。。。</br>";
			break;
		}
		
	}
?>
<form name="LoginForm" method="post" action="action.php?action=changepassword" onSubmit="return InputCheck(this)">
<p>
<label for="password_old" class="label">原密码:</label>
<input id="password_old" name="password_old" type="password" class="input" />
<p/>
<p>
<label for="password_new" class="label">新密码:</label>
<input id="password_new" name="password_new" type="password" class="input" />
<p/>
<p>
<label for="password_again" class="label">重复密码:</label>
<input id="password_again" name="password_again" type="password" class="input" />
<p/>
<p>
<input type="submit" name="submit" value="  确 定  " class="left" />
</p>
</form>
</fieldset>
</fieldset>
<?php
	$user_id=$_SESSION['user_id'];
	$check_query = mysql_query("select PasswordChanged from homework_user where user_id='$user_id' limit 1");
	if($result = mysql_fetch_array($check_query)){

		if($result[PasswordChanged]=='0')
		 
		{echo "<p>请先修改密码后再使用！</p>";
		exit;}
	}
?>
<!-- 违纪内容 -->

<fieldset><legend>英语作业情况查询</legend>
<p>
<table border=1>
<tr><td>序号</td><td>日期</td><td>详细信息</td><td>平时分计数</td><td>违纪计数</td><td>操作人</td><td>操作日期</td>
<?php
	$subject_id=0;//0为英语A班
	$id=$_SESSION['user_id'];
	$check_query = mysql_query("select * from homework_count where user_id=$id and subject_id=$subject_id order by date desc");
	$count=0;
	$count_score=0;
	$count_weiji=0;
	while($result = mysql_fetch_array($check_query,MYSQL_ASSOC) or false){	
		$count++;
		$o_date=$result['date'];
		$o_details=$result['details'];
		$o_weiji=$result['count_weiji'];
		$count_weiji=$count_weiji+$o_weiji;
		$o_score=$result['count_score'];
		$count_score=$count_score+$o_score;
		$o_odate=$result['operate_date'];
		$o_operator=GetUserByUserID($result['operator_id']);
		echo "<tr><td>$count</td><td>$o_date</td><td>$o_details</td><td>$o_score</td><td>$o_weiji</td><td>$o_operator</td><td>$o_date</td></tr>";
		 
	}
	echo "</table><br/>违纪计数：$count_weiji 平时分计数：$count_score ";
	
?>
</p>

</body>