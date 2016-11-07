<?php
function check_login()
{
	session_start();
	if (empty($_SESSION['user_id']))
	{
		Header("HTTP/1.1 303 See Other"); 
		Header("Location: login.php?state=NotLogin"); 
		return false;
	}
	else
	{
		return true;
	}
}

function header_send()
{
	echo "<meta http-equiv='Content-Type' content='text/html' charset='utf-8'/>";
}