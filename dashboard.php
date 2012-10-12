<?php
include('lock.php');
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
<!--upload block-->
		  <div id="file-uploader-demo1">		
		<noscript>			
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
		</noscript>         
	</div>
	<input type="hidden" id="uname" name="uname" value="<?php echo $globaluserid; ?>" />
	<div class="qq-upload-extra-drop-area">Drop files here to upload</div>
    
    <script src="fileuploader.js" type="text/javascript"></script>
    <script>        
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader-demo1'),
                action: 'incoming.php',
                debug: false,
				multiple: true,
				maxConnections: 3,
				uploadButtonText: "Select Or Drop images", 
				allowedExtensions: ["JPG","JPEG","gif","png","tif","tiff"],
				failedUploadTextDisplay: {
					mode: 'custom',
					maxChars: 400,
					responseProperty: 'error',
					enableTooltip: true
				},
				params: {uname:document.getElementById('uname').value},
                extraDropzones: [qq.getByClass(document, 'qq-upload-extra-drop-area')[0]]
            });           
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script>    
		  <!--end of upload block-->
<hr/>
<p>&copy; SnapHeap 2012</p>
</td>
<td valign="top">
<h3><i>Your images</i></h3>
<!--images table-->
<?php
$result=mysql_query("SELECT * FROM `imagelist` WHERE `ownerid`='$globaluserid'");
$noofrows=mysql_num_rows($result);
if($noofrows>0)
{
echo '<table border="1">';
echo '<tr>';
$count=0;
while($row=mysql_fetch_array($result))
{
if($count%8==0)
echo '</tr><tr>';
echo '<td>';
if($row['width']>$row['height'])
{
//if width is more then add crop bottom class
echo '<p class="crop crop-bottom"><a href="viewentity.php?id='.$row['id'].'" alt="Image Tooltip" rel="tooltip" content="<iframe src=\'http://localhost/xampp/snapheap/viewimage.php?id='.$row['id'].'\' width=\''.($row['width']+10).'px\' height=\''.($row['height']+10).'px\' frameborder=\'0\' scrolling=\'0\'></iframe>"><img src="thumb.php?id='.$row['id'].'" alt="SNAPHEAP ID:'.$row['id'].'"/></a></p>';
}
else
{
//if height is more then add crop right class
echo '<p class="crop crop-right"><a href="viewentity.php?id='.$row['id'].'" alt="Image Tooltip" rel="tooltip" content="<iframe src=\'http://localhost/xampp/snapheap/viewimage.php?id='.$row['id'].'\' width=\''.($row['width']+10).'px\' height=\''.($row['height']+10).'px\' frameborder=\'0\' scrolling=\'0\'></iframe>"><img src="thumb.php?id='.$row['id'].'" alt="SNAPHEAP ID:'.$row['id'].'"/></a></p>';
}
echo '&nbsp;<br/><p><a href="add_desc.php?id='.$row['id'].'">Add_Description</a></p>';
echo '</td>';
$count++;
}
echo '</tr>';
echo '</table>';
}
?>
<!--end of images table-->
</td>
</tr>
</table>
</body>
</html>