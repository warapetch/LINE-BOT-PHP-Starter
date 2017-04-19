<?php
$host = "203.157.118.72";
$user = "line";
$pass = "sa";
$db="lineapi";

$con = mysql_connect($host,$user,$pass) or die(mysql_error());
mysql_select_db($db)or die(mysql_error());
?>
