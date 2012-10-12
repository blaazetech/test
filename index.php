<?php
error_reporting(0);
require_once("connect.php");
session_start();
$user_check=$_SESSION['login_user'];

$ses_sql=mysql_query("select email from users where email='$user_check' ");

$row=mysql_fetch_array($ses_sql);

$login_session=$row['email'];

if(isset($login_session))
{
header("Location: welcome.php");
}
else
{
?>
<html>
<head>
<title>SnapHeap</title>
</head>
<body>
<div>
<table width="100%">
<tr>
<td>
<a href="index.php"><h3><i>SnapHeap</i></h3></a>
</td>
<td align="right">
<a href="login.php">Login</a> | <a href="register.php">Signup</a>
</td>
</tr>
</table>
</div>
<hr/>
<h1><i>Welcome to SnapHeap</i></h1>
</body>
</html>
<?php
}
?>