
<!--?php

// Begin the session
session_start();

// If the session is not present, set the variable to an error message
if(!isset($_SESSION['captcha_id']))
	{ $str = 'ERROR!';
// Else if it is present, set the variable to the session contents
}else{
	$str = $_SESSION['captcha_id'];
}

// Set the content type
//header('Content-type: image/png');
header('Cache-control: no-cache');
header('Content-Type: image/png'); 

// Create an image from button.png
$image = imagecreatefrompng('http://dealer.alegriashoes.com/captcha/button.png');

// Set the font colour
$colour = imagecolorallocate($image, 183, 178, 152);

// Set the font
$font = 'http://dealer.alegriashoes.com/captcha/fonts/Anorexia.ttf';

// Set a random integer for the rotation between -15 and 15 degrees
$rotate = rand(-15, 15);

// Create an image using our original image and adding the detail
imagettftext($image, 14, $rotate, 18, 30, $colour, $font, $str);

// Output the image as a png
imagepng($image);


?-->


<!--?php
session_start();

$width  = 128;
$height =  30;
$length =   5;

$baseList = '0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$code    = "";
$counter = 0;

$image = @imagecreate($width, $height) or die('Cannot initialize GD!');

for( $i=0; $i<10; $i++ ) {
   imageline($image, 
         mt_rand(0,$width), mt_rand(0,$height), 
         mt_rand(0,$width), mt_rand(0,$height), 
         imagecolorallocate($image, mt_rand(150,255), 
                                    mt_rand(150,255), 
                                    mt_rand(150,255)));
}

for( $i=0, $x=0; $i<$length; $i++ ) {
   $actChar = substr($baseList, rand(0, strlen($baseList)-1), 1);
   $x += 10 + mt_rand(0,10);
   imagechar($image, mt_rand(3,5), $x, mt_rand(5,10), $actChar, 
      imagecolorallocate($image, mt_rand(0,155), mt_rand(0,155), mt_rand(0,155)));
   $code .= strtolower($actChar);
}
   
header('Content-Type: image/jpeg');
imagejpeg($image);
imagedestroy($image);

$_SESSION['securityCode'] = $code;

?-->
<?php
header("Content-type: image/png");
$im = @imagecreate(110, 20)
    or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 0, 0, 0);
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 1, 5, 5,  "A Simple Text String", $text_color);
imagepng($im);
imagedestroy($im);
?>
 
