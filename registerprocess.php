<?php
error_reporting(0);
require_once("connect.php");
$name=$_REQUEST['name'];
$pass=$_REQUEST['pass'];
$cpass=$_REQUEST['cpass'];
$email=$_REQUEST['email'];
if($email=='')
{
echo 'email address should not be blank';
exit;
}
if(strcmp($pass,$cpass)!=0)
{
echo 'Both passwords dont match';
exit;
}
//check for the existance of this email address
$result=mysql_query("SELECT * FROM `users` WHERE `email`='$email'");
$noofrows=mysql_num_rows($result);
if($noofrows>0)
{
echo 'User already exist with the given email address, use forgotten password block to retrieve the password if you have forgot it';
exit;
}
//if number of users count is zero, then insert into db and send for authentication.
$salt=md5(base64_encode($name.'|'.$pass.'|'.$email));
$hashpass=md5($pass);
mysql_query("INSERT INTO `users` (`name`,`email`,`password`,`funds`,`verified`,`salt`) VALUES ('$name','$email','$hashpass','0','0','$salt')");
$url='authorize.php?email='.$email.'&code='.$salt;

/*send email*/
$acturl="http://localhost/xampp/snapheap/authorize.php?email=".$email."&code=".$salt;
$to=base64_encode($email);
$toname=base64_encode($name);
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

echo 'An verification email is sent to you, authorize it to login<br/>';
echo '<a href="login.php">Click here to login</a>';
//echo '<a href="'.$url.'">Authorize me</a>';//need to remove this and add the email block for actual email based authorization
?>