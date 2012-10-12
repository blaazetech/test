<?php
error_reporting(0);
require_once("connect.php");
$code=$_REQUEST['code'];
$currentpassword=$_REQUEST['otp'];
$email=$_REQUEST['email'];
$pass=$_REQUEST['pass'];
$cpass=$_REQUEST['cpass'];

if(strcmp($pass,$cpass)!=0)
{
header('Location: reset.php?email='.$email.'&code='.strrev($code).'&msg=Your new passwords dont match.');
exit;
}

/*change password*/
$hash=md5($pass);
mysql_query("UPDATE `users` SET `password`='$hash' WHERE `email`='$email' AND `password`='$currentpassword'");
session_start();
if(session_destroy())
{
header('Location: login.php?msg=Password reset successful, you can now login.');
}
/*end of change password*/
?>