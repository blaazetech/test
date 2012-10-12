<?php
require_once("connect.php");
$email=$_REQUEST['email'];
$code=$_REQUEST['code'];
$result=mysql_query("SELECT * FROM `users` WHERE `email`='$email'");
$noofrows=mysql_num_rows($result);
if($noofrows!=1)
{
echo 'Failed to authorize, contact site admin at support[at]snapheap.com';
exit;
}
$row=mysql_fetch_row($result);
if($row[5]==0&&$row[6]==$code)
{
mysql_query("UPDATE `users` SET `verified`='1' WHERE `id`='".$row[0]."'");
header('Location: login.php?msg=Authorized successfully, now you can login.');
}
else if($row[5]==1&&$row[6]==$code)
{
header('Location: login.php?msg=You have already authorized, just login.');
}
?>