<?php 
$str = str_split("QWERTYUIIOPASDFGHJKLZXCVBNM");
for($i=0; $i<3; $i++) {
	$word[] = $str[rand(0, count($str)-1)];
	$word[] = rand(0,9);
}

$str = join($word);

header ('Content-Type: image/png');
session_start();
$_SESSION['cap'] = $str;


$im = @imagecreatetruecolor(120, 30)
      or die('Cannot Initialize new GD image stream');
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 5, 30, 5,  $str, $text_color);
imagepng($im);
imagedestroy($im);

?>