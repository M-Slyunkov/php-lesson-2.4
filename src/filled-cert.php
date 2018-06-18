<?php
include __DIR__ . '/CertText.php';

$width = getimagesize(__DIR__ . '/blank-cert.png')[0];
$height = getimagesize(__DIR__ . '/blank-cert.png')[1];

$image = imagecreatetruecolor($width, $height);
$im = imagecreatefrompng(__DIR__ . '/blank-cert.png');

$textColor = imagecolorallocate($im, 0, 0, 0);
$nameX = ($width / 2) - $fontSize * mb_strlen($name) / 5;
$correctX = ($width / 2) - $fontSize * mb_strlen($correctString) / 7.5;
$wrongX = ($width / 2) - $fontSize * mb_strlen($wrongString) / 7.5;

imagecopy($image, $im, 0, 0, 0, 0, $width, $height);


imagettftext($im, $fontSize + 10, 0, $nameX, 190, $textColor, './andantino.ttf', $name);
imagettftext($im, $fontSize, 0, $correctX, 290, $textColor, './andantino.ttf', $correctString);
imagettftext($im, $fontSize, 0, $wrongX, 390, $textColor, './andantino.ttf', $wrongString);

header('Content-type: image/png');
imagepng($im);
imagedestroy($image);
imagedestroy($im);
