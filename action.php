<?php
ob_start();
session_start();
include "include/header.php";
include "include/userget.php";
echo "<head>";
header_send();
echo "</head>";



if($_GET['action']=="login")
{
	//登录
	if(!isset($_POST['submit'])){exit('非法访问!');}
	$username = htmlspecialchars($_POST['username']);
	$password = MD5($_POST['password']);

	//包含数据库连接文件
	include('include/conn.php');
	//检测用户名及密码是否正确
	$check_query = mysql_query("select user_id from homework_user where user_loginname='$username' and user_password='$password' limit 1");
	if($result = mysql_fetch_array($check_query)){
		//登录成功
		$_SESSION['user_id'] = $result['user_id'];
		Header("HTTP/1.1 303 See Other"); 
		Header("Location: index.php"); 
		exit;
	} else {
		Header("HTTP/1.1 303 See Other"); 
		Header("Location: login.php?state=CheckUsernameAndPasswordError"); 
	}
}

if($_GET['action']=="changepassword")
{
	if(!isset($_POST['submit'])){exit('非法访问!');}
	if(empty($_SESSION['user_id'])){exit('非法访问!');}
	$user_id=$_SESSION['user_id'];
	$password_old = MD5($_POST['password_old']);
	$password_new = MD5($_POST['password_new']);
	$password_again = MD5($_POST['password_again']);
	if($password_again!=$password_new)
	{
		Header("HTTP/1.1 303 See Other"); 
		Header("Location: index.php?state=PasswordNotTheSame");
		exit;
	}
	
	if($password_old==$password_new)
	{
		Header("HTTP/1.1 303 See Other"); 
		Header("Location: index.php?state=PasswordOldNewTheSame");
		exit;
	}
	
	$score = 0;
	$str=$_POST['password_new'];
    if(preg_match("/[0-9]+/",$str))
		$score ++; 
    if(preg_match("/[a-z]+/",$str))
        $score ++; 
    if(preg_match("/[A-Z]+/",$str))
        $score ++; 
    if(strlen($str) >= 8 && strlen($str) <= 20)
        $score = $score+5; 
	if($score<=6)
	{
		Header("HTTP/1.1 303 See Other"); 
		Header("Location: index.php?state=PasswordNotProper");
		exit;
	}
	//包含数据库连接文件
	include('include/conn.php');
	//检测用户名及密码是否正确
	$check_query = mysql_query("select user_id from homework_user where user_id='$user_id' and user_password='$password_old' limit 1");
	if($result = mysql_fetch_array($check_query)){
		if(mysql_query("update homework_user set user_password = '$password_new' , PasswordChanged = '1' where user_id = '$user_id'"))
		{
			Header("HTTP/1.1 303 See Other"); 
			Header("Location: index.php?state=Sucessful");
			exit;
		}
		else
		{
			Header("HTTP/1.1 303 See Other"); 
			Header("Location: index.php?state=UpateFailed");
			exit;
		}
	}
	else
	{
		Header("HTTP/1.1 303 See Other"); 
		Header("Location: index.php?state=OldPasswordNotCorrect");
	}
	exit;
}

if($_GET['action']=="logout")
{
	if(empty($_SESSION['user_id']))
		exit('非法访问!');
	$_SESSION['user_id'] = ""; 
	Header("Location: login.php?state==Logout");
	Header("HTTP/1.1 303 See Other"); 
}	

if($_GET['action']=="putweiji")
{
	if(!isset($_POST['submit'])){exit('非法访问!');}
	if(empty($_SESSION['user_id'])){exit('非法访问!');}
	$numbers_original=$_POST['numbers'];
	$details=$_POST['details'];
	$count_weiji=$_POST['count_weiji'];
	$count_score=$_POST['count_score'];
	$time=$_POST['time'];
	$subject=$_POST['subject'];
	$count=1;
	$leng=strlen($numbers_original);
	$date=date('Y-m-d H:i:s',time());
	$operator=$_SESSION['user_id'];
	$message="";
	echo "len:$leng,count:$count";
	while($leng+1>=$count*3)
	{
		$temp_number=substr($numbers_original,3*$count-3,2);
		echo $sql;
		if (mysql_query($sql))
		{
			echo "$messgae 对 $temp_number 操作成功！</br>";
		}
		else
		{
			echo "对 $temp_number 操作失败！</br>";
		}
		$count++;
	}
	sleep(2);
	Header("Location: putweiji.php");
	Header("HTTP/1.1 303 See Other"); 
	

}
	
?>