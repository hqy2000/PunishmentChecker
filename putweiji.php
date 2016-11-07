<?php ob_start();?>
<head>
<?php
session_start();
include "include/header.php";
include "include/userget.php";
include "include/conn.php";
check_login();
if (GetUserLevelByUserID($_SESSION['user_id'])<1)
{
	exit("</head><body>无权访问！</body>");
}
header_send();
?>
</head>
<body>
<p>请用支持HTML5的浏览器浏览本页！
<form action="action.php?action=putweiji" method="post">
  <p>学号：<input type="text" name="numbers" id="numbers" />（多个以空格分隔，如01 02 03，保留2个有效数字，不带小数点） </p>
  <p>具体内容: <input type="text" name="details" id="details" /></p>
  <p>平时分计次：<input type="text" name="count_score" />扣分保留负号，加分可不打符号</p>
  <p>违纪计次：<input type="text" name="count_weiji" />违纪保留负号，表扬保留正号，【不打也可以】</p>
  <p>违纪日期：<input type="date" name="time" /></p>
  <p>学科：<select name="subject"><option value="0">英语</option></p>
  <p><input type="submit" name= "submit" value="确认提交（请仔细检查，提交完成后无法修改！）" /></p>
</form> 
</body>