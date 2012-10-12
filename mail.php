<?php
error_reporting(0);
$to=base64_encode("blaazetech@gmail.com");
$toname=base64_encode("Blaaze Maharshi");
$subject=base64_encode("hi this is the subject");
$body=base64_encode("<h3><i>Welcome to Snapheap</i></h3><br/>here is the activation link to your account on snapheap.<hr/>&copy; SnapHeap 2012");

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
echo $result;
//close connection
curl_close($ch);
?>