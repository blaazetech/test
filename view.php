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
$filename=$row['filename'];
}
/*end of getting file name from db*/
$localimageurl="c:/xampp/htdocs/xampp/snapheap/uploads/".$filename;
$size = getimagesize($localimageurl);
if($size[0]>$size[1])
{
//need to add the text in bottom and horizontal
$watermark = new Imagick();
$watermark->readImage("c:/xampp/htdocs/xampp/snapheap/watermark.png");
$imagetemp = new IMagick($localimageurl);
$image = new Imagick();
//$image->readImage($localimageurl);
$image->newImage($imagetemp->getImageWidth(), $imagetemp->getImageHeight(), new ImagickPixel("white"));
$image->compositeImage($imagetemp, imagick::COMPOSITE_OVER, 0, 0);
//$image->adaptiveResizeImage(100,0);
/*apply diagonal lines*/
    $draw = new ImagickDraw();
    $draw->setStrokeColor( new ImagickPixel( 'lightgray' ) );
    $draw->line  ( 0,0,$imagetemp->getImageWidth(),$imagetemp->getImageHeight() );
    $draw->line  ( $imagetemp->getImageWidth(),0,0,$imagetemp->getImageHeight() );
    $image->drawImage( $draw );
/*end of applying diagonal lines*/
/*applying watermark*/
// how big are the images?
$iWidth = $image->getImageWidth();
$iHeight = $image->getImageHeight();
$wWidth = $watermark->getImageWidth();
$wHeight = $watermark->getImageHeight();

if ($iHeight < $wHeight || $iWidth < $wWidth) {
    // resize the watermark
    $watermark->scaleImage($iWidth, $iHeight);

    // get new size
    $wWidth = $watermark->getImageWidth();
    $wHeight = $watermark->getImageHeight();
}

// calculate the position
$x = ($iWidth - $wWidth) / 2;
$y = ($iHeight - $wHeight) / 2;

$image->compositeImage($watermark, imagick::COMPOSITE_OVER, $x, $y);
/*end of applying watermark*/
header("Content-Type: image/" . $imagetemp->getImageFormat());
//echo $image;
//horizontal and bottom strip
// Create some objects
//$image = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'white' );

//* New image 
$image->newImage($imagetemp->getImageWidth(), 12, $pixel);

//* Black text 
$draw->setFillColor('black');

//* Font properties 
$draw->setFont('DroidSans-Bold.ttf');
$draw->setFontSize( 9 );

//* Create text 
$image->annotateImage($draw, 0, 8, 0, 'SnapHeap:'.$id);

//* Give image a format 
$image->setImageFormat('png');

//* Output the image with headers
//header('Content-type: image/png');
//echo $image;
$image->resetIterator();
$combined = $image->appendImages(true);

/* Output the image */
$combined->setImageFormat("png");
//header("Content-Type: image/png");
echo $combined;

}
else
{
//need to add the text in right and vertical
$watermark = new Imagick();
$watermark->readImage("c:/xampp/htdocs/xampp/snapheap/watermark.png");
$imagetemp = new IMagick($localimageurl);
$image = new Imagick();
//$image->readImage($localimageurl);
$image->newImage($imagetemp->getImageWidth(), $imagetemp->getImageHeight(), new ImagickPixel("white"));
$image->compositeImage($imagetemp, imagick::COMPOSITE_OVER, 0, 0);
//$image->adaptiveResizeImage(0,100);
/*apply diagonal lines*/
    $draw = new ImagickDraw();
    $draw->setStrokeColor( new ImagickPixel( 'lightgray' ) );
    $draw->line  ( 0,0,$imagetemp->getImageWidth(),$imagetemp->getImageHeight() );
    $draw->line  ( $imagetemp->getImageWidth(),0,0,$imagetemp->getImageHeight() );
    $image->drawImage( $draw );
/*end of applying diagonal lines*/
/*applying watermark*/
// how big are the images?
$iWidth = $image->getImageWidth();
$iHeight = $image->getImageHeight();
$wWidth = $watermark->getImageWidth();
$wHeight = $watermark->getImageHeight();

if ($iHeight < $wHeight || $iWidth < $wWidth) {
    // resize the watermark
    $watermark->scaleImage($iWidth, $iHeight);

    // get new size
    $wWidth = $watermark->getImageWidth();
    $wHeight = $watermark->getImageHeight();
}

// calculate the position
$x = ($iWidth - $wWidth) / 2;
$y = ($iHeight - $wHeight) / 2;

$image->compositeImage($watermark, imagick::COMPOSITE_OVER, $x, $y);
/*end of applying watermark*/
header("Content-Type: image/" . $imagetemp->getImageFormat());
//echo $image;
//vertical and right strip
// Create some objects
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'white' );

//* New image 
$image->newImage(12, $imagetemp->getImageHeight(), $pixel);

//* Black text 
$draw->setFillColor('black');

//* Font properties 
$draw->setFont('DroidSans-Bold.ttf');
$draw->setFontSize( 9 );

//* Create text 
$image->annotateImage($draw, 10, $imagetemp->getImageHeight()-1, -90, 'SnapHeap:'.$id);

//* Give image a format 
$image->setImageFormat('png');

//* Output the image with headers
//header('Content-type: image/png');
//echo $image;
$image->resetIterator();
$combined = $image->appendImages(false);

/* Output the image */
$combined->setImageFormat("png");
//header("Content-Type: image/png");
echo $combined;

}
?>