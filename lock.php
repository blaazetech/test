<?php
require_once("connect.php");
session_start();
$user_check=$_SESSION['login_user'];

$ses_sql=mysql_query("select * from users where email='$user_check' ");

$row=mysql_fetch_array($ses_sql);

$login_session=$row['email'];
$globaluserid=$row['id'];
$globalusername=$row['name'];

if(!isset($login_session))
{
header("Location: login.php");
}
?>