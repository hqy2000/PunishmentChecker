<?php
include "conn.php";
function GetUserByUserID($user_id)
{
	$check_query = mysql_query("select user_realname from homework_user where user_id=$user_id limit 1");
	$result = mysql_fetch_array($check_query,MYSQL_ASSOC);
	return $result[user_realname];
}

function GetUserLevelByUserID($user_id)
{
	$check_query = mysql_query("select user_level from homework_user where user_id=$user_id limit 1");
	$result = mysql_fetch_array($check_query,MYSQL_ASSOC);
	return $result[user_level];
}