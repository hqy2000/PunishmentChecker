<?php 

 $conn = mysql_connect("DATABASENAME","USERNAME","PASSWORD") or die("数据库链接错误".mysql_error());
 mysql_select_db("u942192644_wp",$conn) or die("数据库访问错误".mysql_error());
 mysql_query("set names utf-8");
?>