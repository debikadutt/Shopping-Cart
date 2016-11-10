<?php
session_start();
$conn = mysql_connect("localhost","root","");
if ($conn)
{
	mysql_select_db("shoppingcart",$conn) or die(mysql_error());
}
else
{
	die(mysql_error());
}
?>