<?php
require_once("connect.php");
error_reporting(0);
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form 
$myusername=$_POST['email']; 
$mypassword=md5($_POST['pass']); 

$sql="SELECT * FROM users WHERE email='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$verified=$row['verified'];
$count=mysql_num_rows($result);

if($verified=='0')
{
/*send email*/
$acturl="http://localhost/xampp/snapheap/authorize.php?email=".$row['email']."&code=".$row['salt'];
$to=base64_encode($row['email']);
$toname=base64_encode($row['name']);
$subject=base64_encode("SnapHeap | Your account activation link");
$body=base64_encode("<h3><i>Welcome to Snapheap</i></h3><br/>Here is the activation link to your account on snapheap.<br/><a href=\"".$acturl."\">".$acturl."</a><hr/>&copy; SnapHeap 2012");

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
echo 'Your account is not yet activated, an activation email is been sent to your mail, please check it.<br/>';
echo '<a href="login.php">Click here to login</a>';
exit;
}
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1&&$verified=='1')
{
session_register("myusername");
$_SESSION['login_user']=$myusername;

header("location: welcome.php");
}
else 
{
$error="Your email or Password is invalid";
header("location: login.php?msg=".$error);
}
}
?>