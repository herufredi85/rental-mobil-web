<?php
//session_start();

$length = 6; // Panjang captcha
$captcha = generateCaptcha($length);

$_SESSION['captcha'] = $captcha; // Simpan captcha dalam session

header("Content-type: image/png");
$font = 5; // Ukuran font
$width = 100;
$height = 50;

$image = imagecreate($width, $height);
$background = imagecolorallocate($image, 255, 255, 255); // Background putih
$textColor = imagecolorallocate($image, 0, 0, 0); // Warna teks hitam

imagestring($image, $font, 15, 10, $captcha, $textColor);

imagepng($image);
imagedestroy($image);

function generateCaptcha($length)
{
    $characters = '123456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $captcha = '';

    for ($i = 0; $i < $length; $i++) {
        $captcha .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $captcha;
}
?>
