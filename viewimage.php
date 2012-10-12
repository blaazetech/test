<?php
error_reporting(0);
require_once("connect.php");
$id=$_REQUEST['id'];
if(!isset($id)||$id=='')
{
echo 'dont joke there is no such id available on our server';
exit;
}
/*get the file name of this id*/
$result=mysql_query("SELECT * FROM `imagelist` WHERE `id`='$id'");
$noofrows=mysql_num_rows($result);
if($noofrows==1)
{
$row=mysql_fetch_array($result);
$width=$row['width'];
$height=$row['height'];
}
/*end of getting file name from db*/
if($width>$height)
$cls_string='crop-bottom';
else
$cls_string='crop-right';
?>
<html>
<head>
<title>SnapHeap</title>
<link href="fileuploader.css" rel="stylesheet" type="text/css">	
<link href="snapheap.css" rel="stylesheet" type="text/css">	
</head>
<body>
<?php
echo '<span class="crop '.$cls_string.'"><img src="view.php?id='.$row['id'].'" alt="SNAPHEAP ID:'.$row['id'].'"/></span>';
?></body>
</html>
