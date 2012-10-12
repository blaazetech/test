<?php
error_reporting(0);
$msg='';
if(isset($_REQUEST['msg']))
$msg=$_REQUEST['msg'];

if(isset($_REQUEST['email'])&&$_REQUEST['email']!='')
{
require_once("connect.php");
$email=$_REQUEST['email'];
$result=mysql_query("SELECT * FROM `users` WHERE `email`='$email'");
$noofrows=mysql_num_rows($result);
if($noofrows!=1)
{
header('Location: forgot.php?msg=No such email exists, check your email address once again.');
exit;
}
$row=mysql_fetch_array($result);
/*send email*/
$acturl="http://localhost/xampp/snapheap/reset.php?email=".$row['email']."&code=".strrev($row['salt']);
$to=base64_encode($row['email']);
$toname=base64_encode($row['name']);
$subject=base64_encode("SnapHeap | Your password reset link");
$body=base64_encode("<h3><i>Welcome to Snapheap</i></h3><br/>Here is the password reset link to your account on snapheap.<br/><a href=\"".$acturl."\">".$acturl."</a><hr/>&copy; SnapHeap 2012");

$url="http://localhost/xampp/phpmailer/examples/snapheapmailer.php";
$fields = array(
            'to' => urlencode($to),
            'toname' => urlencode($toname),
            'subject' => urlencode($subject),
            'body' => urlencode($body)
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
$result = curl_exec($ch);
//echo $result;
//close connection
curl_close($ch);
/*end of sending email*/
header('Location: forgot.php?msg=Password reset mail been sent, check your email for the same.');
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
<h3><i>Forgot password</i></h3>
<form action="" method="post">
Email address:<input type="text" id="email" name="email" /><br/>
<input type="submit" value="Reset password" />
</form>
</body>
</html>