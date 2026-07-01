<?
include_once("includes/config.php");
#http://www.homeforexchange.com/thumb.php?imageName=69_75_20050923143858.jpg&action=gd
if(@$_REQUEST[action]=="gd")
{
##gd
	/*
		Function createimage($name,$filename,$makeimg,$new_w,$new_h,$backrgb,$border,$borderrgb, $fromlocation, $tolocation)
		creates a resized image
		variables:
		$name		Original filename
		$filename	Filename of the resized image
		$makeimg	type of image to be generated (jpg|png|gif)
		$new_w		width of resized image
		$new_h		height of resized image
		$backrgb	html color "3399cc" of background
		$borderrgb	html color "3366ff" of border 
		$border		boolean value of border (1|0) 1 pixel rectangle around image
		$fromlocation	 where to pick the image
		$tolocation	where to create a thumbnail
	*/	
$name=$_REQUEST['imageName'];
$filename=$_REQUEST['imageName'];

$makeimg=substr($_REQUEST['imageName'], -3);
$new_w=$_REQUEST['new_w'];
$new_h=$_REQUEST['new_h'];
$backrgb="ffffff";
$border="ff0000";
$borderrgb=false;
//$fromlocation=DR_IMAGES_PROD_BASE_ROOT;
//$fromlocation=$_REQUEST['location'];
$fromlocation=WEBROOT_DEPOSITORY.$_REQUEST['location'];
$tolocation="";



	# get HTML colors and convert them to RGB
		$r =  hexdec(substr($backrgb, 0, 2)); 
		$g =  hexdec(substr($backrgb, 2, 2)); 
		$b =  hexdec(substr($backrgb, 4, 2)); 
		$br = hexdec(substr($borderrgb, 0, 2)); 
		$bg = hexdec(substr($borderrgb, 2, 2)); 
		$bb = hexdec(substr($borderrgb, 4, 2)); 

	# get file extension of source image file and read it accordingly
		$system=explode(".",$name);
		if ($system[1] == "jpeg" or $system[1] == "jpg" or $system[1] == "JPEG" or $system[1] == "JPG" or $system[1] == "JPE" or $system[1] == "pjpeg"){$src_img=imagecreatefromjpeg($fromlocation.$name);}
		if ($system[1] == "gif" or $system[1] == "GIF"){$src_img=imagecreatefromgif($fromlocation.$name);}
		if ($system[1] == "png" or $system[1] == "PNG"){$src_img=imagecreatefrompng($fromlocation.$name);}
	# get dimensions of old image
		$old_x=imagesx($src_img);
		$old_y=imageSY($src_img);
		
		#added by Nand
		
		//obtain the original image Height and Width 
		$srcWidth = ImageSX( $src_img ); 
		$srcHeight = ImageSY( $src_img ); 
		// the follwing portion of code checks to see if 
		// the width > height or if width < height 
		// if so it adjust accordingly to make sure the image 
		// stays smaller then the $newWidth and $newHeight 
		$newWidth=$new_w;
		$newHeight=$new_h;
		$ratioWidth = $srcWidth/$newWidth;
		$ratioHeight = $srcHeight/$newHeight;
		if( $ratioWidth < $ratioHeight){ 
		$thumb_w = $srcWidth/$ratioHeight;
		$thumb_h = $newHeight; 
		}else{ 
		$thumb_w = $newWidth; 
		$thumb_h = $srcHeight/$ratioWidth;
		}			

	# create new image
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	# allocate colors for background and border
		$bg=ImageColorAllocate($dst_img,$r,$g,$b);
		$borcol=ImageColorAllocate($dst_img,$br,$bg,$bb);
	# initialise margins for resized image
		$margin_x=0;
		$margin_y=0;
	# fill image with background color
		imagefill($dst_img,0,0,$bg);		
		

	# resize source image and place the copy in the destination image
		imagecopyresampled($dst_img,$src_img,$margin_x,$margin_y,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	# if there is a border set, draw a rectangle around the thumbnail
		if ($border==1){imageRectangle($dst_img,0,0,$new_w-1,$new_h-1,$borcol);}
	# get file name, add tn_ and create thumbnail according to $makeimg
		$system=explode(".",$name);
		if ($makeimg=="jpg"){
			$filename=$system[0].".jpg";
			imagejpeg($dst_img); 
			}
		if ($makeimg=="gif"){
			$filename=$system[0].".gif";
			imagegif($dst_img); 
			}
		if ($makeimg=="png"){
			$filename=$system[0].".png";
			imagepng($dst_img); 
			}
	# destroy both image objects (to save memory)
		imagedestroy($dst_img); 
		imagedestroy($src_img); 
	# initialise name
		$name="";
}
else if($_REQUEST[action]=="imagemagick")
{
	#Image magick
	$file=$_REQUEST['imageName'];
	$filetype = explode('.', $file);
	$new_w=$_REQUEST['new_w'];
	$new_h=$_REQUEST['new_h'];
	#$options = "-resize 300x300";
	$options = "-resize ".$new_w."x".$new_h;
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-Type: ".($filetype[1] == 'gif' ? 'image/gif' :'image/jpeg'));
	$fp = popen("convert $options ".DR_BASE_UPLOAD_IMG_BIG.$file." ".($filetype[1] == 'gif' ? 'gif' : 'jpg').":-", 'r');
	fpassthru($fp);

}

?>