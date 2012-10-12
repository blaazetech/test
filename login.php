<?php
$msg='';
if(isset($_REQUEST['msg']))
$msg=$_REQUEST['msg'];
?><html>
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
<h3>Login</h3>
<form action="loginprocess.php" method="post">
Email:<input type="text" id="email" name="email" /><br/>
Enter password:<input type="password" id="pass" name="pass" /><br/>
<input type="submit" value="Login" />
</form>
<br/>
<a href="forgot.php">Forgot password</a>
</body>
</html>