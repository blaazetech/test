<?php
error_reporting(0);
require_once("connect.php");
$code=$_REQUEST['code'];
$currentpassword=md5($_REQUEST['otp']);
$email=$_REQUEST['email'];
$pass=$_REQUEST['pass'];
$cpass=$_REQUEST['cpass'];

if(strcmp($pass,$cpass)!=0)
{
header('Location: settings.php?msgpass=Your new passwords dont match.');
exit;
}

/*change password*/
$hash=md5($pass);
mysql_query("UPDATE `users` SET `password`='$hash' WHERE `email`='$email' AND `password`='$currentpassword'");
session_start();
if(session_destroy())
{
header('Location: login.php?msg=Password changed successfully, you can now login.');
}
/*end of change password*/
?>