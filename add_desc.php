<?php
//this is a comment
include('lock.php');
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
$filename=$row['filename'];
}
/*end of getting file name from db*/
?>
<html>
<head>
<title>SnapHeap</title>
<link href="fileuploader.css" rel="stylesheet" type="text/css">	
<link href="snapheap.css" rel="stylesheet" type="text/css">	
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="snapheap.js"></script>
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
<?php
/*
This is where the uploader goes and other important tools come into picture
*/
?>
<table width="100%" border="1">
<tr>
<td width="20%" valign="top">
<!--search block-->
search block
<!--end of search block-->
<hr/>
<!--categories block-->
category block
<!--end of categories block-->
<hr/>
<p>&copy; SnapHeap 2012</p>
</td>
<td valign="top">
<h3><i>Your image</i></h3>
<!--images table-->
<?php
//echo file_get_contents('http://localhost/xampp/snapheap/viewimage.php?id='.$id);
echo '<iframe src=\'http://localhost/xampp/snapheap/viewimage.php?id='.$row['id'].'\' width=\''.($row['width']+10).'px\' height=\''.($row['height']+10).'px\' frameborder=\'0\' scrolling=\'0\'></iframe>';
$path_parts=pathinfo($filename);
?>
<hr/>
<table border="1">
<tr>
<td>Image dimensions:&nbsp;&nbsp;&nbsp;</td><td><?php echo $width; ?>x<?php echo $height; ?> px </td>
</tr>
<tr>
<td>File type:&nbsp;&nbsp;&nbsp;</td><td><?php echo $path_parts['extension']; ?></td>
</tr>
<tr>
<td>Uploaded by:&nbsp;&nbsp;&nbsp;</td><td><?php echo strtoupper($globalusername); ?></td>
</tr>
<tr>
<td>Keywords:&nbsp;&nbsp;&nbsp;</td><td><?php echo '<i>show keywords</i>'; ?></td>
</tr>
<tr>
<td>Price:&nbsp;&nbsp;&nbsp;</td><td><?php echo '<i>show price</i>'; ?></td>
</tr>
<tr>
<td>View count:&nbsp;&nbsp;&nbsp;</td><td><?php echo '<i>show view counts</i>'; ?></td>
</tr>
</table>
<!--end of images table-->
</td>
</tr>
</table>
</body>
</html>