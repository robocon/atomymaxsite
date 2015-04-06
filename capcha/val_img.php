<?php
session_start();

$string = '';
for ($i = 0; $i < 5; $i++) {
    $string .= chr(rand(97, 122));
}

$_SESSION['captcha'] = $string; //store the captcha

$dir = '../fonts/';
$image = imagecreatetruecolor(165, 50); //custom image size
$font = "PlAGuEdEaTH.ttf"; // custom font style
$color = imagecolorallocate($image, 153, 153, 153); // custom color
$white = imagecolorallocate($image, 44, 42, 42); // custom background color
imagefilledrectangle($image,0,0,399,99,$white);
imagettftext ($image, 50, 4, 25, 40, $color, "font/angsab.ttf", $_SESSION['captcha']);
header("Content-type: image/png");
imagepng($image);