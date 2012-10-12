<?php
include('lock.php');

$msgpass='';
if(isset($_REQUEST['msgpass']))
$msgpass=$_REQUEST['msgpass'];

$result=mysql_query("SELECT * FROM `users` WHERE `email`='$login_session'");
$noofrows=mysql_num_rows($result);
if($noofrows==1)
{
$row=mysql_fetch_array($result);
$code=$row['salt'];
$currentpassword=$row['password'];
}
mysql_free_result($result);
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
Welcome <?php echo $login_session; ?> | <a href="dashboard.php">Dashboard</a> | <a href="settings.php">Settings</a> | <a href="logout.php">Logout</a>
</td>
</tr>
</table>
</div>
<hr/>
<?php echo $msgpass.'<br/>'; ?>
<h3><i>Change password</i></h3>
<form action="resetpass.php" method="post">
<input type="hidden" id="code" name="code" value="<?php echo $code; ?>" />
Current Password:<input type="password" id="otp" name="otp" value="" /><br/>
<input type="hidden" id="email" name="email" value="<?php echo $login_session; ?>" />
New password:<input type="password" id="pass" name="pass" /><br/>
Confirm password:<input type="password" id="cpass" name="cpass" /><br/>
<input type="submit" value="Reset password" />
</form>
<hr/>
</body>
</html>