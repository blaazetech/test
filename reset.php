<?php
error_reporting(0);
$msg='';
if(isset($_REQUEST['msg']))
$msg=$_REQUEST['msg'];

if(isset($_REQUEST['email'])&&$_REQUEST['email']!=''&&isset($_REQUEST['code'])&&$_REQUEST['code']!='')
{
require_once("connect.php");
$email=$_REQUEST['email'];
$code=$_REQUEST['code'];
$code=strrev($code);
$result=mysql_query("SELECT * FROM `users` WHERE `email`='$email' AND `salt`='$code'");
$noofrows=mysql_num_rows($result);
if($noofrows!=1)
{
header('Location: forgot.php?msg=Your reset link is wrong, check again.');
exit;
}
$row=mysql_fetch_array($result);
$currentpassword=$row['password'];
}
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
<?php echo $msg.'<br/>'; ?>
<h3><i>Password reset</i></h3>
<form action="resetprocess.php" method="post">
<input type="hidden" id="code" name="code" value="<?php echo $code; ?>" />
<input type="hidden" id="otp" name="otp" value="<?php echo $currentpassword; ?>" />
<input type="hidden" id="email" name="email" value="<?php echo $_REQUEST['email']; ?>" />
New password:<input type="password" id="pass" name="pass" /><br/>
Confirm password:<input type="password" id="cpass" name="cpass" /><br/>
<input type="submit" value="Reset password" />
</form>
</body>
</html>